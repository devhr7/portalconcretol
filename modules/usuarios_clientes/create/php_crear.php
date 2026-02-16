<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$usuarios_clientes = new usuarios_clientes();
//$t_nombretabla = new tabla();

$php_estado = false;
$php_error[] = "";
$resultado = "";
$id = 0;

if (isset($_POST['C_NumeroID']) && isset($_POST['C_nombres']) && isset($_POST['C_Apellidos'])) {
    $C_NumeroID = htmlspecialchars($_POST['C_NumeroID']);
    $C_nombres = htmlspecialchars($_POST['C_nombres']);
    $C_Apellidos = htmlspecialchars($_POST['C_Apellidos']);
    $C_Usuario = $C_NumeroID;
    $C_Pass = md5($C_NumeroID);
    $razonSocial = $C_nombres . " " . $C_Apellidos;

    $estado = 1;
    $rol = htmlspecialchars($_POST['txt_rol']);
    $TipoTercero = 3;
    if($id = $t1_terceros->crear_usuario_cliente($C_NumeroID, $C_nombres, $C_Apellidos, $rol)){
        $php_estado = true;
    }else{
        $php_estado = false;
        $php_error = "Error al guardar en la base de datos";
    }
} else {
    $php_estado = false;
    $php_error = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'id' => $id,
    
);

echo json_encode($datos, JSON_FORCE_OBJECT);
