<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;


if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente']) &&
    isset($_POST['fecha_vist']) && !empty($_POST['fecha_vist'])
){
    $fecha = $_POST['fecha_vist'];
    $id_cliente = $_POST['id_cliente'];
    $resultado = $_POST['result_vist'];
    $observacion = $_POST['obs_visit'];
   
    
    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */
    
    if($id_lastinsert = $op->crear_visita($id_cliente,$fecha,$resultado,$observacion)){
        $op->actualizar_resultado_op($id_cliente,$resultado);
        $php_estado = true;

    }else{
        $php_estado = false;
    }


} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'id_last' => $id_lastinsert,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
