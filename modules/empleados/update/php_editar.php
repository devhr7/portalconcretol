<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t1_terceros = new t1_terceros();

$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['C_NumeroID']) && !empty($_POST['C_NumeroID'])){
     
    $id = $_POST['id'];
    $numero_identificacion = (int)htmlspecialchars($_POST['C_NumeroID']);
    $nombre1 = htmlspecialchars($_POST['C_nombre1']);
    $nombre2 = htmlspecialchars($_POST['C_nombre2']);
    $apellido1 = htmlspecialchars($_POST['C_apellido1']);
    $apellido2 = htmlspecialchars($_POST['C_apellido2']);
    $rol = htmlspecialchars($_POST['C_Rol']);

    
    $validarExistencias =true;
    
    if($validarExistencias)
    {
        $result = $t1_terceros->editar_funcionario($id, $numero_identificacion, $nombre1, $nombre2, $apellido1, $apellido2, $rol);
        
        if($result){
            $php_estado = true;
        }else{
            $errores = "Este registro no Guardo Correctamente";
        }
        
    }else{
        $errores = "El Funcionario ya existe en nuestra base de datos";
    }

    
} else {
    $errores = "faltan los campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
