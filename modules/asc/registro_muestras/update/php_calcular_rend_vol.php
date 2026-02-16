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
$datos_rst = "";
$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);
$errores = "nada";
$datos_post['h'] = "";

if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])  && isset($_POST['totalkgcargue']) && !empty($_POST['totalkgcargue']) && isset($_POST['pesoolla_mas_concreto']) && !empty($_POST['pesoolla_mas_concreto'])) {
    $datos_post['id_muestra'] = $_POST['id_muestra'];
    $datos_post['totalkg_registrocargue'] = $_POST['totalkgcargue'];
    $datos_post['pesoolla_mas_concreto'] = $_POST['pesoolla_mas_concreto'];
    $datos_post['metroscubicos'] = $_POST['metroscubicos'];
    $datos_post['volumen_olla'] = doubleval($_POST['volumen_olla']);
    $datos_post['peso_olla'] = doubleval($_POST['peso_olla']);

    if ($datos_rst = $cls_laboratorio->calcular_rendimientovolumetrico($datos_post)) {
        $php_estado = true;
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'rst' => $datos_rst,
    'post' => $datos_post,
    'post2' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
