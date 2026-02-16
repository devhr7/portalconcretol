<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase pedidos
$pedidos = new pedidos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$precio_subtotal = 0;

if (isset($_POST['task']) && !empty($_POST['task'])) {
    $php_msg = "Paso 1";
    if (intval($_POST['task'] == 1)) {
        $id_producto = $_POST['id_producto'];
        // $pedidos->calcularDescuento($precio_base, $porcentaje);
        if ($precio_subtotal = $pedidos->calcularDescuento(doubleval($pedidos->get_precio_producto($id_producto)), doubleval($_POST['descuento']))) {
            $php_msg = "bien";
        }
    } else {
        $php_msg = "error en el post task";
    }
} else {
    $php_msg = "falta datos requeridos";
}
$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'subtotal' => $precio_subtotal,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
