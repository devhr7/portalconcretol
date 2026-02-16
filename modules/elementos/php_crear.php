<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$elemento = new elementos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
    
    $fecha = $_POST['fecha'];
    $id_empleado = $_POST['id_empleado'];
    $nombre_empleado = $elemento->get_nombre_empleado($id_empleado);
    $id_cargo = $elemento->get_id_cargo_empleado($id_empleado);
    $nombre_cargo = $elemento->get_nombre_cargo_empleado($id_cargo);
    $id_area = $elemento->get_id_area_empleado($id_empleado);
    $nombre_area = $elemento->get_nombre_area_empleado($id_area);
    $id_elemento_epp = $_POST['id_epp'];
    $nombre_epp = $elemento->get_descripcion_epp($id_elemento_epp);
    $cantidad = $_POST['cantidad'];
    if ($elemento->crear_salida_epp($fecha, $id_empleado ,$nombre_empleado, $id_cargo, $nombre_cargo, $id_area, $nombre_area, $id_elemento_epp, $nombre_epp, $cantidad)) {
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
