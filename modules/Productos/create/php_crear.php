<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$t4_productos = new t4_productos();
$t21_tipoconcreto = new t21_tipoconcreto();
$t22_resistencia_concre = new t22_resistencia_concre();
$t23_tamano_agregado_concre = new t23_tamano_agregado();
$t24_caract_concre = new t24_caract_concre();
$t25_colorconcreto = new t25_colorconcreto();
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['Txb_Descripcion']) && !empty($_POST['Txb_Descripcion']) && isset($_POST['Txb_Nombre']) && !empty($_POST['Txb_Nombre'])) {

    date_default_timezone_set('America/Bogota');

    $fecha_create = "" . date("Y-m-d H:i:s");

    $estado = 1;
    $codigo_syscafe  = htmlspecialchars($_POST['Txb_Nombre']);
    $tipo_concreto = htmlspecialchars($_POST['Txb_TipoConcreto']);
    $resistencia = htmlspecialchars($_POST['Txb_ResistenciaConcreto']);
    $tamanoagregado = htmlspecialchars($_POST['Txb_TMAgregado']);
    $caract_concre = htmlspecialchars($_POST['Txb_CrtConcreto']);
    $color = htmlspecialchars($_POST['Txb_ColorConcreto']);

    $nombre = htmlspecialchars($_POST['Txb_Nombre']);
    $descripcion = htmlspecialchars($_POST['Txb_Descripcion']);


    $validarExistencias = $general_modelos->existencia('ct4_productos', 'ct4_Nombre', $nombre);

    if ($validarExistencias) {
        $result = $t4_productos->crear_producto($fecha_create, $estado, $codigo_syscafe, $tipo_concreto, $resistencia, $tamanoagregado, $caract_concre, $color, $nombre, $descripcion);

        if ($result) {
            $php_estado = true;
        } else {
            $php_error = "Error al guardar BD";
        }
    } else {
        $php_error = "Este producto ya existe en la Base de datos";
    }
} else {
    $php_error = "Faltan completar los campos Requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
