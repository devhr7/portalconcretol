<?php 
include_once "../controlador/ControladorRequisiciones1.php";
date_default_timezone_set("America/Bogota");
$fechaActual = date('Y-m-d');
$precio = $_POST['precio'];
$idprove = $_POST['IDPROVE'];

if ($_FILES['archivo']){
        $archivo = basename($_FILES["archivo"]["name"]);
        $archivo =str_replace(' ', '',$archivo);
        $ruta = "../img/".$archivo;
        $subirarchivo = move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
    }
//$id = $_POST['id'];
//$precio = $_POST['precio'];


$cotizacion = new Cotizacion($archivo,$precio,$fechaActual);

$controlador = new ControladorRequisiciones();
$controlador->insertarCotizacion($idprove,$cotizacion);

$resultado=$controlador->seleccionarultimodatoCoti();
while($requisicion = $resultado->fetch_assoc()){
    $id = $requisicion['IDCOTIZACION'];
}




header( "Location: CotizacionHasRequisiciones.php?id=". $id);


?>