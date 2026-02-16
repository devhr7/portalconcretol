<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";
$id_lastinsert = "";
$op = new oportunidad_negocio();
$visita_clientes = new visitas_clientes();

if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente']) &&
    isset($_POST['fecha_vist']) && !empty($_POST['fecha_vist'])) {

    $id_cliente = $_POST['id_cliente'];
    $fecha = $_POST['fecha_vist'];
    $id_tipo_visita = $_POST['objetivo_visita'];
    $observacion = $_POST['obs_visit'];
    $id_obra = null;
    $nombre_obra = null;

    $nombre_cliente = $visita_clientes->get_nombre_cliente($id_cliente);
    $tipo_visita = $visita_clientes->get_nombre_tipo_visita($id_tipo_visita);
    /**
     * STATUS
     * 1- Aprobado
     * 2- En Progreso
     * 10- Rechazado 
     */
    if ($id_lastinsert = $visita_clientes->crear_vista_cliente($fecha, $id_tipo_visita, $tipo_visita, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $observacion)) {
        // $op->actualizar_resultado_op($id_cliente, $resultado);
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
    'id_last' => $id_lastinsert,
    'post' => $_POST,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
