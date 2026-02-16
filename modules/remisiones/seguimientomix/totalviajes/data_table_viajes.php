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



$data = $t26_remisiones->inf_viajes($planta, $fecha_remi);

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);