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


    $id_tipo_concreto = $_POST['id_tipo_concreto'];
    $id_resistencia_concre = $_POST['id_resistencia_concre'];
    $id_tamano_agregado = $_POST['id_tamano_agregado'];
    $id_caract_concre = $_POST['id_caract_concre'];
    $id_color_concreto = $_POST['id_color_concre'];


    /////////////////////////////////////////////////////////////////////////////

    //$id_tipo_concreto  = null;
    $datos_tipoconcreto = $t21_tipoconcreto->get_tipoconcreto();

    $rowsArray_TipoConcreto .= '<option value="">Seleccionar </option>';

    if ($datos_tipoconcreto) {


        foreach ($datos_tipoconcreto as $fila_tipoconcr) {
            //selected
            if ($id_tipo_concreto == $fila_tipoconcr['ct21_IdTipoConcreto']) {
                $selection_tipo_concreto = "selected='true'";
            } else {
                $selection_tipo_concreto = "";
            }

            $rowsArray_TipoConcreto .= '<option value="' . $fila_tipoconcr['ct21_IdTipoConcreto'] . '" ' . $selection_tipo_concreto . ' >' . $fila_tipoconcr['ct21_CodTConcreto'] . " - " . $fila_tipoconcr['ct21_DescripcionTC'] . '</option>';
        }
    }
    $php_estado = true;
    /////////////////////////////////////////////////////////////////////////////
    //$id_resistencia_concre = null;
    $datos_resistencia_concre = $t22_resistencia_concre->get_resistencia_concre();

    $rowsArray_Resistencia .= '<option value="">Seleccionar </option>';

    if ($datos_resistencia_concre) {
        foreach ($datos_resistencia_concre as $fila_resistconcr) {
            //selected
            if ($id_resistencia_concre == $fila_resistconcr['ct22_IdResistenciaConcreto']) {
                $selection_resistencia_concre = "selected='true'";
            } else {
                $selection_resistencia_concre = "";
            }
            $rowsArray_Resistencia .= '<option value="' . $fila_resistconcr['ct22_IdResistenciaConcreto'] . '"  ' . $selection_resistencia_concre . ' >' . $fila_resistconcr['ct22_CodResistenciaConcreto'] . " - " . $fila_resistconcr['ct22_DescripcionRC'] . '</option>';
        }
    }


    /////////////////////////////////////////////////////////////////////////////

    //$id_tamano_agregado = null;
    $datos_tamano_agregado_concre = $t23_tamano_agregado_concre->get_tamano_agregado_concre();

    $rowsArray_TamanoAgregado .= '<option value="">Seleccionar </option>';

    if ($datos_tamano_agregado_concre) {
        foreach ($datos_tamano_agregado_concre as $fila_tamanoconcr) {
            //selected
            if ($id_tamano_agregado == $fila_tamanoconcr['ct23_IdTAC']) {
                $selection_tamano_agregado = "selected='true'";
            } else {
                $selection_tamano_agregado = "";
            }
            $rowsArray_TamanoAgregado .= '<option value="' . $fila_tamanoconcr['ct23_IdTAC'] . '"  ' . $selection_tamano_agregado . ' >' . $fila_tamanoconcr['ct23_CodTAC'] . " - " . $fila_tamanoconcr['ct23_DescripcionTAC'] . '</option>';
        }
    }

    /////////////////////////////////////////////////////////////////////////////
    //$id_caract_concre = null;
    $datos_caract_concre = $t24_caract_concre->get_caract_concre();

    $rowsArray_Caracteristica .= '<option value="">Seleccionar </option>';

    if ($datos_caract_concre) {
        foreach ($datos_caract_concre as $fila_caract) {
            //selected
            if ($id_caract_concre == $fila_caract['ct24_IdCC']) {
                $selection_caract_concre = "selected='true'";
            } else {
                $selection_caract_concre = "";
            }
            $rowsArray_Caracteristica .= '<option value="' . $fila_caract['ct24_IdCC'] . '"  ' . $selection_caract_concre . ' >' . $fila_caract['ct24_CodCC'] . " - " . $fila_caract['ct24_DescripcionCC'] . '</option>';
        }
    }

    /////////////////////////////////////////////////////////////////////////////
    //$id_color_concreto = null;
    $datos_colorconcreto = $t25_colorconcreto->get_colorconcreto();

    $rowsArray_Color .= '<option value="">Seleccionar </option>';

    if ($datos_colorconcreto) {
        foreach ($datos_colorconcreto as $fila_colorconcr) {
            //selected
            if ($id_color_concreto == $fila_colorconcr['ct25_IdColorC']) {
                $selection_color_concre = "selected='true'";
            } else {
                $selection_color_concre = "";
            }
            $rowsArray_Color .= '<option value="' . $fila_colorconcr['ct25_IdColorC'] . '"  ' . $selection_color_concre . ' >' . $fila_colorconcr['ct25_CodConcreto'] . " - " . $fila_colorconcr['ct25_DescripcionCC'] . '</option>';
        }
    }



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
