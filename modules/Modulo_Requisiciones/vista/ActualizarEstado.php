<?php 
include_once "../controlador/ControladorRequisiciones1.php";
date_default_timezone_set("America/Bogota");
$fechaActual = date('Y-m-d');
$nombreProduct = $_POST['nombreProduct'];
$cantidad = $_POST['cantidad'];
$unidad = $_POST['unidad'];
$rolUser = $_POST['txtId'];
$lugar = $_POST['lugar'];
$descripcion = $_POST['descripcion'];
$prioridad = $_POST['prioridad'];
$id = $_POST['IdU'];
$imagen = $_POST['img1'];
$estado = $_POST['estado'];

$requisicion = new Requisicion($fechaActual,$cantidad,$unidad,$nombreProduct,$descripcion,$rolUser,$imagen,$lugar,$prioridad);

$controlador = new ControladorRequisiciones();
$controlador->  actualizarEstado($id,$requisicion,$estado);


header( "Location: ../index.php" );


?>