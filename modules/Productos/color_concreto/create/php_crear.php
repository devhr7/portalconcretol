<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t25_colorconcreto
$t25_colorconcreto = new t25_colorconcreto();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla color del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodConcreto']) && !empty($_POST['txt_CodConcreto']) && isset($_POST['txt_DescripcionCC']) && !empty($_POST['txt_DescripcionCC'])) {
    //Parametro del codigo del concreto
    $codCC = $_POST['txt_CodConcreto'];
    //Parametro del codigo de la descripcion del concreto
    $descripcionCC = $_POST['txt_DescripcionCC'];
    //Se hace un condicional para validar la funcion que esta en la clase t25_colorconcreto y esta funcion requiere dos parametros la cual se llamaron anteriormente
    if ($t25_colorconcreto->crear_color_concreto($codCC, $descripcionCC)) {
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
