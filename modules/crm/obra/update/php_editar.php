<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

// $con = new conexionPDO();

$t5_obras = new t5_obras();
$modelo_obras = new modelo_obras();

$resultado = false;
$php_estado = false;
$php_error = false;

if ( isset($_POST['id_obra']) && !empty($_POST['id_obra'])) {
    $id_obra = htmlspecialchars($_POST['id_obra']);
    $id_cliente = (int)htmlspecialchars($_POST['cliente']);
    $nombre_obra = htmlspecialchars($_POST['nombre_obra']);
    $id_departamento = htmlspecialchars($_POST['departamento']);
    $nombre_departamento = $modelo_obras->get_nombre_departamento($id_departamento);
    $id_ciudad = htmlspecialchars($_POST['municipio']);
    $nombre_ciudad = $modelo_obras->get_nombre_ciudad($id_ciudad);
    $id_comuna = htmlspecialchars($_POST['comuna']);
    $nombre_comuna = $modelo_obras->get_nombre_comuna($id_comuna);
    $barrio = htmlspecialchars($_POST['barrio']);
    $segmento = htmlspecialchars($_POST['segmento']);
    $direccion_obra = htmlspecialchars($_POST['direccion']);

    $longitud = htmlspecialchars($_POST['txt_longitud']);
    $latitud = htmlspecialchars($_POST['txt_latitud']);

    $distanciaRMI = htmlspecialchars($_POST['txt_distanciaRMI']);
    $distanciaRZO = htmlspecialchars($_POST['txt_distanciaRZO']);
    $distanciaRMT = htmlspecialchars($_POST['txt_distanciaRMT']);
    $distanciaHND = htmlspecialchars($_POST['txt_distanciaHND']);
    
    $result = $t5_obras->editar_obra($id_obra, $id_cliente, $nombre_obra, $id_departamento, $nombre_departamento, $id_ciudad, $nombre_ciudad, $id_comuna, $nombre_comuna, $barrio, $segmento, $direccion_obra);

    if ($result) {
        $modelo_obras->update_latitud_longitud($id_obra, $latitud, $longitud);
        $modelo_obras->update_distancias($id_obra, $distanciaRMI, $distanciaRZO, $distanciaRMT, $distanciaHND);
        $php_estado = true;
    } else {
        $php_estado = false;
        $php_error = "error al guardar en la base de datos";
    }
} else {
    $php_error = "faltan campos requeridos";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
