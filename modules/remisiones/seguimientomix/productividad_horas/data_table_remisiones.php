<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();

$fecha_remi = $_POST['fecha'];
$ciudad = $_POST['ciudad'];


if($ciudad == "HONDA"){
    $planta = "'HND'";
}else{
    $planta = "'RMI','RZO','RMT'";
}



$data = $t26_remisiones->seguimiento_remisiones_final($planta,$fecha_remi);

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);