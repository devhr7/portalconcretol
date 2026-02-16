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


if (isset($_POST['id']) && !empty($_POST['id'])) {
   
    $id_item = htmlspecialchars($_POST['id']);

    $result = $cls_requisiciones->eliminar_items($id_item);




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
