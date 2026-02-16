<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t22_resistencia_concre
$t22_resistencia_concre = new t22_resistencia_concre();
$php_estado = false;
$log = false;
//Se hace un condicional que valida si la variable de los datos de la tabla resistencia del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_cod']) && !empty($_POST['txt_cod']) && isset($_POST['txt_descripcion']) && !empty($_POST['txt_descripcion'])) {
    //Parametro del campo codigo
    $cod = $_POST['txt_cod'];
    //Parametro del campo descripcion
    $descripcion = $_POST['txt_descripcion'];
    //Se hace un condicional para validar la funcion de la clase t22_resistencia_concre con los parametros que se llamaron anteriormente
    if ($t22_resistencia_concre->crear_resistencia_concreto($cod, $descripcion)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}
$datos = array(
    'estado' => $php_estado,
    'log' => $log,
    'post' => $_POST
);
echo json_encode($datos, JSON_FORCE_OBJECT);

//print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);