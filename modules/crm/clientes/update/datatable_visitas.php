<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$op = new oportunidad_negocio();
$visita_clientes = new visitas_clientes();

$id = $_POST['id_cliente'];

$data = $visita_clientes->visitas_x_clientes($id);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);