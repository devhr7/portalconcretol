<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$data = false;


if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] )){
    if(isset($_POST['id_remision']) && !empty($_POST['id_remision'] ) ){
        $data = $cls_novedades->select_novedad_remisiones($_POST['id_remision']);
        

    }else{
        
        $data = $cls_novedades->select_novedad_generales($_POST['id_novedad']);
    }
}




//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);