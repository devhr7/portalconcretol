<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
//Aca se crea un objeto con la clase t22_resistencia_concre
$t22_resistencia_concre = new t22_resistencia_concre();
//Se le asigna una variable al objeto que se declaro anteriormente y se llama una funcion llamada get_datatable_resistencia_concreto que esta en la clase t22_ resistencia_concre
$data=$t22_resistencia_concre->get_datatable_resistencia_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);