<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$t10_vehiculo = new t10_vehiculo();
$general_modelos = new general_modelos();

$php_estado = false;
$php_error= "";
$resultado = "";



if (isset($_POST['txt_letras']) && !empty($_POST['txt_letras']) && isset($_POST['txt_num']) && !empty($_POST['txt_num']) ){
     
    $letras = htmlspecialchars($_POST['txt_letras']);
    $numero = htmlspecialchars($_POST['txt_num']);
    $letras = strtoupper($letras);
    $numero = intval($numero);
    $placa = $letras . $numero;

    if($general_modelos->existencia('ct10_vehiculo','ct10_Placa',$placa)){
        $resultado = $t10_vehiculo->insertarVehiculos($letras, $numero);
        if($resultado){
            $php_estado = true;
        }else{
            $php_estado = false;
        }
    }else{
        $php_error = "La placa de este vehiculo ya existe en esta base de datos";
    }
    
    
   
    
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,

    
);


echo json_encode($datos, JSON_FORCE_OBJECT);
