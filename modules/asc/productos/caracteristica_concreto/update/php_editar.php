<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase t4_productos
$t4_productos = new t4_productos();
// $t21_tipoconcreto = new t21_tipoconcreto();
// $t22_resistencia_concre = new t22_resistencia_concre();
// $t23_tamano_agregado_concre = new t23_tamano_agregado();}
//Se crea un objeto de la clase t24_caract_concre
$t24_caract_concre = new t24_caract_concre();
// $t25_colorconcreto = new t25_colorconcreto();
//Se crea un objeto de la clase general_modelos
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla caracteristicas del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodCC']) && !empty($_POST['txt_CodCC']) && isset($_POST['txt_DescripcionCC']) && !empty($_POST['txt_DescripcionCC'])) {
    //Parametro del campo codigo caracteristica del concreto
    $CodCC = $_POST['txt_CodCC'];
     //Parametro del campo descripcion del caracteristica del concreto
    $DescripcionCC = $_POST['txt_DescripcionCC'];
     //Parametro del campo id
    $id = $_POST['txt_id'];
    //Se hace un condicional que valida si la funcion que se esta con los parametros adecuados y estos parametros se llamaron anteriormente
    if ($t24_caract_concre->modificar_caracteristica_concreto($id, $CodCC, $DescripcionCC)) {
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
