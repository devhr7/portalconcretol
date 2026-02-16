<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$general_modelos = new general_modelos();
$t1_terceros = new t1_terceros();


$php_estado = false;
$errores = "";
$resultado = "";


if (
    isset($_POST['C_NumeroID']) && !empty($_POST['C_NumeroID']) &&
    isset($_POST['C_nombres']) && !empty($_POST['C_nombres'])
) {

    $C_NumeroID = htmlspecialchars($_POST['C_NumeroID']);
    $razonSocial = htmlspecialchars($_POST['C_nombres']);
    $usuario = $C_NumeroID;
    $C_Pass = md5($C_NumeroID);

    $estado = 1;
    $rol = 101;
    $TipoTercero = 1;


    $validarExistencias = $general_modelos->existencia('ct1_terceros', 'ct1_NumeroIdentificacion', $C_NumeroID);
    $x = false;

    if ($validarExistencias) {

        $resultado = $t1_terceros->insertar_cliente($C_NumeroID, $razonSocial);

        if ($resultado) {
            $php_estado = true;
        } else {
            $errores = "Hubo un error al guardar".  $resultado;
        }
    } else {
        $errores = "Este Cliente ya existe en la base de datos";
    }
} else {
    $errores = "Faltan llenar los campos requerios";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
