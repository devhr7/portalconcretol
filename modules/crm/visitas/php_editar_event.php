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
    isset($_POST['txt_inicio_edit']) && !empty($_POST['txt_inicio_edit']) && isset($_POST['txt_fin_edit']) && !empty($_POST['txt_fin_edit'])
) {

    $id = $_POST['id'];
    
    $txt_inicio = $_POST['txt_inicio_edit'];
    $txt_fin = $_POST['txt_fin_edit'];

    if($cls_visitas_comerciales->editar_visitas_comerciales($txt_inicio, $txt_fin, $id)){
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

