<?php



use function GuzzleHttp\json_decode;



session_start();

header('Content-Type: application/json');







require '../../../../librerias/autoload.php';

require '../../../../modelos/autoload.php';

require '../../../../vendor/autoload.php';







$t5_obras = new t5_obras();

$t6_precio_producto = new t6_precio_producto();

$modelo_obras = new modelo_obras();



$php_estado = false;

$errores = "ninguno";

$result = "";





if (

    

    isset($_POST['id_cliente']) && !empty($_POST['id_cliente']) &&

    isset($_POST['id_obra']) && !empty($_POST['id_obra']) &&

    isset($_POST['id_producto']) && !empty($_POST['id_producto']) &&

    isset($_POST['precio']) && !empty($_POST['precio'])

) {



    //$id_cli = intval($_POST('id_cliente'));

    $id_cli = 4;

    $id_obra = (int)htmlspecialchars($_POST['id_obra']);

    $id_producto = (int)htmlspecialchars($_POST['id_producto']);

    $porcentaje = htmlspecialchars($_POST['porcentaje']);

    $precio = htmlspecialchars($_POST['precio']);

    $fecha_creacion = "";

    $estado = 1;

 

    $id_last_insert = $t6_precio_producto->insertar_precios_productos($fecha_creacion,$estado,$id_cli , $id_obra, $id_producto, $precio);



    if($id_last_insert){

        $php_estado = true;

    }else{

        $errores = "Error al Guardar";

    }



    







} else {

    $errores = "Faltan campos requeridos";

}





$datos = array(

    'estado' => $php_estado,

    'errores'  => $errores,

    'post' => $_POST,





);





echo json_encode($datos, JSON_FORCE_OBJECT);

