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
if ($_POST['task'] == 2 && $_POST['tipo'] == "Get_Datos1") {

    $CodTipoConcreto = "00";
    $CodResistConcreto = "000";
    $CodiTMA = "0";
    $CodiCaract = "000";
    $CodiColor = "00";


    $DescripcionTConcreto = "";
    $DescpResistConcreto = "";
    $DescpTMA = "";
    $DescpCaract = "";
    $DescpColor = "";




    $Txb_TipoConcreto = $_POST['Txb_TipoConcreto'];
    $Txb_ResistenciaConcreto = $_POST['Txb_ResistenciaConcreto'];
    $Txb_TMAgregado = $_POST['Txb_TMAgregado'];
    $Txb_CrtConcreto = $_POST['Txb_CrtConcreto'];
    $Txb_ColorConcreto = $_POST['Txb_ColorConcreto'];
    $Estado = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;


    /////////////////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////////////////////////////////////

    $datos_tipoconcreto = $t21_tipoconcreto->get_tipoconcreto_id($Txb_TipoConcreto);

    if ($datos_tipoconcreto) {
        foreach ($datos_tipoconcreto as $fila_tipoconcr) {
            $CodTipoConcreto = $fila_tipoconcr['ct21_CodTConcreto'];
            $DescripcionTConcreto = $fila_tipoconcr['ct21_DescripcionTC'];
        }
    }
    $php_estado = true;
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $datos_resistencia_concre = $t22_resistencia_concre->get_resistencia_concre_id($Txb_ResistenciaConcreto);

    if ($datos_resistencia_concre) {
        foreach ($datos_resistencia_concre as $fila_resistconcr) {
            $CodResistConcreto = $fila_resistconcr['ct22_CodResistenciaConcreto'];
            $DescpResistConcreto = $fila_resistconcr['ct22_DescripcionRC'];
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $datos_tamano_agregado_concre = $t23_tamano_agregado_concre->get_tamano_agregado_concre_id($Txb_TMAgregado);
    if ($datos_tamano_agregado_concre) {
        foreach ($datos_tamano_agregado_concre as $fila_tamanoconcr) {
            $CodiTMA = $fila_tamanoconcr['ct23_CodTAC'];
            $DescpTMA = $fila_tamanoconcr['ct23_DescripcionTAC'];
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $datos_caract_concre = $t24_caract_concre->get_caract_concre_id($Txb_CrtConcreto);

    if ($datos_caract_concre) {
        foreach ($datos_caract_concre as $fila_caract) {
            $CodiCaract = $fila_caract['ct24_CodCC'];
            $DescpCaract = $fila_caract['ct24_DescripcionCC'];
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $datos_colorconcreto = $t25_colorconcreto->get_colorconcreto_id($Txb_ColorConcreto);

    if ($datos_colorconcreto) {
        foreach ($datos_colorconcreto as $fila_colorconcr) {
            $CodiColor = $fila_colorconcr['ct25_CodConcreto'];
            $DescpColor = $fila_colorconcr['ct25_DescripcionCC'];
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $codigoconcretof = $CodTipoConcreto . "" . $CodResistConcreto . "" . $CodiTMA . "" . $CodiCaract . "" . $CodiColor;
    $DesCripCocnretoF = $DescripcionTConcreto . " " . $DescpResistConcreto . " " . $DescpTMA . " " . $DescpCaract . " " . $DescpColor ;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,
        'CodigoF' => $codigoconcretof,
        'DescpF' => $DesCripCocnretoF,
    );
    echo json_encode($datos, JSON_FORCE_OBJECT);
}
