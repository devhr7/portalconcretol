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

if (isset($_POST['task']) && !empty($_POST['task'])) {
    if(intval($_POST['task']) == 1){
        $get_datos_movimiento = $cls_elementos->get_salida_epp_id($_POST['id_movimiento']);

        foreach ($get_datos_movimiento as $row) {
            
        }
    }elseif(intval($_POST['task']) == 2){

    }
     
}

$datos = array(
    'estado' => $php_estado,
    'datos_mv' => $get_datos_movimiento,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);