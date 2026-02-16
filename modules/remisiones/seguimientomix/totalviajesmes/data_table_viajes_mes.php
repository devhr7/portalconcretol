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



$data = $t26_remisiones->inf_viajes_mes($planta, $mes);

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);