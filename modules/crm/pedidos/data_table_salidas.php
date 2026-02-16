<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$fecha_hoy = date('Y-m-d');
$pedidos = new pedidos();
$data = $pedidos->get_pedidos();
$pedidos->cambiar_status_pedido($fecha_hoy);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
