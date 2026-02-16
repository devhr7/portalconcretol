<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t8_programacion = new t8_programacion();


$id_programacion = $_POST['id_programacion'];
//$id_programacion = 15;

$data = $t8_programacion->tabla_detalle_prog($id_programacion);

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);