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
if (isset($_GET['txt_fechaini']) && !empty($_GET['txt_fechaini']) && isset($_GET['txt_fechafin']) && !empty($_GET['txt_fechafin']) && isset($_GET['txt_linea']) && !empty($_GET['txt_linea'])) {

    // Traer Varianles
    $fecha_ini = htmlspecialchars($_GET['txt_fechaini']);
    $fecha_fin = htmlspecialchars($_GET['txt_fechafin']);
    $linea_despacho = htmlspecialchars($_GET['txt_linea']);

    //  Formateando Fecha
    $formato_entrada = "d-m-Y";
    $formato_salida = "Y-m-d";

          //  $fechaF  = date('d-m-Y', strtotime($fecha_ini));
            
    //$fecha_ini =  $php_clases->formatofehaF($fecha_ini, $formato_entrada, $formato_salida);
    //$fecha_fin =  $php_clases->formatofehaF($fecha_fin, $formato_entrada, $formato_salida);

    // Traer datos Plano
    $datos_array = $t26_remisiones->planotxt_remi($fecha_ini, $fecha_fin, $linea_despacho);


    // eliminar txt existente
    if (file_exists("archivo.txt")) {
        unlink("archivo.txt"); // Eliminar Archivo Anterior
        $fichero = fopen('archivo.txt', 'w'); //crear Archivo
    }
    
    if (is_array($datos_array)) { // validad si existe array
        foreach ($datos_array as $datos) {
            $num_remi = $datos['ct26_codigo_remi'];
            $fecha_remision_remi = $datos['ct26_fecha_remi'];
            $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
            $dia = date('d', strtotime($fecha));
            $mes = date('m', strtotime($fecha));
            $year = date('Y', strtotime($fecha));

            $nombre_cliente_remi = $datos['ct26_razon_social'];
            $nombre_obra =  $datos['ct26_nombre_obra'];
            $codigo_producto = $datos['ct26_codigo_producto'];
            $id_planta = $datos['ct26_idplanta'];
            $nit_cliente = $datos['ct26_nitcliente'];
            $metros =$datos['ct26_metros'];
            $nit_cliente = $php_clases->quitar_dv($nit_cliente);
               
            // Dato  Remision
            $datos = '"'.$id_planta.'","' .  $num_remi   . '","900180449"," ' . $year . ' ","' . $mes . ' ","' . $dia . '","F","    "," ' . $year . ' ","' . $mes . ' ","' . $dia . '","                                                                                "," '.$nit_cliente.'  ","             ","' . $codigo_producto . '","   '.$metros.'      ","        0.00","        0.00","       19.00","        ","        0.00","  0.00","006"';

            fwrite($fichero, $datos . PHP_EOL); // escribir Plano txt
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
    } else {
        echo "no existe";
    }
}
