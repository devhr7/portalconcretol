<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();



$id_remision = (int)htmlspecialchars($_POST['id_remi']);


if($id_remision){
    $resultado = $t26_remisiones->anular_remision($id_remision);
    $t26_remisiones->rz_anular_remision($id_remision,$_POST['rz_anular']);
    $php_estado = $resultado;
}else{
    $php_estado = false;
}

$datos = array(
    'estado' => $php_estado,
    'post' => $_POST

);


echo json_encode($datos, JSON_FORCE_OBJECT);