<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();

$ciudad = $_POST['ciudad'];

if($ciudad == "HONDA"){
    $planta = "'HND'";
}else{
    $planta = "'RMI','RZO','RMT'";
}



$fecha_remi = $_POST['fecha'];



$data = $t26_remisiones->inf_viajes_totalizado($planta, $fecha_remi);

foreach ($data as $key) {
    $tviajes = doubleval($key['viajes']);
    $tmetros = doubleval($key['metros']);
}

if($tviajes == 0 || $tmetros == 0){
    $tmetrosviajes =  0;
}else{

    $tmetrosviajes  =  number_format($tmetros / $tviajes,2);
}
    
$datos = array(
    'viajes' => $tviajes,
    'metros' => $tmetros,
    'tmetrosviajes' => $tmetrosviajes,
    //'result' => $result2,
);


print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);