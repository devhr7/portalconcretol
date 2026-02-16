<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
// require '../../../include/php_class.php';
// require '../../../include/conexion.php';
// require '../../../include/get_datos.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
//$get_datos = new get_datos();
$t5_obras = new t5_obras();

//$conexion_bd = new conexion();
//$conexion_bd->connect();

//$con = new conexionPDO();



$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){

    $select_obras = $t5_obras->option_obra($_POST['idCliente']);

    //$select_obras = $get_datos->Select_Obra($conexion_bd, $_POST['idCliente']);
    $php_estado = true;    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);


echo json_encode($datos, JSON_FORCE_OBJECT);
