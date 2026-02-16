<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;
$visita_clientes = new visitas_clientes();

if (isset($_POST['id_visita']) && !empty($_POST['id_visita']) && isset($_POST['edit_fecha_vist']) && !empty($_POST['edit_fecha_vist']))
{
    $id = $_POST['id_visita'];
    $fecha = $_POST['edit_fecha_vist'];
    $id_tipo_visita = $_POST['edit_result_visit'];
    $tipo_visita = $visita_clientes->get_nombre_tipo_visita($id_tipo_visita);
    $observacion = $_POST['edit_obs_visit'];
    $id_cliente = intval($_POST['id_clente_edit']);
    
    if(isset($_POST['txt_obra_editar'])){
        $id_obra = $_POST['txt_obra_editar'];
    }else{
        $id_obra = null;
    }
    $nombre_obra = $visita_clientes->get_nombre_obra($id_obra);

    if($id_lastinsert = $visita_clientes->edit_visita_cliente($id, $fecha, $id_tipo_visita, $tipo_visita, $id_obra, $nombre_obra, $observacion)){
        $php_estado = true;
    }else{
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