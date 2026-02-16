<?php



session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$con = new conexionPDO();

$t5_obras = new t5_obras();

$resultado = false;
$php_estado = false;
$php_error = false;


if (isset($_POST['id_obra']) && !empty($_POST['id_obra'])){

    $id_obra = (int) htmlspecialchars($_POST['id_obra']);


     
    $result = $t5_obras->eliminar_obra($id_obra);
    if($result){
        $php_estado = true;
    }else{
        $php_estado = false;
        $php_error = "error al eliminar";
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
