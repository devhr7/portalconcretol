<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$novedades_despacho = new novedades_despacho();
$php_estado = false;
$php_msg = "";

if (isset($_POST['task_novedad']) && !empty($_POST['task_novedad']) && isset($_POST['id_novedad']) && !empty($_POST['id_novedad']) ) {
        // Novedades Generales
    if(intval($_POST['task_novedad']) == 1){
        $id_novedad = $_POST['id_novedad'];
        
        $id_tipo_novedad = $_POST['txt_tipo_novedad'];
        $nombre_tipo_novedad = $novedades_despacho->get_tipo_novedad($id_tipo_novedad);
        $id_area_novedad = $_POST['txt_area_novedad'];
        $area_novedad = $novedades_despacho->get_area_novedad($id_area_novedad);
        $id_listnovedad = $_POST['txt_novedad'];
        $novedad = $novedades_despacho->get_novedad($id_listnovedad);
        $observacion =  $_POST['txt_obs'];

        if($novedades_despacho->guardar_novedades_generales($id_novedad,$id_tipo_novedad, $nombre_tipo_novedad, $id_area_novedad,$area_novedad, $id_listnovedad, $novedad, $observacion)){
            $php_estado = true;
        }
        

    }elseif (intval($_POST['task_novedad']) == 2) {
        $id_novedad = $_POST['id_novedad'];
        $id_remision = $_POST['id_remision'];
        $cod_remision = $novedades_despacho->get_cod_remision($id_remision);
        $id_tipo_novedad = $_POST['txt_tipo_novedad'];
        $nombre_tipo_novedad = $novedades_despacho->get_tipo_novedad($id_tipo_novedad);

        $id_area_novedad = $_POST['txt_area_novedad'];
        $area_novedad = $novedades_despacho->get_area_novedad($id_area_novedad);
        $id_listnovedad = $_POST['txt_novedad'];
        $novedad = $novedades_despacho->get_novedad($id_listnovedad);
        $obs =  $_POST['txt_obs'];

        if($novedades_despacho->insert_novedad_remisiones($id_novedad,$id_remision,$cod_remision,$id_tipo_novedad, $nombre_tipo_novedad, $id_area_novedad,$area_novedad, $id_listnovedad, $novedad, $obs))
        {
            $php_estado = true;
        }

        $php_msg = "Guardo en novedades Remisiones";
        
    }
} else {
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
