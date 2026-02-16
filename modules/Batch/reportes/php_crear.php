<?php

session_start();
header('Content-Type: application/json');



require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();
$t29_batch = new t29_batch();
//$id_batch = $_POST['txt_remision_batch'];
$php_estado = false;
$rst = "";
$metros = 0;

if(isset($_POST['txt_remision_batch'])&&!empty($_POST['txt_remision_batch'])){

    $numero_remi = $php_clases->HR_Crypt($_POST['txt_remision_batch'], 2);
    $numero_remi = intval($numero_remi);
    $datos_remision = $t29_batch->select_batch_remi2($numero_remi);
    

    if($datos_remision){
        foreach ($datos_remision as $datos) {
            //$remision = $fila1['ct29_Remision'];
            $num_remi = $datos['ct29_Remision'];
            $fecha_remision_remi = $datos['ct29_Fecha'];
            $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
            //$fecha_remision_remi = strftime("%A , %d de %B  del %Y", strtotime($fecha));
            $nombre_cliente_remi = $datos['ct29_IdCliente'];
            $nombre_obra =  $datos['ct29_IdObra'];
            $hora = $datos['ct29_Hora'];
            $placa = $datos['ct29_IdMixer'];
            $conductor = $datos['ct29_MixerDriver'];
            $sello = $datos['ct29_NumeroCilindro'];
            $metros += $datos['ct29_MetrosCubicos'];
            $idplanta = $datos['ct29_IdPlanta'];
            $descripcion_formula = $datos['ct29_DescripcionFormula'];
            $asentamiento = $datos['ct29_Asentamiento'];
            $despachador = $datos['ct29_Responsable'];
            $producto = $datos['ct29_NombreFormula'];
        }






        $php_estado = true;
    }else{
        $php_estado = false;
    }
}else{
    $php_estado = false;
}

$datos = array(
    'estado' => $php_estado,
    'resultado'=> $rst,
);


echo json_encode($datos, JSON_FORCE_OBJECT);