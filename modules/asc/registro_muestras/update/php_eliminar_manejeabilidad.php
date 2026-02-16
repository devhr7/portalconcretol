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
    isset($_POST['id']) && !empty($_POST['id'])
) {
    $id = $_POST['id'];
   

    if ($cls_laboratorio->eliminar_manejeabilidad($id)) {
        $php_estado = true;
    } else {
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
