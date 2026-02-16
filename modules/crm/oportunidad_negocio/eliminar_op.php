<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$oportunidad_negocio = new oportunidad_negocio();
$php_estado = true;
$php_msg = "";

if (isset($_POST['id']) && !empty($_POST['id'] && isset($_POST['id']) && !empty($_POST['id']))) {

    if ($oportunidad_negocio->delete_oportunidad($_POST['id'])){
        $php_estado = true;

    }else{
        $php_estado = false;
    }
   
} else {
    $php_msg = "Falta datos requeridos para eliminar la novedad";
    $php_estado = false;

}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
