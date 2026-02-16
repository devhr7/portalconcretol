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
$date = "" . date('Y/m/d h:i:s', time());


$php_estado = false;
$errores = "";
$resultado = "";

$t26_remisiones = new t26_remisiones();
$t27_factura = new t27_factura();

if (isset($_POST['C_IdTerceros']) && !empty($_POST['C_IdTerceros'])) {
    $php_idcliente = htmlspecialchars($_POST['C_IdTerceros']);
    $php_idobra = htmlspecialchars($_POST['C_Obras']);
    $php_nombre_archivo = htmlspecialchars($_POST['txt_nombre_anexo']);


    
    $image = htmlspecialchars($_FILES['imgfiles']['name']);
    $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);
    $php_fechatime = "".date("Y-m-d H:i:s");
  
    $php_fileexten = strrchr($_FILES['imgfiles']['name'],".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['imgfiles']['name'].$php_fechatime),0,40)).$php_fileexten;

    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/internal/images/anexos/'; 
    $php_tempfoto = ('/internal/images/anexos/'.$php_serial);

    // $image = htmlspecialchars($_FILES['imgfiles']['name']);
    // $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);

    // $php_fileexten = strrchr($_FILES['imgfiles']['name'], ".");
    // $php_serial = strtoupper(substr(hash('sha1', $_FILES['imgfiles']['name'] . $date), 0, 40)) . $php_fileexten;

    // $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/anexos/';
    // $php_tempfoto = ('/internal/images/anexos/' . $php_serial);
    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());
    $fecha_remi = $date;
    $estado = 1;
    $notificacion = 3;

    $validar_existencia = true;

    if ($validar_existencia) {
        $insertar_anexos = $t27_factura->insertar_anexos_factura($php_idcliente, $php_idobra, $php_nombre_archivo, $php_tempfoto);
        if ($insertar_anexos) {
            $php_movefile = move_uploaded_file($ruta,$carpeta_destino.$php_serial);

            // $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
            $php_estado = true;
        } else {
            $php_estado = false;
        }
    } else {

        $errores = "esta Remision ya existe en nuestra base de datos";
    }
} else {
    $errores = "faltan llenar los campos requeridos";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
