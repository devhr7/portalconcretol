<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$general_modelos = new general_modelos();
$t1_terceros = new t1_terceros();


$php_estado = false;
$errores = "";
$resultado = "";


if (
    isset($_POST['tbx_tipotercero']) && !empty($_POST['tbx_tipotercero']) &&
    isset($_POST['txt_forma_pago']) && !empty($_POST['txt_forma_pago']) &&
    isset($_POST['r_naturaleza']) && !empty($_POST['r_naturaleza']) &&
    isset($_POST['tbx_tipoDocumento']) && !empty($_POST['tbx_tipoDocumento']) &&
    isset($_POST['tbx_NumeroDocumento']) && !empty($_POST['tbx_NumeroDocumento']) &&
    isset($_POST['tbx_RazonSocial']) && !empty($_POST['tbx_RazonSocial'])


) {

    $tipo_tercero = htmlspecialchars($_POST['tbx_tipotercero']);
    $formapago = htmlspecialchars($_POST['txt_forma_pago']);
    $naturaleza = htmlspecialchars($_POST['r_naturaleza']);
    $tipo_documento = htmlspecialchars($_POST['tbx_tipoDocumento']);
    $numero_documento = htmlspecialchars($_POST['tbx_NumeroDocumento']);
    $dv = htmlspecialchars($_POST['tbx_dv']);
    $razon_social = htmlspecialchars($_POST['tbx_RazonSocial']);
    $nombre1 = htmlspecialchars($_POST['tbx_pnombre1']);
    $nombre2 = htmlspecialchars($_POST['tbx_pnombre2']);
    $apellido1 = htmlspecialchars($_POST['tbx_papellido1']);
    $apellido2 = htmlspecialchars($_POST['tbx_papellido2']);
    $genero = null;
    $fecha_naci = null;
    $departamento = null;
    $municipio = null;
    $direccion = null;
    $email = htmlspecialchars($_POST['tbx_email']);
    $telefono = htmlspecialchars($_POST['tbx_telefono']);
    $celular = htmlspecialchars($_POST['tbx_celular']);

    


    
    switch ($formapago) {
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


    $usuario = $numero_documento;
    $C_Pass = md5($numero_documento);

    $estado = 1;
    $rol = 101;
    $TipoTercero = 1;

    $validarExistencias = $general_modelos->existencia('ct1_terceros', 'ct1_NumeroIdentificacion', $numero_documento);
    
    $x = false;

    if ($validarExistencias) {

        $resultado = $t1_terceros->crear_cliente($tipo_tercero, $formapago, $naturaleza, $tipo_documento, $numero_documento, $dv, $razon_social, $nombre1, $nombre2, $apellido1, $apellido2, $genero, $fecha_naci, $departamento, $municipio, $direccion, $email, $telefono, $celular, $cupo_cliente, $saldo_cartera);

        if ($resultado) {
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
