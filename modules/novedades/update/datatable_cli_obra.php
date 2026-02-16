<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//$oportunidad_negocio = new oportunidad_negocio();
$novedades_despacho = new novedades_despacho();

if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad']) && isset($_POST['id_novedad']) && !empty($_POST['id_novedad']) ){
    $data = $novedades_despacho->select_datos_cliente($_POST['id_novedad']);
    //$data = $novedades_despacho->dt_oportunidad_negocio();

}



//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);