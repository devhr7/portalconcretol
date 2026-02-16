<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$cls_visitas_comerciales = new cls_visitas_comerciales();
$boolPhpEstado = false;
$objSelectObras = "";
$oportunidad_negocio = new oportunidad_negocio();

if ($_POST['task'] == 1) {
    //Select de los clientes
    //$objvisitas_comerciales  = $cls_visitas_comerciales->();
    $select_comercial = $oportunidad_negocio->select_comercial();
    $datos = array(
        'select_comercial' => $select_comercial,
    );
}else{
    $datos = array(
        'select_comercial' => "select_comercial",
    );
} 
echo json_encode($datos, JSON_FORCE_OBJECT);