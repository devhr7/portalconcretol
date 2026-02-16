<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
//require '../../../include/conexion.php';
//require '../../../include/get_datos.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
//$get_datos = new get_datos();
$t5_obras = new t5_obras();
$cls_novedades = new novedades_despacho();


// Fecha // texto // usuario // acccion //  texto // indicador // numero Remision // texto //razon //
// 20-01-2021- 21:30:1  - El usuario //heyder ramirez//  //anulo//  la remision   //90212//  y la razon fue // ;



$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

$tipo_novedad = null;
$select_tipo_novedad = null;
$select_subtipo_novedad = null;
$select_novedades = null;

if ($_POST['task'] == 1){
    $id_cliente= $_POST['idCliente'];
    $select_obras = $t5_obras->option_obra($id_cliente);
    $php_estado = true;    
    
}
if ($_POST['task'] == 2){
    $tipo_novedad= $_POST['tipo_novedad'];
    $select_subtipo_novedad = $cls_novedades->option_areas_novedades($tipo_novedad);
    $php_estado = true;    
    
}
if ($_POST['task'] == 3){
    $tipo_novedad= $_POST['tipo_novedad'];
    $subtipo_novedad= $_POST['subtipo_novedad'];
    $select_novedades= $cls_novedades->option_novedades($tipo_novedad,$subtipo_novedad);
    $php_estado = true;    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,
    'tipo_novedad'=>$tipo_novedad,
    'subtipo_novedad' => $select_subtipo_novedad,
    'novedades' => $select_novedades

);


echo json_encode($datos, JSON_FORCE_OBJECT);
