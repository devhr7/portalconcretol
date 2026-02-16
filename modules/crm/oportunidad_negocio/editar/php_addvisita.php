<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;

if (isset($_POST['id_oportunidad']) && !empty($_POST['id_oportunidad']) && isset($_POST['fecha_vist']) && !empty($_POST['fecha_vist'])) {

    $fecha = $_POST['fecha_vist'];
    $id_oportunidad = $_POST['id_oportunidad'];
    $resultado = $_POST['result_vist'];
    if (!empty($_POST['motivo_perdida'])) {
        $id_motivo_perdida = $_POST['motivo_perdida'];
        $nombre_motivo = $op->get_nombre_motivo_perdida($id_motivo_perdida);
    } else {
        $id_motivo_perdida = 6;
        $nombre_motivo = $op->get_nombre_motivo_perdida($id_motivo_perdida);
    }
    $observacion = $_POST['obs_visit'];
    /**
     * STATUS
     * 1- Aprobado
     * 2- En Progreso
     * 10- Rechazado 
     */
    if ($id_lastinsert = $op->crear_visita($id_oportunidad, $fecha, $resultado, $id_motivo_perdida, $nombre_motivo, $observacion)) {
        $op->actualizar_resultado_op($id_oportunidad, $resultado);
        $php_estado = true;
    } else {
        $php_estado = false;
    }
    $st = $op->get_id_status($id_oportunidad);

    if ($st == 3 || $st == 4) {
        $resultado = 2;
        $op->actualizar_resultado($id_oportunidad, $resultado);
    } else {
        $resultado = 1;
        $op->actualizar_resultado($id_oportunidad, $resultado);
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'id_last' => $id_lastinsert,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
