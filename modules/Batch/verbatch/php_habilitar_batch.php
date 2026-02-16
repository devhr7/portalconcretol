<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t29_batch = new t29_batch();

//php_habilitar_batch.php

$php_estado = false;
$rst = "";

$suma= 0;
if(isset($_POST['id_batch']) && !empty($_POST['id_batch'])){
    
    $id_batch = $_POST['id_batch'];

    for($i = 0; $i < count($id_batch); ++$i) {

        $anulado = $t29_batch->anular_batch($id_batch[$i]);

        if($anulado){
            $error= "El Batch ". $id_batch[$i] . " fue anulado exitosamente"; 
            $php_estado = true;    
        }else{
            $error= "Error al anular el batch". $id_batch[$i]; 
        }
    }
}else{
    $error = "Debe Seleccionar el batch para poder anular";
}

$datos = array(
    'estado' => $php_estado,
    'phperror' => $error,
    
);


echo json_encode($datos, JSON_FORCE_OBJECT);