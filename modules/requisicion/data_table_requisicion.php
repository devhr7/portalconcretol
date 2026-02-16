<?php

header('Content-Type: application/json');
include '../../layout/validar_session2.php';
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'],2);

$cod_requisiciones = "";
$fecha_solicitante = "";
$area_solicitante = "";
$estatus = "";

$cod_requisiciones = $_POST['cod_requisiciones'];
$fecha_solicitante = $_POST['fecha_solicitante'];
$area_solicitante = $_POST['area_solicitante'];
$estatus = $_POST['estatus'];

$data = $cls_requisiciones->datatable_requisiciones($id_usuario,$rol_user,$cod_requisiciones,$fecha_solicitante,$area_solicitante,$estatus);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);