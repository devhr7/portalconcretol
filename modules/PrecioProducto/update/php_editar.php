<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
//include '../../../include/model/autoload3.php';


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

//$con = new conexionPDO();
//$php_class = new php_class();
//$t1_terceros = new t1_terceros();
$t6_precio_producto = new t6_precio_producto();

$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['Txb_IdTercero']) && !empty($_POST['Txb_IdTercero'])){
     
    $id = $_POST['id_precio'];
    $estado = 1;  // 
    $id_tercero = htmlspecialchars($_POST['Txb_IdTercero']);  // 
    $id_obra = htmlspecialchars($_POST['Txb_IdObras']);  // 
    $id_producto = htmlspecialchars($_POST['Txb_IdProducto']);  // 
    $precio = str_replace(".","",htmlspecialchars($_POST['Txb_Precio']));

     $result = $t6_precio_producto->editar_precio($id,$estado,$id_tercero,$id_obra,$precio,$id_producto);

    iF($result){
$php_estado = true;

    }else {
        $errores = "fallo al guardar en la base de datos";
        
    }
    


} else {
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
