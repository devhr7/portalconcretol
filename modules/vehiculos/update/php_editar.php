<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
$t10_vehiculo = new t10_vehiculo();

$php_estado = false;
$php_error = "";
$resultado = "";


if (isset($_POST['txt_letras']) && !empty($_POST['txt_letras']) && isset($_POST['txt_num']) && !empty($_POST['txt_num'])&& isset($_POST['txt_id']) && !empty($_POST['txt_id'])){
    $id_vehiculo  = $php_clases->HR_Crypt($_POST['txt_id'],2);
    $letras = htmlspecialchars($_POST['txt_letras']);
    $num = htmlspecialchars($_POST['txt_num']);

    $resultado = $t10_vehiculo->editar_vehiculos($letras, $num, $id_vehiculo);

    if($resultado){
        $php_estado = true;
    }

}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    
);


echo json_encode($datos, JSON_FORCE_OBJECT);
