<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
//Se crea un objeto de la clase t23_tamano_agregado
$t23_tamano_agregado = new t23_tamano_agregado();
//Se le asigna una variable al objeto t23_tamano_agregado y se le llama una funcion llamada get_datatable_tamano_agregado_concreto
$data = $t23_tamano_agregado->get_datatable_tamano_agregado_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
