<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$boolPhpEstado = false;
$arrayPhpError[] = "";
$StrResultado = "";
//se crea un objeto de la clase clsProgramacionSemanal.
$cls_visitas_comerciales = new cls_visitas_comerciales();
$php_clases = new php_clases();
//Se listan todas las programaciones.

$id_usuario = (int)$php_clases->HR_Crypt($_SESSION['id_usuario'], 2);

if (intval($_SESSION['rol_funcionario']) == 1 || $_SESSION['rol_funcionario'] == 32) {
    $objData = $cls_visitas_comerciales->get_visitas_comerciales();
}else{
    if($objData = $cls_visitas_comerciales->get_visitas_comerciales_for_comercial($id_usuario)){

    }else{
        $objData = $cls_visitas_comerciales->get_visitas_comerciales_for_comercial2($id_usuario);
    }

}
$boolPhpEstado = true;
//Datos de los arreglos.
$datos = array(
    'estado' => $boolPhpEstado,
    'errores' => $arrayPhpError,
    'result' => $StrResultado,
);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($objData, JSON_UNESCAPED_UNICODE);