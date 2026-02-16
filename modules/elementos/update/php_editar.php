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
    $fecha = $_POST['fecha'];
    $id_empleado = $_POST['id_empleado'];
    $nombre_empleado = $elementos->get_nombre_empleado($id_empleado);
    $id_cargo = $elementos->get_id_cargo_empleado($id_empleado);
    $nombre_cargo = $elementos->get_nombre_cargo_empleado($id_cargo);
    $id_area = $elementos->get_id_area_empleado($id_empleado);
    $nombre_area = $elementos->get_nombre_area_empleado($id_area);
    $id_elemento_epp = $_POST['id_epp'];
    $nombre_epp = $elementos->get_descripcion_epp($id_elemento_epp);
    $cantidad = $_POST['cantidad'];
    if ($elementos->editar_salida_epp($id, $fecha, $id_empleado, $nombre_empleado, $id_cargo, $nombre_cargo, $id_area, $nombre_area, $id_elemento_epp, $nombre_epp, $cantidad)) {
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
