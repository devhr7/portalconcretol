<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$novedades_despacho = new novedades_despacho();
$php_estado = false;
$php_msg = "";

if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])  && isset($_POST['txt_obra']) && !empty($_POST['txt_obra'])) {
    $nombre_cliente = $novedades_despacho->get_nombre_cliente($_POST['txt_cliente']);
    $nombre_obra = $novedades_despacho->get_nombre_obra($_POST['txt_obra']);

    if ($novedades_despacho->insert_datos_cliente($_POST['txt_id_novedad'], $_POST['txt_cliente'], $nombre_cliente, $_POST['txt_obra'], $nombre_obra)) {
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
