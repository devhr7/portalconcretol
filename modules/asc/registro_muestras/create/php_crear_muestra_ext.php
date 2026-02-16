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

$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);
$errores = "nada";
$id_muestra = "#";

if (
    isset($_POST['fecha_muestra']) && !empty($_POST['fecha_muestra'])  &&  isset($_POST['hora_muestra']) && !empty($_POST['hora_muestra'])
) {

    $datos_post['fecha_muestra'] = $_POST['fecha_muestra'];
    $datos_post['hora_muestra'] = $_POST['hora_muestra'];

    if ($id_muestra = $cls_laboratorio->crear_muestra_ext($datos_post)) {
        $php_estado = true;
        $errores = "Muestra creada Exitosamente";
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'id_muestra' => $id_muestra,
    'errores' => $errores,
    'rst' => $php_estado,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
