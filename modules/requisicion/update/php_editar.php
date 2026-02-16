<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//$con = new conexionPDO();
$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;


if (isset($_POST['id_requisicion']) && !empty($_POST['id_requisicion'])) {
    $id_requisicion = (int)htmlspecialchars($_POST['id_requisicion']);


    $nombre_producto = htmlspecialchars($_POST['txt_nombre_producto']);
    $descripcion = htmlspecialchars($_POST['txt_descripcion']);
    $cantidad = htmlspecialchars($_POST['txt_cantidad']);
    $unidad_medida = htmlspecialchars($_POST['txt_unidad_medida']);
    $id_lugar_entrega = htmlspecialchars($_POST['txt_lugar_entrega']);
    $id_prioridad = htmlspecialchars($_POST['txt_prioridad']);
    $posible_proveedor = htmlspecialchars($_POST['txt_posible_proveedor']);
    $file_item = htmlspecialchars($_FILES['img_producto']['name']);
    $ruta_file = htmlspecialchars($_FILES['img_producto']['tmp_name']);


    $result = $cls_requisiciones->crear_item_has_requisicion($id_requisicion, $nombre_producto, $descripcion, $cantidad, $id_lugar_entrega, $id_prioridad, $posible_proveedor,$file_item, $ruta_file, $unidad_medida);



        //$result2 =  $t26_remisiones->editar_remision($img_remi, $ruta, $id_remision);

        if ($result) {
            $php_estado = true;
            
            
        } else {
            $php_estado = false;
           
        }
 
    

} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    //'errores' => $php_error,
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
