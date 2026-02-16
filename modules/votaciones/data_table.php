<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$php_clases = new php_clases();
$t29_batch = new t29_batch();
$t40_votaciones = new t40_votaciones();


$data = $t40_votaciones->tabla_campana();

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);