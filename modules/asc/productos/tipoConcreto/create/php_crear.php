<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
//Se crea un objeto de la clase t21_tipoconcreto.
$t21_tipoconcreto = new t21_tipoconcreto();
$php_estado = false;
$log = false;


$php_estado = false;
$php_error[] = "";
$resultado = "";

//Se hace un condicional que valida si la variable de los datos de la tabla tipo de concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodTConcreto']) && !empty($_POST['txt_CodTConcreto']) && isset($_POST['txt_DescripcionTC']) && !empty($_POST['txt_DescripcionTC'])) {
    //Parametro del campo codigo
    $codTC = $_POST['txt_CodTConcreto'];
    //Parametro del campo descripcion
    $descripcionTC = $_POST['txt_DescripcionTC'];
    //Se hace un condicional para validar la funcion de la clase t21_tipoconcreto con los parametros que se llamaron anteriormente
    if ($t21_tipoconcreto->crear_tipo_concreto($codTC, $descripcionTC)) {
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
