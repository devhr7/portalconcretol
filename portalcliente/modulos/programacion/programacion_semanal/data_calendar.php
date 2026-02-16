<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$programacion = new programacion();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['rol_funcionario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol_funcionario'];
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol'];
}

if ($id_rol != 1) {
    $data = $programacion->get_prog_semanal_por_usuario($id_usuario);
    $php_estado = true;
} else {
    $data = $programacion->get_prog_semanal();
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
