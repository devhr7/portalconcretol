<?php

//========================================================================================================
// ENCABEZADO
//========================================================================================================
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();

$t29_batch = new t29_batch();

$remi = $t29_batch->select_batch_id($id_batch);

foreach ($remi as $datos) {
 
    $cod_remi           = $datos['ct29_Remision'];
    $fecha_remi         = $datos['ct29_Fecha'];
    $cliente_remi       = $datos['ct29_IdCliente'];
    $obra_remi          = $datos['ct29_IdObra'];
    $hora_remi          = $datos['ct29_Hora'];
    $placa_remi         = $datos['ct29_IdMixer'];
    $conductor_remi     = $datos['ct29_MixerDriver'];
    $planta_remi        = $datos['ct29_IdPlanta'];
    $sello_remi         = $datos['ct29_NumeroSello'];
    $metrosC_remi       = $datos['ct29_MetrosCubicos'];
    $producto_remi      = $datos['ct29_DescripcionFormula'];
    $asentamiento_remi  = $datos['ct29_Asentamiento'];

}

//$titulo = "";


//$fecha_remi = $t26_remisiones->fecha;
//$cliente_remi = $t26_remisiones;
//$obra_remi = $t26_remisiones;
//$hora_remi = $t26_remisiones;
//$placa_remi = $t26_remisiones;
//$conductor_remi = $t26_remisiones;
//$planta_remi = $t26_remisiones;
//$sello_remi = $t26_remisiones;
//$metrosC_remi = $t26_remisiones;
//$producto_remi = $t26_remisiones;
//$asentamiento_remi = $t26_remisiones;