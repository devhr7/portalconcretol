<?php

//importar
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Definiendo clases
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();


//definiendo Variables
$php_estado = false;
$errores = array();
$exitoso = array();
$dt = array();

///////////////////////////////////////////////77
if (isset($_POST['txt_fechaini']) && !empty($_POST['txt_fechaini']) && isset($_POST['txt_fechafin']) && !empty($_POST['txt_fechafin']) && isset($_POST['txt_linea']) && !empty($_POST['txt_linea'])) {

    $fecha_ini = htmlspecialchars($_POST['txt_fechaini']);
    $fecha_fin = htmlspecialchars($_POST['txt_fechafin']);
    $linea_despacho = htmlspecialchars($_POST['txt_linea']);

    $formato_entrada = "d-m-Y";
    $formato_salida = "Y-m-d";
    $fecha_ini =  $php_clases->formatofehaF($fecha_ini,$formato_entrada,$formato_salida);
    $fecha_fin =  $php_clases->formatofehaF($fecha_fin,$formato_entrada,$formato_salida);

   
    //include 'datos_remi.php';


    //header("Location: archivo.php?fechaini=$fecha_ini&fecha_fin=$fecha_fin&linea_despacho=$linea_despacho");



    $datos_array = $t26_remisiones->planotxt_remi($fecha_ini, $fecha_fin, $linea_despacho);

    if(file_exists("archivo.txt")){
        unlink("archivo.txt");
    }
    
    if(isset($datos_array)){
    
        $fichero = fopen('archivo.txt','w');
        // Ciclo de escritura 
            foreach ($datos_array as $datos) {
                $num_remi = $datos['ct29_Remision'];
        
                $fecha_remision_remi = $datos['ct26_fecha_remi'];
                $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
                $dia = date('d', strtotime($fecha));
                $mes = date('m', strtotime($fecha));
                $year = date('Y', strtotime($fecha));
    
    
                $nit_cliente = $datos['ct26_nitcliente'] ;
                $nombre_cliente_remi = $datos['ct26_razon_social'];
                $nombre_obra =  $datos['ct26_nombre_obra'];
                $hora = "";//$datos['ct29_Hora'];
                $placa ="";// $datos['ct29_IdMixer'];
                $conductor = "";//$datos['ct29_MixerDriver'];
                $sello = "";//$datos['ct29_NumeroCilindro'];
                $metros = $datos['ct26_metros'];
                $idplanta =$datos['ct26_idplanta'];
                $descripcion_formula = "";//$datos['ct29_DescripcionFormula'];
                $asentamiento ="";// $datos['ct29_Asentamiento'];
                $despachador = "";//$datos['ct29_Responsable'];
                $producto = "";//$datos['ct29_NombreFormula'];
                $codigo_producto = $datos['ct26_codigo_producto'];
                //$ = $datos[''];
                //$ = $datos[''];
    
    
                $nit_cliente = $php_clases->quitar_dv($nit_cliente);
    
                $datos = '"'.$idplanta.'","'.  $num_remi   .'","900180449"," '. $year .' ","'.$mes.' ","'.$dia.'","F","    "," '. $year .' ","'.$mes.' ","'.$dia.'","                                                                                ","   '.$nit_cliente.'","             ","          '.$codigo_producto.'","          '.$metros.'","        0.00","        0.00","       19.00","        ","        0.00","  0.00","006"';
    
                                

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
        header("Content-Transfer-Encoding: binary");
        readfile($fileName);        
    }else{
        echo "no existe";
    }
    

    $php_estado = true;
    $dt[] = "Vamos bien =".$fecha_ini ." - ".$fecha_fin;

}else{
    $errores[] = "Faltan completar los campos requeridos";
}


