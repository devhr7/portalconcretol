<?php 
include_once "../controlador/ControladorRequisiciones1.php";

$nit = $_POST['nit'];
$razonS = $_POST['razonS'];
$ubicacion = $_POST['ubicacion'];

//$id = $_POST['id'];
//$precio = $_POST['precio'];


$cotizacion = new Proveedor($nit,$razonS,$ubicacion);

$controlador = new ControladorRequisiciones();
$controlador->insertarProveedor($cotizacion);



header( "Location: Cotizaciones.php");


?>