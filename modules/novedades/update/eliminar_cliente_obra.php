<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades_despacho = new novedades_despacho();
$php_estado = false;
$php_msg = "";

if (isset($_POST['id']) && !empty($_POST['id'])) {
    if ($cls_novedades_despacho->delete_datos_clientes($_POST['id'])) {
        $php_estado = true;
    }
} else {
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
