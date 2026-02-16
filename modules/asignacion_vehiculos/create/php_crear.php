<?php

session_start();
header('Content-Type: application/json');

require '../../../include/conexionPDO.php';
include '../../../include/model/autoload3.php';


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$con = new conexionPDO();
$php_clases = new php_clases();

$t10_vehiculo = new t10_vehiculo();
//$t1_terceros = new t1_terceros();

$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['c_conductor']) && !empty($_POST['c_conductor']) &&
    isset($_POST['c_vehiculo']) && !empty($_POST['c_vehiculo']) 

)
{
    $c_conductor = htmlentities(htmlspecialchars($_POST['c_conductor']));
    $c_vehiculo = htmlentities(htmlspecialchars($_POST['c_vehiculo']));

    $result = $t10_vehiculo->asignar_conductor($c_vehiculo, $c_conductor);
    
    if($result){
        $php_estado = true;
    }else{
        $errores= 'Error Al Guardar en la base de datos';
        

    }
    
} else {
    $errores= "Faltan seleccionar Campos Requeridos";
}

$datos = array(
    'estado' => $result,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
