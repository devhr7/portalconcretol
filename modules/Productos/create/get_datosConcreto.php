<?php

header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$t21_tipoconcreto = new t21_tipoconcreto();
$t22_resistencia_concre = new t22_resistencia_concre();
$t23_tamano_agregado_concre = new t23_tamano_agregado();
$t24_caract_concre = new t24_caract_concre();
$t25_colorconcreto = new t25_colorconcreto();


$rowsArray_TipoConcreto = "";
$rowsArray_Resistencia = "";
$rowsArray_TamanoAgregado = "";
$rowsArray_Caracteristica = "";
$rowsArray_Color = "";

$Estado = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
$php_msg = "iniciando";
$php_estado = false;


// TRAER SELECT CLIENTES
if ($_POST['task'] == 1 && $_POST['tipo'] == "Get_DatosConcreto") {
    $rowsArray_TipoConcreto = "";
    $rowsArray_Resistencia = "";
    $rowsArray_TamanoAgregado = "";
    $rowsArray_Caracteristica = "";
    $rowsArray_Color = "";


    $Estado = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;
    /////////////////////////////////////////////////////////////////////////////

    $id_tipo_concreto  = null;
    $rowsArray_TipoConcreto = $t21_tipoconcreto->get_tipoconcreto();


    $php_estado = true;
    /////////////////////////////////////////////////////////////////////////////
    $id_resistencia_concre = null;
    $rowsArray_Resistencia = $t22_resistencia_concre->get_resistencia_concre();

    


    /////////////////////////////////////////////////////////////////////////////

    $id_tamano_agregado = null;
    $rowsArray_TamanoAgregado = $t23_tamano_agregado_concre->get_tamano_agregado_concre();

    $rowsArray_TamanoAgregado .= '<option value="">Seleccionar </option>';


    /////////////////////////////////////////////////////////////////////////////
    $id_caract_concre = null;
    $rowsArray_Caracteristica = $t24_caract_concre->get_caract_concre();


    /////////////////////////////////////////////////////////////////////////////
    $id_color_concreto = null;
    $rowsArray_Color = $t25_colorconcreto->get_colorconcreto();

    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'TipoConcreto' => $rowsArray_TipoConcreto,
    'Resistencia' => $rowsArray_Resistencia,
    'TamanoAgregado' => $rowsArray_TamanoAgregado,
    'CaracteristicaConcreto' => $rowsArray_Caracteristica,
    'ColorConcreto' => $rowsArray_Color,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
