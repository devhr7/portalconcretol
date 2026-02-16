<?php

session_start();
header('Content-Type: application/json');

require '../../../include/conexionPDO.php';
require '../../../include/php_class.php';
require '../../../include/conexion.php';
require '../../../include/get_datos.php';


$conexion_bd = new conexion();
$conexion_bd->connect();

$con = new conexionPDO();
$php_class = new php_class();
$get_datos = new get_datos();


$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){
    $select_obras = $get_datos->Select_Obra($conexion_bd, $_POST['idCliente']);
    $php_estado = true;    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);


echo json_encode($datos, JSON_FORCE_OBJECT);