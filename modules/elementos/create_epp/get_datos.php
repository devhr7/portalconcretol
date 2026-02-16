<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$elementos = new elementos();
$php_msg = "iniciando";
$php_estado = false;

if(intval($_POST['task']) == 1) {

    $id_epp = $_POST['id_epp'];
    $id_tipo_epp = $_POST['id_tipo_epp'];
    $id_tamano = $_POST['id_tamano'];
    $id_color = $_POST['id_color'];

    $nombre_epp = $elementos->get_nombre_epp($id_epp);
    $nombre_tipo_epp = $elementos->get_nombre_tipo_epp($id_tipo_epp);
    $nombre_tamano = $elementos->get_nombre_tamano($id_tamano);
    $nombre_color = $elementos->get_nombre_color($id_color);

    $descripcion = $nombre_epp." ".$nombre_tipo_epp." ".$nombre_tamano." ".$nombre_color;

    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,
        'DescpF' => $descripcion,
    );
    echo json_encode($datos, JSON_FORCE_OBJECT);
}
