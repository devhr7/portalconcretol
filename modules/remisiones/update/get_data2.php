<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
//require '../../../include/conexion.php';
//require '../../../include/get_datos.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
//$get_datos = new get_datos();
$t5_obras = new t5_obras();
$t1_terceros = new t1_terceros();



$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";
$select_op_bomba = "";
$select_aux_bomba = "";

if ($_POST['task'] == 1){
    $id_cliente= $_POST['idCliente'];
    $select_obras = $t5_obras->option_obra($id_cliente);
    $php_estado = true;    
}


if ($_POST['task'] == 2){
    $id_op_bomba= $_POST['id_op_bomba'];
    $id_aux_bomba= $_POST['id_aux_bomba'];
    $select_op_bomba = $t1_terceros->select_op_bomba($id_op_bomba);
    $select_aux_bomba = $t1_terceros->select_aux_bomba($id_aux_bomba);
    $php_estado = true;
    
    
    
}



$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,
    'op_bomba' => $select_op_bomba,
    'aux_bomba' => $select_aux_bomba

);


echo json_encode($datos, JSON_FORCE_OBJECT);
