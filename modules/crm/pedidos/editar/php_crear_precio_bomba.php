<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$pedidos = new pedidos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if ($pedidos->validar_existencias_precio_bomba($_POST['id_tipo_bomba'], $_POST['id'])) {
    $id_pedido = $_POST['id'];
    $id_tipo_bomba = $_POST['id_tipo_bomba'];
    $nombre_tipo_bomba = $pedidos->get_nombre_bomba($id_tipo_bomba);
    $minimo = $_POST['minimo'];
    $maximo = $_POST['maximo'];
    $precio = str_replace(".","",htmlspecialchars($_POST['precio']));
    if ($pedidos->crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $minimo, $maximo, $precio)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}else{
    $php_error = "El tipo de bomba ya se encuentra guardado con este pedido";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
