<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t24_caract_concre
$t24_caract_concre = new t24_caract_concre();
$php_estado = false;
$log = false;

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla caracteristicas del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodCC']) && !empty($_POST['txt_CodCC']) && isset($_POST['txt_DescripcionCC']) && !empty($_POST['txt_DescripcionCC'])) {
    //Parametro del campo codigo caracteristica del concreto
    $codCC = $_POST['txt_CodCC'];
    //Parametro del campo descripcion del caracteristica del concreto
    $descripcionCC = $_POST['txt_DescripcionCC'];
    //Se hace un condicional que valida si la funcion que se esta con los parametros adecuados y estos parametros se llamaron anteriormente
    if ($t24_caract_concre->crear_caracteristica_concreto($codCC, $descripcionCC)) {
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
