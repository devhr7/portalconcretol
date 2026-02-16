<?php

header('Content-Type: application/json');
include '../../../../layout/validar_session4.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$php_clases = new php_clases();


$php_estado = false;
$errores = "";
$rst = "";
$datos_post;

$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);
$errores = "nada";

if (
    isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])
) {
    $datos_post['id_muestra'] = $_POST['id_muestra'];
    $datos_post['hora'] = $_POST['txt_registrar_hora_manejeabilidad'];
    $datos_post['asentamiento'] = $_POST['txt_registrar_asentamiento_manejeabilidad'];
    $datos_post['temperatura'] = $_POST['txt_registrar_temp_manejeabilidad'];

    if($id_manejeabilidad = $cls_laboratorio->registrar_manejeabilidad($datos_post)){
$php_estado = true;

    }
   
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'datospost' => $datos_post,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
