<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;

$fechamin = 0;

if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])
){
    
    if(is_array($arraydata = $op->getdate_for_id(intval($_POST['id_cliente']))))
    {
        foreach ($arraydata as $key) {
            $fechamin = $key['fecha'];
        }
    }
    
    $php_estado = true;

   
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'fecha' => $fechamin,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);