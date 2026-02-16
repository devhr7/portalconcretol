<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t40_votaciones = new t40_votaciones();


$php_estado = false;
$php_error= "";
$resultado = "";



if (isset($_POST['txt_nombre_campana_vota']) && !empty($_POST['txt_nombre_campana_vota']) ){
     
    $nombre_campana_votacion = htmlspecialchars($_POST['txt_nombre_campana_vota']);
    $descripcioncampana = htmlspecialchars($_POST['txt_descrip_campana_vota']);
    $fecha_ini = htmlspecialchars($_POST['txt_fecha_ini']);


    $id_last_insert = $t40_votaciones->crear_campana($nombre_campana_votacion,$descripcioncampana,$fecha_ini);
    
    if($id_last_insert){
        $php_estado = true;
    }
   
    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,

    
);


echo json_encode($datos, JSON_FORCE_OBJECT);
