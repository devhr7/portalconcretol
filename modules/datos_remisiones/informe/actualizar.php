<?php

header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$tiempo_remi = new tiempo_remi();

$fecha_ini = '2021-05-01';
$fecha_fin = '2021-05-05';

$datos_remi = $tiempo_remi->get_horas_remi($fecha_ini, $fecha_fin);
$resultado = $tiempo_remi->actualizar_horas_remi($datos_remi);
$resultado = $tiempo_remi->actualizar_conductor($fecha_ini,$fecha_fin);


//ALTER TABLE `ct26_remisiones`  ADD `ct26_identificacion_conductor` INT(11) NULL DEFAULT NULL  AFTER `ct26_conductor`;


var_dump($resultado);