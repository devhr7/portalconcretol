<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

//$conexion_bd = new conexion();
//$conexion_bd->connect();

//$con = new conexionPDO();
$general_modelos = new general_modelos();

date_default_timezone_set('America/Bogota');

$php_fechatime = date("Y-m-d H:i:s");
$date = "".date('Y/m/d h:i:s', time());


$php_estado = false;
$errores = "";
$resultado = "";

$t26_remisiones = new t26_remisiones();

if (isset($_POST['C_IdTerceros']) && !empty($_POST['C_IdTerceros'])){
    $php_idcliente = htmlspecialchars($_POST['C_IdTerceros']);
    $php_idobra = htmlspecialchars($_POST['C_Obras']);
    $php_codigo = htmlspecialchars($_POST['C_codigo']);
    $php_vehiculo = htmlspecialchars($_POST['C_vehiculo']);
    $php_conductor = htmlspecialchars($_POST['C_Conductor']);
    
    $image = htmlspecialchars($_FILES['imgfiles']['name']);
    $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);

    $php_fileexten = strrchr($_FILES['imgfiles']['name'], ".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['imgfiles']['name'] . $date), 0, 40)) . $php_fileexten;
    
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
    $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);
    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());
    $fecha_remi = $date;
    



$estado = 1;
$notificacion = 3;









$validar_existencia = $general_modelos->existencia('ct26_remisiones', 'ct26_codigo_remi', $php_codigo);

if($validar_existencia){

    $insertar_remi = $t26_remisiones->subir_remision($php_codigo, $php_tempfoto, $php_idcliente, $php_idobra, $fecha_remi, $estado, $notificacion, $php_conductor, $php_vehiculo);


if($insertar_remi){
    $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
    $php_estado = true;
}else{
    $php_estado = false;
}

  
    
}else{
    
    $errores = "esta Remision ya existe en nuestra base de datos";
}
    
}else{
    $errores = "faltan llenar los campos requeridos";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
