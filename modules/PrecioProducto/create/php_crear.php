<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$php_clases = new php_clases();
$t6_precio_producto = new t6_precio_producto();

$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error= "";


if (isset($_POST['txt_producto']) && !empty($_POST['txt_producto']) && isset($_POST['txt_precio']) && !empty($_POST['txt_precio'])){



    if (isset($_POST['nfilas']) && !empty($_POST['nfilas'])) {
        $nfilas_selector = $_POST['nfilas'];
        $id_producto = $_POST['txt_producto'];
        $id_precio = $_POST['txt_precio'];
        $fecha_creacion =  date("Y-m-d");;
        $estado = 1;
        $id_tercero = $_POST['Txb_IdTercero'];
        $id_obra = $_POST['Txb_IdObras'];

        if (is_array($id_producto) && is_array($id_precio)) {
            $N = count($id_producto);
            for ($i = 0; $i < $N; $i++) {
                //insertar tabla
                //$resultado = $t26->RecibidoFinal($nfilas_selector[$i], $persona);

                $precio = str_replace('.','',$id_precio[$i]);

                $resultado = $t6_precio_producto->insertar_precios_productos($fecha_creacion,$estado,$id_tercero , $id_obra, $id_producto[$i], $precio);
                if ($resultado) {
                    $php_estado = true;
                    $resultado = "las remisiones fueron guardadas correctamente";
                } else {
                    $resultado = "Error al Guardar en la base de datos";
                }
            }
        } else {
            $resultado = "ERROR";
        }
    } else {
        $resultado = " Debe seleccionar como minimo una Remision";
    }
} else {
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
