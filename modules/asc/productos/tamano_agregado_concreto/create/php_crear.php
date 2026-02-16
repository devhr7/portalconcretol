<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t23_tamano_agregado
$t23_tamano_agregado = new t23_tamano_agregado();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla resistencia del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodTCA']) && !empty($_POST['txt_CodTCA']) && isset($_POST['txt_DescripcionTCA']) && !empty($_POST['txt_DescripcionTCA'])) {
    //Parametro del campo codigo
    $codTCA = $_POST['txt_CodTCA'];
    //Parametro del campo descripcion
    $descripcionTCA = $_POST['txt_DescripcionTCA'];
    //Se hace un condicional para validar la funcion de la clase t23_tamano_agregado con los parametros que se llamaron anteriormente
    if ($t23_tamano_agregado->crear_tamano_agregado_concreto($codTCA, $descripcionTCA)) {
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
