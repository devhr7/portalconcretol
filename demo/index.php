<?php

require '../librerias/conexionPDO.php';
require_once '../vendor/autoload.php';
require 'update_remi.php';

$update_remi = new update_remi();

$fecha_inicio = '2023-02-02';
$fecha_fin = '2023-02-02';


var_dump($resultado = $update_remi->actualizar_nombres_cliente_obra($fecha_inicio,$fecha_fin));






// 64568


