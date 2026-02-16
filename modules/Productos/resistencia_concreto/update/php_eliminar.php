<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 
//Se crea un objeto de la clase t4_productos
$t4_productos = new t4_productos();
// $t21_tipoconcreto = new t21_tipoconcreto();
//Se crea un objeto de la clase t22_resistencia_concre
$t22_resistencia_concre = new t22_resistencia_concre();
// $t23_tamano_agregado_concre = new t23_tamano_agregado();
// $t24_caract_concre = new t24_caract_concre();
// $t25_colorconcreto = new t25_colorconcreto();
//Se crea un objeto de la clase general_modelos
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla resistencia del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    if ($t22_resistencia_concre->eliminar_resistencia_concreto($id)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
