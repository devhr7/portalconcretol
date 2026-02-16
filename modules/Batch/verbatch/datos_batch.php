<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$t29_batch = new t29_batch();
$php_clases = new php_clases();
         
$id_batch = $_GET['id'];            

if(isset($_GET['vk'])){
    if($_GET['vk'] == 'cancel'){
        $datos_batch = $t29_batch->select_batch_id_cancel($id_batch);  
    }else{
        header ('location: ../index.php');
    }
}else{
$datos_batch = $t29_batch->select_batch_id($id_batch);

}



if ($datos_batch) {
    foreach ($datos_batch as $fila_batch) {

        $remision_batch     = $fila_batch['ct29_Remision'];

        $fecha_bath         = $fila_batch['ct29_Fecha'];
        $Hora_batch         = $fila_batch['ct29_Hora'];

        $nit_cliente        = $fila_batch['ct29_NIT'];
        $cliente            = $fila_batch['ct29_IdCliente'];
        $mixer_batch        = $fila_batch['ct29_IdMixer'];

        $obra               = $fila_batch['ct29_IdObra'];
        $conductor          = $fila_batch['ct29_MixerDriver'];

        $planta             = $fila_batch['ct29_IdPlanta'];
        $sello_seguridad    = $fila_batch['ct29_NumeroCilindro'];

        $metros_batch       = $fila_batch['ct29_MetrosCubicos'];

        $codigo_producto = $fila_batch['ct29_CodigoFormula'];
        $nombre_formula = $fila_batch['ct29_NombreFormula'];
        $descripcion_formula = $fila_batch['ct29_DescripcionFormula'];

        $producto_batch     =  $codigo_producto ." - ".$descripcion_formula;
        $asentamiento_batch = $fila_batch['ct29_Asentamiento'];
        $observaciones      = $fila_batch['ct29_OBSERVACIONES'];
    }
}

