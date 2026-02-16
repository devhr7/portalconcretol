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
$msg = "Bien";


if (isset($_POST['num_ced']) && !empty($_POST['num_ced'])){
     
    $numero_identificacion = (int)htmlspecialchars($_POST['num_ced']);
    $nombre1 = htmlspecialchars($_POST['C_nombre1']);
    $nombre2 = htmlspecialchars($_POST['C_nombre2']);
    $apellido1 = htmlspecialchars($_POST['C_apellido1']);
    $apellido2 = htmlspecialchars($_POST['C_apellido2']);
    $rol_user = htmlspecialchars($_POST['C_Rol']);

    
    $validarExistencias = $general_modelos->existencia('ct1_terceros','ct1_NumeroIdentificacion' , $numero_identificacion);
    
    if($validarExistencias)
    {
        $result = $t1_terceros->insertar_funcionario($numero_identificacion, $nombre1, $nombre2, $apellido1, $apellido2, $rol_user);
        
        if($result){
            $php_estado = true;
        }else{
            $errores = "Este registro no Guardo Correctamente";
        }
        
    }else{
        $errores = "El Funcionario ya existe en nuestra base de datos";
    }

    
} else {
    $errores = "faltan los campos requeridos   ";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'msg' => $msg,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
