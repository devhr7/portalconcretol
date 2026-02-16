<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$modelo_remisiones = new modelo_remisiones();
$id_usuario = $_SESSION['id_usuario'];
$data = $modelo_remisiones-> get_clientes_obras($id_usuario);

foreach ($data as $fila){
    $id_clientes[] = $fila['cliente'];
    $id_obra[] = $fila['obra'];

}

$cliente = implode(",", $id_clientes);
$obras = implode(",", $id_obra);


$datos = $modelo_remisiones->remisiones_clientes($cliente, $obras);

print json_encode($datos, JSON_UNESCAPED_UNICODE);
