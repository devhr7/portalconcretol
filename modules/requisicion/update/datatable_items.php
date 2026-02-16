<?php

header('Content-Type: application/json');
include '../../../layout/validar_session3.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'],2);

if(isset($_POST['id_requisicion']) && !empty($_POST['id_requisicion'])){
    $id_requisicion = $_POST['id_requisicion'];
}



$data = $cls_requisiciones->datatable_items($id_requisicion);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);