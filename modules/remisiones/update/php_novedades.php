<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();



$id_remision = (int)htmlspecialchars($_POST['id_remi']);
$novedad = utf8_encode($_POST['txt_novedades']);


if($id_remision){
    $resultado = $t26_remisiones->registro_novedades($id_remision, $novedad);
    $php_estado = $resultado;
}else{
    $php_estado = false;
}

$datos = array(
    'estado' => $php_estado,

);


echo json_encode($datos, JSON_FORCE_OBJECT);