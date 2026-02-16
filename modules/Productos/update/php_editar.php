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
$php_error = "";
$resultado = "";

if (isset($_POST['Txb_TipoConcreto']) && !empty($_POST['Txb_TipoConcreto']) && isset($_POST['Txb_ResistenciaConcreto']) && !empty($_POST['Txb_ResistenciaConcreto'])) {
    // $estado = 1;
    // $codigo_syscafe = 123;
    $tipo_concreto = $_POST['Txb_TipoConcreto'];
    $resistencia_concreto = $_POST['Txb_ResistenciaConcreto'];
    $tamano_agregado_concreto = $_POST['Txb_TMAgregado'];
    $caract_concre = $_POST['Txb_CrtConcreto'];
    $color_concreto = $_POST['Txb_ColorConcreto'];
    $codigo_concre = $_POST['Txb_Nombre'];
    $descripcion_concre = $_POST['Txb_Descripcion'];
    // $nombre = "Nombre";
    // $descripcion = "Descripcion";
    $id = $_POST['txt_id'];
    if ($t4_productos->actualizar_producto($id, $tipo_concreto, $resistencia_concreto, $tamano_agregado_concreto, $caract_concre, $color_concreto, $codigo_concre, $descripcion_concre)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
} else {
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
