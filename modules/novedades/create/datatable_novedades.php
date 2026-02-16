<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();

if(isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad'])){
    $data = $cls_novedades->select_novedad_despacho($_POST['fecha_novedad']);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);