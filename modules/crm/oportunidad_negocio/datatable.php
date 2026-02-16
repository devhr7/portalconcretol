<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$data = "";
$oportunidad_negocio = new oportunidad_negocio();
$php_clases = new php_clases();

$id = $_POST['id'];

$id_usuario = (int)$php_clases->HR_Crypt($_SESSION['id_usuario'], 2);

if ($_SESSION['rol_funcionario'] == 1 || $_SESSION['rol_funcionario'] == 32 || $_SESSION['rol_funcionario'] == 8  || $_SESSION['rol_funcionario'] == 14) {
    $data = $oportunidad_negocio->dt_oportunidad_negocio($id);
} else if ($_SESSION['rol_funcionario'] == 12 || $_SESSION['rol_funcionario'] == 13) {
    $data = $oportunidad_negocio->dt_oportunidad_negocio_por_id($id_usuario, $id);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
