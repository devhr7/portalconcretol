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

$fecha = $_POST['fecha'];
$remision = $_POST['remision'];
$planta = $_POST['planta'];






$data = $cls_laboratorio->tabla_remisiones($fecha,$remision, $planta);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);