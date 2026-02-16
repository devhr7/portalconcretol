<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$elemento = new elementos();
$data = $elemento->get_database_inventario_epp();

/**
 * 
 * SELECT `id_elemento_epp`, `nombre_elemento_epp`, SUM(CASE WHEN `id_movimiento` = 4 THEN `cantidad` ELSE 0 END) AS INVENTARIO_INICIAL , SUM(CASE WHEN `id_movimiento` = 2 THEN `cantidad` ELSE 0 END) AS ENTRADAS, SUM(CASE WHEN `id_movimiento` = 1 THEN `cantidad` ELSE 0 END) AS SALIDAS,SUM(CASE WHEN `id_movimiento` =3 THEN `cantidad` ELSE 0 END) AS AJUSTES, SUM(CASE WHEN `id_movimiento` = 4 THEN `cantidad` ELSE 0 END) + SUM(CASE WHEN `id_movimiento` =3 THEN `cantidad` ELSE 0 END) + SUM(CASE WHEN `id_movimiento` = 2 THEN `cantidad` ELSE 0 END) - SUM(CASE WHEN `id_movimiento` = 1 THEN `cantidad` ELSE 0 END) as saldo FROM `ct64_salida_epp` GROUP BY `id_elemento_epp`; 
 */



//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
