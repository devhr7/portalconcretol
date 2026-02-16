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
    isset($_POST['txt_id_muestra1']) && !empty($_POST['txt_id_muestra1'])
) {
    $id = $_POST['txt_id_muestra1'];
    $datos_post['id_muestra'] = $_POST['txt_id_muestra1'];
    $datos_post['periodo_fallo'] = $_POST['txt_periodo_fallo'];
    $datos_post['num_cilindros'] = $_POST['txt_num_cilindros'];

    $datos_post['id_periodo'] = $_POST['txt_periodo_fallo'];

    if ($cls_laboratorio->validar_prog_muestra($datos_post)) {
        $data_muestra = $cls_laboratorio->get_data_muestra1($id);
        $datos_post['nombre_peridofallo'] = $cls_laboratorio->get_nombre_periodo_fallo($_POST['txt_periodo_fallo']);

        $datos_post['id_producto'] = $data_muestra['id_producto'];
        $datos_post['fecha_muestra'] = $data_muestra['fecha_muestra'];

        $dt = new DateTime($data_muestra['fecha_muestra']);
        $dias_para_sumar = "+" . $datos_post['periodo_fallo'] . " day";
        $datos_post['fecha_programada'] = $dt->modify($dias_para_sumar)->format("Y-m-d");


        if ($cls_laboratorio->registrar_programacion_resultados_muestras($datos_post)) {
            $php_estado = true;
        } else {
            $php_estado = false;
        }
    } else {
        $errores = "Ya existe un registro con este periodo";
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $datos_post,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
