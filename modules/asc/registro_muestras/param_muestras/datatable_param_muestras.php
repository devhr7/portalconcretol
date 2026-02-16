<?php

header('Content-Type: application/json');
include '../../../../layout/validar_session4.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'],2);

$cod_requisiciones = "";
$fecha_solicitante = "";
$area_solicitante = "";
$estatus = "";
    
if(empty($_POST['id_producto'])){
    $id_producto = 0;
}else{
    $id_producto = $_POST['id_producto'];
}

$data = $cls_laboratorio->datatable_param_productos($_POST['id_producto']);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);