<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$t27_factura = new t27_factura();
$t26_remisiones = new t26_remisiones();



$result = $t27_factura->selectfactura_remi();

var_dump($result);










