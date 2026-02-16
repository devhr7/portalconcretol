<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
require 'modelo_prog.php';


$modelo_prog = new modelo_prog();
$t8_programacion = new t8_programacion();
$t1_terceros = new t1_terceros();
$t3_clientes = new t3_clientes();
$t4_productos = new t4_productos();
$t5_obras = new t5_obras();

$php_estado = false;
$subtotal = 0;
$php_error = "Todo Bien";


if ($_POST['task'] == 10 && $_POST['tipo'] == "calculate") {

    // se Valida si existen los Campos Requeridos
    if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])  && isset($_POST['id_obras']) && !empty($_POST['id_obras'])  && isset($_POST['id_producto']) && !empty($_POST['id_producto'])  &&  isset($_POST['cantidad']) && !empty($_POST['cantidad'])) {

        //se guardan los datos POST en variables
        $id_cliente = intval($_POST['id_cliente']);
        $id_obra = intval($_POST['id_obras']);
        $id_producto = intval($_POST['id_producto']);
        //$precio_producto = $_POST['precio_producto']; //señuelo
        $cantidad = $_POST['cantidad'];

        // Se realiza funcion para traer el precio del producto
        $precio_producto = $t4_productos->datos_precio_producto_prog($id_cliente, $id_obra, $id_producto);

        if ($precio_producto) {
            $precio_producto = doubleval($precio_producto);
            $cantidad = doubleval($cantidad);
            // se realiza el calculo para guardar el Sub Total
            $pre_subtotal = $precio_producto * $cantidad;

            // Se valida que la Variable Traiga un valor
            if ($pre_subtotal) {
                $habilitar_btn = true;
                $php_estado = true;
                $sub_total_html =  number_format($pre_subtotal, 2, ',', ' ');
                $subtotal = $pre_subtotal;
            } else {
                $php_error = "Error al hacer calculo -PRE";
            }
        } else {
            $php_error = "Error con el Precio del Producto";
        }
    } else {
        $php_error = "Faltan Llenar los Campos requeridos";
    }
} else {
    $php_error = "Error 1";
}


$datos = array(
    'estado' => $php_estado,
    'subtotal' => $subtotal,
    'sub_total_html'=>$sub_total_html,
    'habilitar_btn'=>$habilitar_btn,
    'errores' => $php_error,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
