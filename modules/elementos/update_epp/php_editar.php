<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$elementos = new elementos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla color del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['id_epp']) && !empty($_POST['id_epp'])) {
    $id = $_POST['id'];
    $id_epp = $_POST['id_epp'];
    $nombre_epp = $elementos->get_nombre_epp($id_epp);
    $id_tipo_epp = $_POST['id_tipo_epp'];
    $nombre_tipo_epp = $elementos->get_nombre_tipo_epp($id_tipo_epp);
    $id_tamano = $_POST['id_tamano'];
    $nombre_tamano = $elementos->get_nombre_tamano($id_tamano);
    $id_color = $_POST['id_color'];
    $nombre_color = $elementos->get_nombre_color($id_color);
    if ($elementos->editar_elemento_epp($id, $id_epp, $nombre_epp, $id_tipo_epp, $nombre_tipo_epp, $id_tamano, $nombre_tamano,$id_color, $nombre_color)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
