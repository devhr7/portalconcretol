<?php
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$eventos = new eventos();
$programacion = new programacion();
if (isset($_POST['id'])) {
    if (is_array($data = $programacion->cargar_data_programacion($_POST['id']))) {
        foreach ($data as $key) {
            $select_cliente  = $programacion->option_cliente_edit($key['cliente']);
            $select_obra  = $programacion->option_obra_edit($key['cliente'], $key['obra']);
            $select_producto  = $programacion->option_producto_edit($key['producto']);
            $cantidad = $key['cantidad'];
            $inicio = $key['inicio'];
            $fin = $key['fin'];
            $color = $key['color'];
            $textcolor = $key['textcolor'];
        }
    } else {

    }
} else {
    $data = false;
}

$datos = array(
    'post' => $_POST,
    'datos_consulta' => $data,
    'select_cliente' => $select_cliente,
    'select_obra' => $select_obra,
    'select_producto' => $select_producto,
    'cantidad' => $cantidad,
    'inicio' => $inicio,
    'fin' => $fin,
    'color' => $color,
    'textcolor' => $textcolor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);