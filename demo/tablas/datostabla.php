<?php
header('Content-Type: application/json');


require 'conexionPDO.php';
require_once '../../include/model/tablas/t1_terceros.php';


$t1_terceros = new t1_terceros();


$datos = $t1_terceros->select_clientes_3();
while($fila = $datos->fetch(PDO::FETCH_ASSOC)){
    
    //$datost[] = $fila;
    
    $comlumna["data"][]= $fila;

    
}


echo json_encode($comlumna);