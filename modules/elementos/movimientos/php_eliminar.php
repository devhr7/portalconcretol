<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$cls_elementos = new elementos();


$php_estado = false;
$errores = "";
$resultado = "";


if (
    isset($_POST['id_mov_eliminar']) && !empty($_POST['id_mov_eliminar'])
) {
    $id = intval($_POST['id_mov_eliminar']);
    if($cls_elementos->eliminar_salida($id)){
        $php_estado = true;
    }else{
        $php_estado = false;
    }
    
} else {
    $errores = "Faltan llenar los campos requerios";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
