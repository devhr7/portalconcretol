<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
$pedidos = new pedidos();
$usuarios_clientes = new usuarios_clientes();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['C_IdTerceros']) && !empty($_POST['C_IdTerceros'])) {
    $id_usuario = $_POST['id'];
    $id_cliente = $_POST['C_IdTerceros'];
    $id_obra = $_POST['C_Obras'];
    if ($usuarios_clientes->insert_gestion_acceso($id_usuario, $id_cliente, $id_obra)) {
        $php_estado = true;
    } else {
        $php_error = 'Error inesperado';
    }
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
