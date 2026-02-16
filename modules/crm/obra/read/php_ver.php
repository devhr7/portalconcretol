<?php

session_start();
header('Content-Type: application/json');

require '../../../../includes/conexionPDO.php';
require '../../../../includes/gestiontablas/nombre_tabla.php';
require '../../../../includes/php_class.php';

$con = new conexionPDO();
$php_class = new php_class();
$t_nombretabla = new tabla();

$php_estado = false;
$errores[] = "";
$resultado = "";


if (isset($_POST['campo']) && !empty($_POST['campo'])){
     
    
} else {
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
