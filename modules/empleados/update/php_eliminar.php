<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();
$t1_terceros = new t1_terceros();



$id_funcionario = $php_clases->HR_Crypt($_POST['id_funcionario'],2);

if($id_funcionario){

    $resultado = $t1_terceros->eliminar_funcionario($id_funcionario);
    $php_estado = $resultado;
    
}else{
    $php_estado = false;
}

$datos = array(
    'estado' => $php_estado,

);


echo json_encode($datos, JSON_FORCE_OBJECT);