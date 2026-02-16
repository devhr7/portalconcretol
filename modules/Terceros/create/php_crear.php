<?php

session_start();
header('Content-Type: application/json');



require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
//$t_nombretabla = new tabla();

$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['tbx_tipotercero']) && !empty($_POST['tbx_tipotercero']) &&  isset($_POST['txt_acuerdo_pago']) && !empty($_POST['txt_acuerdo_pago']) && isset($_POST['r_naturaleza']) && !empty($_POST['r_naturaleza']) &&   isset($_POST['tbx_tipoDocumento']) && !empty($_POST['tbx_tipoDocumento']) && isset($_POST['tbx_NumeroDocumento']) && !empty($_POST['tbx_NumeroDocumento']) ) {

    $tbx_tipocliente = $_POST['tbx_tipotercero'];
    $acuerdopago = $_POST['txt_acuerdo_pago'];
    $r_naturaleza = $_POST['r_naturaleza'];
    $tbx_tipoDocumento = $_POST['tbx_tipoDocumento'];
    $tbx_NumeroDocumento = $_POST['tbx_NumeroDocumento'];
    $tbx_dv = $_POST['tbx_dv'];
    $tbx_RazonSocial = $_POST['tbx_RazonSocial'];
    $tbx_pnombre1 = $_POST['tbx_pnombre1'];
    $tbx_pnombre2 = $_POST['tbx_pnombre2'];
    $tbx_papellido1 = $_POST['tbx_papellido1'];
    $tbx_papellido2 = $_POST['tbx_papellido2'];









    
    $php_estado = true;

} else {
    $errores = "Fantan Los Campos Requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
