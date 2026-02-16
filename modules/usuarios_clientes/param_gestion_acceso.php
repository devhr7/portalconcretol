<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$usuarios_clientes = new usuarios_clientes();

$php_estado = false;
$php_error[] = "";
$resultado = "";

$datos_terceros = $usuarios_clientes->terceros_id_cliente_y_obra();

foreach($datos_terceros as $key){
    $id_tercero = $key['id'];
    $id_cliente = $key['cliente'];
    $id_obra = $key['obra'];
    
    if($usuarios_clientes->insert_gestion_acceso($id_tercero, $id_cliente, $id_obra)){
        $php_estado = true;
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);