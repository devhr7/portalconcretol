<?php

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t40_votaciones = new t40_votaciones();


$id_participante = (int)htmlspecialchars($_POST['id_participante']);
$id_votante = (int)htmlspecialchars($_POST['id_votante']);
$id_campana = (int)htmlspecialchars($_POST['id_campana']);





$result_votar= $t40_votaciones->votar($id_participante);


$result= $t40_votaciones->registro_voto($id_votante, $id_campana);






?>