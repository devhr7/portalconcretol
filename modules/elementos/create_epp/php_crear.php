<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$elemento = new elementos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['id_epp']) && !empty($_POST['id_epp'])) {
    
    $id_epp = $_POST['id_epp'];
    $nombre_epp = $elemento->get_nombre_epp($id_epp);
    $id_tipo_epp = $_POST['id_tipo_epp'];
    $nombre_tipo_epp = $elemento->get_nombre_tipo_epp($id_tipo_epp);
    $id_tamano = $_POST['id_tamano'];
    $nombre_tamano = $elemento->get_nombre_tamano($id_tamano);
    $id_color = $_POST['id_color'];
    $nombre_color = $elemento->get_nombre_color($id_color);

    if ($elemento->crear_elemento_epp($id_epp,  $nombre_epp,$id_tipo_epp, $nombre_tipo_epp, $id_tamano, $nombre_tamano, $id_color, $nombre_color)) {
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
