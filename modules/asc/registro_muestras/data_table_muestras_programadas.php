<?php

header('Content-Type: application/json');
include '../../../layout/validar_session3.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);

$cod_requisiciones = "";
$fecha_solicitante = "";
$area_solicitante = "";
$estatus = "";
$sede = $_POST['sede'];

switch ($sede) {
    case 'RMI':
    case 'HND':
    case 'RMT':

        $data =  $cls_laboratorio->datatable_muestras_realizadas($sede);

        break;

    default:
        $data =  $cls_laboratorio->datatable_muestras_realizadas();

        break;
}



//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
