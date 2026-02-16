<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
require 'modelo_t26.php';


$t26 = new modelo_t26();

$php_estado = false;
$resultado = "";


$persona =  $_SESSION['nombre_usuario'];





if(isset($_POST['id_remi']) && !empty($_POST['id_remi'])){
    $id_remi_selector = $_POST['id_remi'];
    if(is_array($id_remi_selector)){
        $N = count($id_remi_selector);
        for($i=0; $i < $N; $i++) {
            $id_remision = (int)$id_remi_selector[$i];
           $resultado = $t26->RecibidoFinal($id_remision, $persona);
           if($resultado){
               $php_estado = true;
               $resultado = "las remisiones fueron guardadas correctamente";
           }else{
            $resultado = "Error al Guardar en la base de datos";
           }
        }
    }else{
        $resultado = "ERROR";
    }
}else{
    $resultado = " Debe seleccionar como minimo una Remision";
}





//$t26->RecibidoFinal_masivo($_POST['id_Remision'], $persona);


$datos = array(
    'estado' => $php_estado,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);