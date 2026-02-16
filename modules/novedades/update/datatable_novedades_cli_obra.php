<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$data = false;


if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] ) && isset($_POST['id_cliente']) && !empty($_POST['id_cliente'] ) &&  isset($_POST['id_obra']) && !empty($_POST['id_obra'] )  ){
    $data = $cls_novedades->select_novedades_cli_obra($_POST['id_novedad'],$_POST['id_cliente'],$_POST['id_obra']);
    
}




//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);