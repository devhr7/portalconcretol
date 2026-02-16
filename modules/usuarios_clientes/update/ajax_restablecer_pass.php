<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();


$php_estado = false;
if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = htmlspecialchars($_POST['id']);
    
   $rest =  $t1_terceros->restablecer_pass($id);
    
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
