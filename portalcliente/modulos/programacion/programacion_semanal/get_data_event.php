<?php


header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$eventos = new eventos();
$programacion = new programacion();
if(isset($_POST['id'])){
    $data = $programacion->cargar_data_programacion($_POST['id']);
    foreach ($data as $key ) {
        $select_cliente  = $programacion->option_cliente_edit($key['']);
    }
}else{
    $data = false;
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);