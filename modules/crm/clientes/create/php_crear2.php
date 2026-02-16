<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$general_modelos = new general_modelos();
$t1_terceros = new t1_terceros();
$cls_oportunidad_negocio  = new oportunidad_negocio();


$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['tbx_NumeroDocumento']) && !empty($_POST['tbx_NumeroDocumento'])) {

    $id_comercial = $_POST['asesora_comercial'];
    $nombre_comercial = $cls_oportunidad_negocio->get_nombre_asesora($id_comercial);
    $id_sede = $_POST['sede'];
    $nombre_sede = $cls_oportunidad_negocio->get_nombre_sede($id_sede);
    $id_tipo_cliente = $_POST['tipo_cliente'];
    $nombre_tipo_cliente = $cls_oportunidad_negocio->get_nombre_tipo_del_cliente($id_tipo_cliente);
    if(isset($_POST['tipo_plan_maestro'])){
        $id_tipo_plan_maestro = $_POST['tipo_plan_maestro'];
    }else{
        $id_tipo_plan_maestro = "";
    }
    
    $forma_pago = null;
    $naturaleza = htmlspecialchars($_POST['naturaleza']);
    $tipo_documento = htmlspecialchars($_POST['tbx_tipoDocumento']);
    $numero_documento = htmlspecialchars($_POST['tbx_NumeroDocumento']);
    $dv = htmlspecialchars($_POST['tbx_dv']);
    $tipo_tercero = 1;
    $nombre1 = htmlspecialchars($_POST['tbx_pnombre1']);
    $nombre2 = htmlspecialchars($_POST['tbx_pnombre2']);
    $apellido1 = htmlspecialchars($_POST['tbx_papellido1']);
    $apellido2 = htmlspecialchars($_POST['tbx_papellido2']);
    if ($naturaleza == "PJ") {
        $razon_social = htmlspecialchars($_POST['tbx_RazonSocial']);
    } else if ($naturaleza == "PN") {
        $razon_social = $nombre1 . " " . $nombre2 . " " . $apellido1 . " " . $apellido2;
    }

    $email = htmlspecialchars($_POST['tbx_email']);
    $telefono = htmlspecialchars($_POST['tbx_telefono']);
    $celular = htmlspecialchars($_POST['tbx_celular']);
    $direccion = htmlspecialchars($_POST['txt_direccion']);
    switch ($forma_pago) {
        case 1:
            $cupo_cliente = htmlspecialchars($_POST['txt_cupo']);
            $cupo_cliente = str_replace('.', '', $cupo_cliente);
            $saldo_cartera  = $cupo_cliente;
            break;
        case 2:
            $cupo_cliente = 0;
            $saldo_cartera = 0;
            break;
        default:
            $cupo_cliente = 0;
            $saldo_cartera = 0;
            break;
    }
    $departamento = null;
    $municipio = null;
    $genero = null;
    $fecha_naci = null;
    

    $usuario = $numero_documento;
    $C_Pass = md5($numero_documento);

    $estado = 1;
    $rol = 101;
    $TipoTercero = 1;

    $validarExistencias = $general_modelos->existencia('ct1_terceros', 'ct1_NumeroIdentificacion', $numero_documento);
    $x = false;
    if ($validarExistencias) {
        if ($t1_terceros->crear_cliente($id_comercial, $nombre_comercial, $id_sede, $nombre_sede, $id_tipo_cliente, $nombre_tipo_cliente, $id_tipo_plan_maestro, $forma_pago, $naturaleza, $tipo_documento, $numero_documento, $dv, $nombre1, $nombre2, $apellido1, $apellido2, $razon_social, $email, $telefono, $celular, $cupo_cliente, $saldo_cartera,$direccion)) {
            $php_estado = true;
        } else {
            $errores = "Hubo un error al guardar" .  $resultado;
        }
    } else {
        $errores = "Este Cliente ya existe en la base de datos";
    }
} else {
    $errores = "Faltan llenar los campos requerios";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
