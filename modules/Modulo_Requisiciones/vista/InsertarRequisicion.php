<?php 
include_once "../controlador/ControladorRequisiciones1.php";
date_default_timezone_set("America/Bogota");
$fechaActual = date('Y-m-d');
$nombreProduct = $_POST['nombreProduct'];
$cantidad = $_POST['cantidad'];
$unidad = $_POST['unidad'];
$rolUser = $_POST['txtId'];
$lugar = $_POST['lugar'];
$prioridad = $_POST['prioridad'];
$descripcion = $_POST['descripcion'];
if ($_FILES['img']){
    $imagen = basename($_FILES["img"]["name"]);
    $imagen =str_replace(' ', '',$imagen);
    $ruta = "../img/requisiciones/".$imagen;
    $subirarchivo = move_uploaded_file($_FILES["img"]["tmp_name"], $ruta);
}

$requisicion = new Requisicion($fechaActual,$cantidad,$unidad,$nombreProduct,$descripcion,$rolUser,$imagen,$lugar,$prioridad);

$controlador = new ControladorRequisiciones();
$controlador->insertarRequisicion ($requisicion);


header( "Location: ../index.php" );


?>