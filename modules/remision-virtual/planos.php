<?php
require '../../vendor/autoload.php';
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';

require_once '../../vendor/fpdf182/fpdf.php';
//require_once 'estructura_remi.php';
//$id_batch = $_GET['id'];
$fecha_report = $_GET['txt_fecha'];
include 'datos_remi.php';

$php_clases = new php_clases();

if(file_exists("archivo.txt")){
    unlink("archivo.txt");
}

if(isset($datos_array)){

    $fichero = fopen('archivo.txt','w');
    // Ciclo de escritura 

        foreach ($datos_array as $datos) {
            $num_remi = $datos['ct29_Remision'];
    
            $fecha_remision_remi = $datos['ct29_Fecha'];
            $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
            $fecha_remision_remi = strftime("%A , %d de %B  del %Y", strtotime($fecha));
            $dia = date('d', strtotime($fecha));
            $mes = date('m', strtotime($fecha));
            $year = date('Y', strtotime($fecha));


            $nit_cliente = $datos['ct29_NIT'] . 2342;
            $nombre_cliente_remi = $datos['ct29_IdCliente'];
            $nombre_obra =  $datos['ct29_IdObra'];
            $hora = $datos['ct29_Hora'];
            $placa = $datos['ct29_IdMixer'];
            $conductor = $datos['ct29_MixerDriver'];
            $sello = $datos['ct29_NumeroCilindro'];
            $metros = $datos['ct29_MetrosCubicos'];
            $idplanta = $datos['ct29_IdPlanta'];
            $descripcion_formula = $datos['ct29_DescripcionFormula'];
            $asentamiento = $datos['ct29_Asentamiento'];
            $despachador = $datos['ct29_Responsable'];
            $producto = $datos['ct29_NombreFormula'];
            $codigo_producto = $datos['ct29_CodigoFormula'];
            //$ = $datos[''];
            //$ = $datos[''];


            $nit_cliente = $php_clases->quitar_dv($nit_cliente);

            $datos = '"'.$idplanta.'","'.  $num_remi   .'","900180449"," '. $year .' ","'.$mes.' ","'.$dia.'","F","    "," '. $year .' ","'.$mes.' ","'.$dia.'","                                                                                ","   '.$nit_cliente.'","             ","          '.$codigo_producto.'","          '.$metros.'","        0.00","        0.00","       19.00","        ","        0.00","  0.00","006"," ","0.00","0.00","0.00","0.00","       "," "," 0.00 ","0.00","0.00","0.00","","0.00","","0.00","",0.00';

            fwrite($fichero, $datos. PHP_EOL);

        }
    fclose($fichero);

}

$fileName = basename('archivo.txt');


if (file_exists("archivo.txt")) {
    
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: text/plain");
    //header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    
    //file_get_contents('archivo.txt', true);
    readfile($fileName);
    exit;

    
}else{
    echo "no existe";
}