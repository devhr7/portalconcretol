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
$datos_post['h'] = "";

if (isset($_POST['txt_id_muestra2']) && !empty($_POST['txt_id_muestra2'])) {
    $datos_post['id_muestra'] = $_POST['txt_id_muestra2'];
    $datos_post['resistencia'] = $cls_laboratorio->get_resistencia_for_muestra(intval($_POST['txt_id_muestra2']));
    $diametro_probeta = $cls_laboratorio->get_diametro_probeta_for_muestra($_POST['txt_id_muestra2']);
    $datos_post['id_tipo_fallo'] = intval($_POST['txt_registrar_fallo']);
    $datos_post['id_periodo'] = intval($_POST['txt_registrar_periodo']);
    $datos_post['fecha_resultado'] = $_POST['txt_fecha_resultado'];
    $datos_post['resultadokn'] = $_POST['txt_resultadokn'];
    $datos_post['observacion'] = $_POST['txt_obs_resultado'];
    $data_muestra = $cls_laboratorio->get_data_muestra1($_POST['txt_id_muestra2']);
    $datos_post['nombre_peridofallo'] = $cls_laboratorio->get_nombre_periodo_fallo($_POST['txt_registrar_periodo']);

    if ($datos_post['resistencia'] > 0  && $diametro_probeta > 0) {
        if (intval($datos_post['id_tipo_fallo'] == 1)) { // Compresion
            // Sub tipo Fallo 
            if (isset($_POST['txt_registrar_tipo_fallo'])) {
                $datos_post['subtipo_fallo'] = $_POST['txt_registrar_tipo_fallo'];
            } else {
                $datos_post['subtipo_fallo'] = 0;
            }
            // KG /CM2
            if ($kg_cm2 = $cls_laboratorio->kg_sobre_cm2($_POST['txt_resultadokn'], $diametro_probeta)) {
                $datos_post['kgcm2'] = strval(round($kg_cm2, 3));
            } else {
                $datos_post['kgcm2'] = null;
            }
            // Porcentaje
            if ($cls_laboratorio->registrar_resultados_muestras($datos_post)) {
                $datos_post['promediokgcm2'] = $cls_laboratorio->promedio_kg_sobre_cm2($datos_post);
                if (is_null($datos_post['promediokgcm2']) || $datos_post['resistencia'] == 0) {
                    $errores = "Se requiere los valores de Resistencia y Diametro de la Probeta";
                } else {
                    $cls_laboratorio->eliminar_consolidado_resultados($datos_post);
                    $datos_post['porcentaje'] = $cls_laboratorio->porcentaje_por_edad($datos_post['promediokgcm2'], $datos_post['resistencia']);
                    $cls_laboratorio->crear_consolidado_resultados($datos_post);

                    $datos_post['alerta'] = $cls_laboratorio->alert_resultado_consolidado($datos_post['id_muestra']);
                    $php_estado = true;
                }
            } else {
                $errores = "Error al Guardar la muestra";
            }
        } elseif (intval($datos_post['id_tipo_fallo'] == 2)) { // Flexion
            // KG /CM2
            if ($kg_cm2 = $cls_laboratorio->kg_sobre_cm2_flexion($_POST['txt_resultadokn'])) {
                $datos_post['kgcm2'] = strval(round($kg_cm2, 3));
            } else {
                $datos_post['kgcm2'] = null;
            }
            // porcentaje
            if ($cls_laboratorio->registrar_resultados_muestras($datos_post)) {
                $datos_post['promediokgcm2'] = $cls_laboratorio->promedio_kg_sobre_cm2($datos_post);
                if (is_null($datos_post['promediokgcm2']) || $datos_post['resistencia'] == 0) {
                    $errores = "Se requiere los valores de Resistencia y Diametro de la Probeta";
                } else {
                    $cls_laboratorio->eliminar_consolidado_resultados($datos_post);
                    $datos_post['porcentaje'] = $cls_laboratorio->porcentaje_por_edad($datos_post['promediokgcm2'], $datos_post['resistencia']);
                    $cls_laboratorio->crear_consolidado_resultados($datos_post);

                    $datos_post['alerta'] = $cls_laboratorio->alert_resultado_consolidado($datos_post['id_muestra']);
                    $php_estado = true;
                }
            } else {
                $errores = "Error al Guardar la muestra";
            }
        }
    } else {
        $errores = "Se requiere los valores de Resistencia y Diametro de la Probeta";
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $datos_post,
    'post2' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
