<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$pedidos = new pedidos();
$usuarios_clientes = new usuarios_clientes();
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si el id del precio de la bomba existe.
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    if ($usuarios_clientes->eliminar_gestion_acceso($id)) {
        $php_estado = true;
    } else {
        $log = 'No elimino Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
