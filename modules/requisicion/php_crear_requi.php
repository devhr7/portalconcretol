<?php

header('Content-Type: application/json');
include '../../layout/validar_session2.php';

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
$php_clases = new php_clases();


$php_estado = false;
$errores = "";
$resultado = "";

$cls_requisiciones = new cls_requisiciones();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'],2);
$errores = "nada";

if (
    isset($_POST['txt_area']) && !empty($_POST['txt_area'])  
) {

  
    $id_area = intval($_POST['txt_area']);


    if($id_requi = $cls_requisiciones->crear_requisiciones($id_usuario, $id_area)){
        $php_estado = true;
    }
    



} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'id_requi' => $id_requi,
    'errores' => $errores,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);

