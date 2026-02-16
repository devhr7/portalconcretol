<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$php_msg = "";
$id_novedad  = 0;

$cls_novedades = new novedades_despacho();

if (isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad']) ){
    if($id_novedad = $cls_novedades->insertar_novedad_despacho($_POST['fecha_novedad'])){
        $php_estado = true;
    }else{
        $php_msg = "No Guardo Correctamente";
        $php_estado = false;
    }
}else{
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'id_novedad' => $id_novedad,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
