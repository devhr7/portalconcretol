<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";
$id_lastinsert = "";

$visita_clientes = new visitas_clientes();

if (isset($_POST['id_visita']) && !empty($_POST['id_visita'])){


} else {
    $errores = "faltan campos requeridos";
}
$datos = array(
    'estado' => $php_estado,
    'post' => $_POST,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
