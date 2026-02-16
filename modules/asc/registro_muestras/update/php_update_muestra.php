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

$errores = "nada";

if (
    isset($_POST['txt_id_muestra']) && !empty($_POST['txt_id_muestra'])
) {
    $id = $_POST['txt_id_muestra'];
    $id_muestra = $_POST['txt_id_muestra'];
    $datos_post['tipocementante'] = $_POST['txt_tipocementante'];
    $datos_post['cementante'] = $_POST['txt_cementante'];
    $datos_post['consecutivo_interno'] = $_POST['txt_consecutivo_interno'];

    if (isset($_POST['txt_fecha_muestra']) && isset($_POST['txt_hora_muestra']) && isset($_POST['txt_temperatura']) && isset($_POST['txt_asentamiento'])) {
        $datos_post['fecha_muestra'] = $_POST['txt_fecha_muestra'];
        $datos_post['hora_muestra'] = $_POST['txt_hora_muestra'];
        $datos_post['temperatura'] = $_POST['txt_temperatura'];
        $datos_post['asentamiento'] = $_POST['txt_asentamiento'];
        $datos_post['sede'] = $_POST['txt_sede'];

        $cls_laboratorio->actualizar_muestra2($id, $datos_post);
    }

    if (isset($_POST['txt_producto'])) {

        $datos_productos = $cls_laboratorio->get_data_producto($_POST['txt_producto']);
        $datos_post['id_producto'] = $datos_productos['id_producto'];
        $datos_post['codigo_producto'] = $datos_productos['codigo_producto'];
        $datos_post['descripcion_producto'] = $datos_productos['descripcion_producto'];
        $cls_laboratorio->actualizar_muestra_for_producto($id_muestra, $datos_post);
    }

    $datos_post['aire'] = $_POST['txt_aire'];
    $datos_post['ceniza'] = $_POST['txt_ceniza'];
    $datos_post['resistencia'] = $_POST['txt_resistencia'];
    $datos_post['id_probeta'] = $_POST['txt_diametro_probeta'];
    $datos_post['diametro_probeta'] = $cls_laboratorio->get_diametro_probeta($_POST['txt_diametro_probeta']);

    $datos_post['id_responsable'] = $_POST['txt_tomada_muestra'];
    if ($_POST['txt_tomada_muestra'] == "externo") {
        $datos_post['nombre_responsable'] = $_POST['txt_nombre_tomada_muestra'];
    } else {
        $datos_post['nombre_responsable'] = $cls_laboratorio->get_nombre_responsable($datos_post['id_responsable']);
    }

    $datos_post['observaciones'] = $_POST['txt_observaciones_muestra'];


    if ($cls_laboratorio->actualizar_muestra($id, $datos_post)) {
        $php_estado = true;
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'rst' => $php_estado,
    'post' => $_POST
);

echo json_encode($datos, JSON_FORCE_OBJECT);
