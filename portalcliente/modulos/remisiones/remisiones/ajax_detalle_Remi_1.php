<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
require 'modelo_t26.php';


$t26 = new modelo_t26();



if($_POST['task']=="remi"){

}

if($_POST['task'] == 10){
    
    //$persona =  $_SESSION['N_identificacion'] . " - ".$_SESSION['nombre_usuario'];
    $persona =  $_SESSION['nombre_usuario'];

    $t26->RecibidoFinal($_POST['id_Remision'], $persona);
    
}

if($_POST['task'] == 6){
    
    $t26->observaciones_cli($_POST['id_Remision'], $_POST['obs']);
    
}
if($_POST['task'] == 5){
    
    $check = $_POST['check'];
    if($check == 1){
        $option = true;
        $cantidad = floatval($_POST['cant_bombeada']);
        $cantidad = floatval($_POST['cant_bombeada']);
        $tipo_bomba = $_POST['tipo_bomba'];
        
    }else{
        $option = false;
        $cantidad = 0;
        $tipo_bomba = 0;
    }
    
    $t26->servicio_bomba($_POST['id_Remision'], $option, $cantidad,$tipo_bomba);
    
}

if($_POST['task'] == 4){
    
    $t26->hora_terminacion_descargue($_POST['id_Remision'], $_POST['hora']);
    
}

if($_POST['task'] == 3){
    
    $t26->hora_inicio_descargue($_POST['id_Remision'], $_POST['hora']);
    
}

if($_POST['task'] == 2){
    
    $t26->hora_llegadaObra($_POST['id_Remision'], $_POST['hora']);
    
}
if($_POST['task'] == 1){
    
    $t26->hora_salidaObra($_POST['id_Remision'], $_POST['h_salida_planta']);
    
}

$php_estado = "bien";

$datos = array(
    'estado' => $php_estado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
