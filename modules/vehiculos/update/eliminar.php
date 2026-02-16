<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
$t10_vehiculo = new t10_vehiculo();


$php_estado = false;
if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = htmlspecialchars($_POST['id']);
    
   $rest =  $t10_vehiculo->eliminar_vehiculo($id);
    
    $php_estado = true;
    
}else {
    $php_estado = false;
}


$msg =  $rest;


$datos = array(
    'estado' => $php_estado,
    'msg' => $msg,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
