<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$pedidos = new pedidos();

if(isset($_POST['id_pedido']) && !empty($_POST['id_pedido'])){
    $data = $pedidos->get_bomba_precio($_POST['id_pedido']);
}else{
    $data = false;
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
