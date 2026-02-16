<?php

header('Content-Type: application/json');
include '../../../../layout/validar_session4.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$php_clases = new php_clases();


$php_estado = false;
$errores = "";
$rst = "";
$datos_post;

$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);
$errores = "nada";

if (
    isset($_POST['txt_producto']) && !empty($_POST['txt_producto']) &&
     isset($_POST['txt_periodo_fallo']) && !empty($_POST['txt_periodo_fallo']) &&
      isset($_POST['txt_numcilindros']) && !empty($_POST['txt_numcilindros'])
) {
   $datos_post['id_producto'] = $_POST['txt_producto'];
   $datos_productos =  $cls_laboratorio->get_data_producto($_POST['txt_producto']);
   $datos_post['codigo_producto'] = $datos_productos['codigo_producto'];
   $datos_post['descripcion_producto'] = $datos_productos['descripcion_producto'];
   $datos_post['id_periodo'] = $_POST['txt_periodo_fallo'];
   $datos_post['nombre_periodo'] =  $cls_laboratorio->get_nombre_periodo_fallo($_POST['txt_periodo_fallo']);
   $datos_post['num_fallos'] = $_POST['txt_numcilindros'];

   if($cls_laboratorio->validar_param_muestra($datos_post)){
    $cls_laboratorio->crear_param_muestra($datos_post);
$php_estado = true;

   }else{
    $errores = "Este Producto ya esta parametrizado";

   }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'datospost' => $datos_post,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
