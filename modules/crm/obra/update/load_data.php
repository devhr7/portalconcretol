<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$oportunidad_negocio = new oportunidad_negocio();

$php_estado = false;
$errores = "";
$resultado = "";

if (isset($_POST['task']) && !empty($_POST['task'])) {
    if (intval($_POST['task']) == 2) {
        if ($option_comuna = $oportunidad_negocio->select_comuna(intval($_POST['id_municipio']), $id_comuna = null)) {
            $datos = array(
                'estado' => true,
                'option_comuna' => $option_comuna,
            );
        }
    }
    if (intval($_POST['task']) == 1) {
        if ($option_municipio = $oportunidad_negocio->select_municipio(intval($_POST['id_departamento']), $id_municipio = null)) {
            $datos = array(
                'estado' => true,
                'option_municipio' => $option_municipio,
            );
        }
    }
} else {
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'post' => $_POST,
    );
}

echo json_encode($datos, JSON_FORCE_OBJECT);
