<?php

session_start();
header('Content-Type: application/json');

// require '../../../include/conexionPDO.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


// $con = new conexionPDO();

$t5_obras = new t5_obras();

$resultado = false;
$php_estado = false;
$php_error = false;


if (isset($_POST['cliente']) && !empty($_POST['cliente']) &&
    isset($_POST['nombre_obra']) && !empty($_POST['nombre_obra'])){

        $id_cliente = (int)htmlspecialchars($_POST['cliente']);
        $nombre_obra = htmlspecialchars($_POST['nombre_obra']);
        $id_departamento = htmlspecialchars($_POST['departamento']);
        $id_ciudad = htmlspecialchars($_POST['ciudad']);
        $segmento = htmlspecialchars($_POST['segmento']);
        $direccion_obra = htmlspecialchars($_POST['direccion']);
        $id_obra = htmlspecialchars($_POST['id_obra']);

     
    $result = $t5_obras->editar_obra($id_obra, $id_cliente, $nombre_obra, $direccion_obra,$segmento,$id_departamento, $id_ciudad );
    
    if($result){
        $php_estado = true;
    }else{
        $php_estado = false;
        $php_error = "error al guardar en la base de datos";
    }


    
} else {
    $php_error = "faltan campos requeridos";
    
}



$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
