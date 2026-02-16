<?php 
include_once "../controlador/ControladorRequisiciones1.php";


$controlador = new ControladorRequisiciones();

    //foreach($_POST['id'] as $id){
        for($i=0;$i<count($_POST['id']);$i++){
        $resultado =$controlador->seleccionaCHR($_POST['id'][$i]);
        while($requisicion = $resultado->fetch_assoc()){
            $seleccion = $requisicion['SELECCION'];
        }
        if($seleccion ==0){
        $controlador->checkCotizacion("1",$_POST['id'][$i]);
            }
        
        if($seleccion ==1){
            $controlador->checkCotizacion("0",$_POST['id'][$i]);
                }
            }  
        



header( "Location: ../index.php");


?>