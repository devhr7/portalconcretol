<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$php_estado = false;
$php_msg = "";

if (isset($_POST['check_id_remi']) && !empty($_POST['check_id_remi'])) {
    $id_novedad = $_POST['id_novedades_for_remision'];
    if (is_array($data_novedades_generales = $cls_novedades->select_novedad_generales($id_novedad))) {
        foreach ($data_novedades_generales as $key_generales) {
            $id_tipo_novedad = $key_generales['id_tipo_novedad'];
            $tipo_novedad = $key_generales['tipo_novedad'];
            $id_area_afectada = $key_generales['id_area_afectada'];
            $area_afectada = $key_generales['area_afectada'];
            $id_listado_novedad = $key_generales['id_listado_novedad'];
            $novedad = $key_generales['novedad'];
            $observacion = $key_generales['observacion'];

            foreach ($_POST['check_id_remi'] as $key_remi => $value_remi) {

                $cod_remision = $cls_novedades->get_cod_remision($value_remi);

                if ($cls_novedades->insert_novedad_remisiones($id_novedad, $value_remi, $cod_remision, $id_tipo_novedad, $tipo_novedad, $id_area_afectada, $area_afectada, $id_listado_novedad, $novedad, $observacion)) {
                }
                $php_estado = true;
            }
        }
    }
} else {
    $php_msg = "Falta datos requeridos para crear la novedad remisiones";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'post' => $_POST,
    'key_remi' => $key_remi,
    'value_remi' => $value_remi

);

echo json_encode($datos, JSON_FORCE_OBJECT);
