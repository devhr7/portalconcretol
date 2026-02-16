<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();

//Aca se crea un objeto con la clase t21_tipoconcreto
$t21_tipoconcreto = new t21_tipoconcreto();

//Aca se le asigna una variable del objeto que se creo anteriormente y se llama la funcion que se creo en la clase t21_tipoconcreto y la funcion es para traer todos lod datos de la tabla tipo de concreto.
$data = $t21_tipoconcreto->get_datatable_tipo_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
