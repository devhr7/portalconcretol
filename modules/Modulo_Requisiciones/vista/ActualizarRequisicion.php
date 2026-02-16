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
$id = $_POST['IdU'];
$prioridad = $_POST['prioridad'];
$imagen1= $_POST['img1'];

if(isset($_FILES['img'])){
    if ($_FILES['img']){
        $imagen = basename($_FILES["img"]["name"]);
        $imagen =str_replace(' ', '',$imagen);
        $ruta = "../img/requisiciones/".$imagen;
        $subirarchivo = move_uploaded_file($_FILES["img"]["tmp_name"], $ruta);
    

$requisicion = new Requisicion($fechaActual,$cantidad,$unidad,$nombreProduct,$descripcion,$rolUser,$imagen,$lugar,$prioridad);

$controlador = new ControladorRequisiciones();
$controlador->  actualizarRequisicion($id,$requisicion);
}
}
else{
    $requisicion = new Requisicion($fechaActual,$cantidad,$unidad,$nombreProduct,$descripcion,$rolUser,$imagen1,$lugar,$prioridad);

    $controlador = new ControladorRequisiciones();
    $controlador->  actualizarRequisicion($id,$requisicion);
}
header( "Location: ../index.php" );


?>