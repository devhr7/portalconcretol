<?php

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


header('Content-Type: application/json');
$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t40_votaciones = new t40_votaciones();


$php_estado = false;
$php_error = "";
$php_last_insert = null;
if(isset($_POST['txt_cedula']) && !empty($_POST['txt_cedula'])&& isset($_POST['txt_nombres']) && !empty($_POST['txt_nombres']) && isset($_POST['txt_cargo']) && !empty($_POST['txt_cargo']) ){

    $cedula = (int)htmlspecialchars($_POST['txt_cedula']);
    $nombre = htmlspecialchars($_POST['txt_nombres']);
    $cargo = htmlspecialchars($_POST['txt_cargo']);


    $result  = $t40_votaciones->registrovotantes($cedula, $nombre , $cargo);


    $cedula  = $t40_votaciones->select_ced_votante($result);

    if($cedula){
        $php_last_insert = $cedula;
        $php_estado = true;
    }

}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'ultimo' => $php_last_insert,

    
);


echo json_encode($datos, JSON_FORCE_OBJECT);



