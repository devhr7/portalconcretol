<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$php_clases = new php_clases();
$op = new oportunidad_negocio;

if (isset($_POST['nombre_completo']) && !empty($_POST['nombre_completo'])) {
    
    $fecha = "" . date("Y-m-d H:i:s");
    $asesora_comercial = $_POST['asesora_comercial'];
    $id_sede = $_POST['sede'];
    $nombre_sede = $op->get_nombre_sede($id_sede);
    $fecha_contacto = $_POST['fecha_contacto'];
    $departamento = $_POST['departamento'];
    $municipio = $_POST['municipio'];

    if (isset($_POST['comuna']) && !empty($_POST['comuna'])) {
        $comuna = $_POST['comuna'];
    } else {
        $comuna = NULL;
    }

    $barrio = preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['barrio']));
    $tipo_cliente = $_POST['tipo_cliente'];

    if (isset($_POST['tipo_plan_maestro']) && !empty($_POST['tipo_plan_maestro'])) {
        $tipo_plan_maestro = $_POST['tipo_plan_maestro'];
    } else {
        $tipo_plan_maestro = 3;
    }

    $nombre_obra = preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_obra']));
    $telefono_cliente = preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['telefono_cliente']);
    $nit = preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['nit']);
    $nombre_completo = preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_completo']));
    $ap_completo = preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['ap_completo']));
    $nombre_maestro = preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_maestro']));
    $direccion_obra = strtoupper($_POST['direccion_obra']);
    $celular_maestro = preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['celular_maestro']);
    $m3_potenciales = $_POST['m3_potenciales'];
    $fecha_posible_fundida = $_POST['fecha_posible_fundida'];
    $resultado = $_POST['resultado'];
    $contacto_cliente = $_POST['contacto_cliente'];

    if (isset($_POST['observacion']) && !empty($_POST['observacion'])) {
        $observaciones = $_POST['observacion'];
    } else {
        $observaciones = NULL;
    }

    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */

    if ($id_lastinsert = $op->crear_oportunidad_negocio($asesora_comercial, $id_sede, $nombre_sede, $fecha_contacto, $tipo_cliente, $tipo_plan_maestro, $departamento, $municipio, $comuna, $barrio, $nit, $nombre_completo, $ap_completo, $nombre_obra, $direccion_obra, $telefono_cliente, $nombre_maestro, $celular_maestro, $m3_potenciales, $fecha_posible_fundida, $resultado, $contacto_cliente, $observaciones)) {
        $boton  = "<a href='../editar/editar.php?id=" . $id_lastinsert . "' class='btn btn-block btn-warning'> Agregar Visitas</a>";
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
    'boton' => $boton,
    'id_last' => $id_lastinsert,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
