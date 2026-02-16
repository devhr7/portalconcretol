<?php 
include_once "../controlador/ControladorRequisiciones1.php";


$controlador = new ControladorRequisiciones();
$idC = $_POST['idC'];
//foreach($_POST['id'] as $id){
    for($i=0;$i<count($_POST['id']);$i++){
    $controlador->insertarCotiHasRequi($_POST['id'][$i],$idC,$_POST['precio'][$i]);
    $controlador->insertarPrecioRequi($_POST['precio'][$i],$_POST['id'][$i]);
       }


    





$resultado=$controlador->seleccionarultimodatoCoti();






header( "Location: ../index.php");


?>