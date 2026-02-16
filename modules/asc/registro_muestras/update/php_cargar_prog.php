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

if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])) {
    $datos_post['id_muestra'] = $_POST['id_muestra'];
    $cls_laboratorio->delete_programacion_por_muestra($datos_post['id_muestra']);
    $datos_muestra = $cls_laboratorio->get_data_muestras_for_id($_POST['id_muestra']);
    $datos_post['id_producto'] = $datos_muestra['id_producto']; // traer id producto de la muestra

    if ($datos_param_prog = $cls_laboratorio->cargar_datos_param_producto($datos_post['id_producto'])) {
        foreach ($datos_param_prog as $key) {
            $datos_post['periodo_fallo'] = $key['id_periodo'];
            $datos_post['nombre_peridofallo'] = $key['nombre_periodo'];
            $datos_post['num_cilindros'] = $key['num_fallos'];
            $dt = new DateTime($datos_muestra['fecha_muestra']);
            $dias_para_sumar = "+" . $datos_post['periodo_fallo'] . " day";
            $datos_post['fecha_programada'] = $dt->modify($dias_para_sumar)->format("Y-m-d");

            if ($cls_laboratorio->validar_prog_muestra($datos_post)) {
                if ($cls_laboratorio->registrar_programacion_resultados_muestras($datos_post)) {
                    $php_estado = true;
                } else {
                    $php_estado = false;
                }
            }
        }
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
    'DATOS_PROG' => $datos_param_prog,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
