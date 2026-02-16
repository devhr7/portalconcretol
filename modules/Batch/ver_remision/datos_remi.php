<?php

//========================================================================================================
// ENCABEZADO
//========================================================================================================
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t29_batch = new t29_batch();

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
setlocale(LC_TIME, 'es_ES');

$titulo = "";
$metros = 0;


//$datos_array = $t29_batch->select_batch_id($id_batch);

$datos_array = $t29_batch->select_batch_remi2($remision_batch);

if (isset($datos_array)) {

    foreach ($datos_array as $datos) {
        
        $num_remi = $datos['ct29_Remision'];
        $estado = 1;
        $fecha_remision_remi = $datos['ct29_Fecha'];
        $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
        $fecha_remision_remi = strftime("%A , %d de %B  del %Y", strtotime($fecha));
        $nombre_cliente_remi = $datos['ct29_IdCliente'];
        $nombre_obra =  $datos['ct29_IdObra'];
        $hora = $datos['ct29_Hora'];
        $placa = $datos['ct29_IdMixer'];
        $conductor = $datos['ct29_MixerDriver'];
        $sello = $datos['ct29_NumeroSello'];
        $metros += $datos['ct29_MetrosCubicos'];
        $idplanta = $datos['ct29_IdPlanta'];
        $descripcion_formula = $datos['ct29_DescripcionFormula'];
        $asentamiento = $datos['ct29_Asentamiento'];
        $despachador = $datos['ct29_Responsable'];
        $producto = $datos['ct29_NombreFormula'];

        //$idplanta  = "RMI";
        //$ = $datos[''];
        //$ = $datos[''];
    }
    switch ($idplanta) {
        case "RMI":
            $planta = "PLANTA UNO";
            $linea_planta = "LINEA " . $idplanta;
            break;
        case "RZO":
            $planta = "PLANTA DOS";
            $linea_planta = "LINEA "  . $idplanta;

            break;
        case "RMT":
            $planta ="PLANTA CT";
            $linea_planta = "LINEA " . $idplanta;


        default:
            $planta = "PLANTA";
            $linea_planta = "";
    }
}
