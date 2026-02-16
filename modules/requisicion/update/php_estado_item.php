<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//$con = new conexionPDO();
$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;


if (isset($_POST['task']) && !empty($_POST['task']) && isset($_POST['id']) && !empty($_POST['id'])) {

    $con = $cls_requisiciones->conexionsql();

    // 
    if(intval($_POST['task']) == 1){
        $estado = 3;
        $cls_requisiciones::actualizar_estado_cotizaciones($con,$_POST['id_item'],$_POST['id'],$estado);
        $cls_requisiciones::actualizar_estado_items($con,$_POST['id_item'],$estado);
    }elseif (intval($_POST['task']) == 2) {
        $estado = 4;
        $cls_requisiciones::actualizar_estado_cotizaciones($con,$_POST['id_item'],$_POST['id'],$estado);
        $cls_requisiciones::actualizar_estado_items($con,$_POST['id_item'],$estado);
    }
   
} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    //'errores' => $php_error,
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
