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

if (
    isset($_POST['id_periodo']) && !empty($_POST['id_periodo'])
) {
    

    $dt = new DateTime($_POST['fecha_muestra']);
    $dias_para_sumar = "+" . $_POST['id_periodo'] . " day";
    $fecha_programada = $dt->modify($dias_para_sumar)->format("Y-m-d");


   
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
    'rst' => $fecha_programada,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
