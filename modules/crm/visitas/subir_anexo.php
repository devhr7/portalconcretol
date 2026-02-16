<?php

header('Content-Type: application/json');
session_start();
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$cls_visitas_comerciales = new cls_visitas_comerciales();

$errores = "nada";

if (
    isset($_POST['nombre_anexo']) && !empty($_POST['nombre_anexo']) && isset($_FILES['imgfiles']) && !empty($_FILES['imgfiles'])
) {

    $id_visita = $_POST['txt_id_edit'];
    $nombre_anexo = $_POST['nombre_anexo'];

    $file_anexo = htmlspecialchars($_FILES['imgfiles']['name']);
    $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);

    $status = 2;

    if($cls_visitas_comerciales->subir_anexo($nombre_anexo,$file_anexo, $ruta, $id_visita)){
        $php_estado = true;
    }else{
        $php_estado = false;

    }



} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'id_anexi'=>   $id_visita
    
);

echo json_encode($datos, JSON_FORCE_OBJECT);

