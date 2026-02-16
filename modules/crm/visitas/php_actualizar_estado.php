<?php

header('Content-Type: application/json');
session_start();
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$cls_visitas_comerciales = new cls_visitas_comerciales();

$errores = "nada";

if (
    isset($_POST['id_event']) && !empty($_POST['id_event'])
) {

    $id_visita = $_POST['id_event'];
    $status = 2;

    if($cls_visitas_comerciales->actualizar_estado($id_visita, $status)){
        $php_estado = true;
    }else{
        $php_estado = false;

    }



} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);

