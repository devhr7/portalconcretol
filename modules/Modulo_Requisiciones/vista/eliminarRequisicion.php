<?php 
include_once "../controlador/ControladorRequisiciones1.php";
$id = $_GET['id'];
$controlador = new ControladorRequisiciones();
$controlador->eliminarRequisicion ($id);


header( "Location: ../index.php" );


?>