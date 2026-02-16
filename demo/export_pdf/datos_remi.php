<?php

//========================================================================================================
// ENCABEZADO
//========================================================================================================
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t29_batch = new t29_batch();

$titulo = "";
$datos = $t29_batch->select_batch();

$fecha_remi =¿; 