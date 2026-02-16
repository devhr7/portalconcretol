<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades_despacho = new novedades_despacho();
$php_estado = true;
$php_msg = "";

if (isset($_POST['id']) && !empty($_POST['id'] && isset($_POST['id']) && !empty($_POST['id']))) {

    if (intval($_POST['task']) == 1) {
        if ($cls_novedades_despacho->delete_novedades_generales($_POST['id'])) {
            $php_estado = true;
        }
    } elseif (intval($_POST['task']) == 2) {
        if ($cls_novedades_despacho->delete_novedades_remi($_POST['id'])) {
            $php_estado = true;
        }
    }
} else {
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
