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



$mes = $_POST['mes'];



$data = $t26_remisiones->inf_viajes_totalizado_mes($planta, $mes);

foreach ($data as $key) {
    $tviajes = doubleval($key['viajes']);
    $tmetros = doubleval($key['metros']);
    $tvehiculos = doubleval($key['vehiculos']);
}

if($tviajes == 0 || $tmetros == 0 || $tvehiculos == 0){
    $tmetrosviajes =  0;
    $viajes_metros =0;
}else{

    $tmetrosviajes  =  number_format($tmetros / $tviajes,2);
    $viajes_metros  =  number_format($tviajes / $tvehiculos,2);
}
    
$datos = array(
    'viajes' => $tviajes,
    'metros' => $tmetros,
    'tmetrosviajes' => $tmetrosviajes,
    'viajes_metros' => $viajes_metros,
    //'result' => $result2,
);


print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);