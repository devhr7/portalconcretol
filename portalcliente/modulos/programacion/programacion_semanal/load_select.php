<?php
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$data = false;
$php_estado = false;
$php_error[] = "";

$programacion = new programacion();
$eventos = new eventos();
if (isset($_POST['task']) && !empty($_POST['task'])) {
    $eventos->cargar_eventos();
    $php_estado = true;
} else {
    $php_estado = false;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
