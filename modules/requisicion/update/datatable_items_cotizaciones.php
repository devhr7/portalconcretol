<?php

header('Content-Type: application/json');
include '../../../layout/validar_session3.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'],2);

$id_item = 3;
if(isset($_POST['id_item']) && !empty($_POST['id_item'])){
    $id_item = $_POST['id_item'];
}

$data = $cls_requisiciones->datatable_items_cotizaciones($id_item);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);