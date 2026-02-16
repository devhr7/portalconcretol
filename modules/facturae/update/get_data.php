<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
//require '../../../include/conexion.php';
//require '../../../include/get_datos.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$t5_obras = new t5_obras();


$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){
    $select_obras = $t5_obras->Select_Obra( $_POST['idCliente']);
    $php_estado = true;    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);


echo json_encode($datos, JSON_FORCE_OBJECT);
