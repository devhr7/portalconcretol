<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$cls_visitas_cliente = new visitas_clientes();


$php_estado = false;
$errores = "";
$resultado = "";


if (
    isset($_POST['id_visita']) && !empty($_POST['id_visita'])
) {
    $id_visita = intval($_POST['id_visita']);
    if($cls_visitas_cliente->eliminar_visita($id_visita)){
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
