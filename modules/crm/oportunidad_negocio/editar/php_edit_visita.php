<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;


if (isset($_POST['id_visita']) && !empty($_POST['id_visita']) &&
    isset($_POST['edit_fecha_vist']) && !empty($_POST['edit_fecha_vist'])) {
    
    $id = $_POST['id_visita'];
    $id_oportunidad = intval($_POST['id_oportunidad_edit']);
    $fecha = $_POST['edit_fecha_vist'];
    $resultado = $_POST['edit_result_visit'];
    if (!empty($_POST['edit_motivo_perdida'])) {
        $id_motivo_perdida = $_POST['edit_motivo_perdida'];
        $nombre_motivo = $op->get_nombre_motivo_perdida($id_motivo_perdida);
    } else {
        $id_motivo_perdida = 6;
        $nombre_motivo = $op->get_nombre_motivo_perdida($id_motivo_perdida);
    }
    $observacion = $_POST['edit_obs_visit'];


    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */

    if ($id_lastinsert = $op->edit_visita($id, $fecha, $resultado, $id_motivo_perdida, $nombre_motivo, $observacion)) {
        if (is_array($arraydata = $op->getdate_for_id(intval($id_oportunidad)))) {
            $php_estado = true;
            foreach ($arraydata as $key) {
                if (intval($id) == intval($key['id'])) {
                    $op->actualizar_resultado_op($id_oportunidad, $resultado);
                }
            }
        }
        $php_estado = true;
    } else {
        $php_estado = false;
    }
    $st = $op->get_id_status($id_oportunidad);

    if($st == 3 || $st == 4){
        $resultado = 2;
        $op->actualizar_resultado($id_oportunidad, $resultado);
    }else{
        $resultado = 1;
        $op->actualizar_resultado($id_oportunidad, $resultado);
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
