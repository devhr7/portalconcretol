<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';



$cls_oportunidad_negocio  = new oportunidad_negocio();


$data = null;
$php_estado = false;
$nidentificacion = 0;
$tipo_cliente = 0;
$nombre = "";
$apellido = "";
$telefono = 0;


if(isset($_POST['id_oportunidad']) && !empty($_POST['id_oportunidad']))
{
    if(is_array($data = $cls_oportunidad_negocio->get_datos_cliente_id($_POST['id_oportunidad']))){
        foreach ($data as $key ) {
            $asesora_comercial = $key['asesora_comercial'];
            $sede = $key['id_sede'];
            $plan_maestro = $key['tipo_plan_maestro'];
            $tipo_cliente = $key['tipo_cliente'];
            $nidentificacion = $key['nidentificacion'];
            $nombre = $key['nombrescompletos'];
            $apellido = $key['apellidoscompletos'];
            $telefono = $key['telefono_cliente'];
        }
        $php_estado = true;

    }
}




$datos = array(
    'estado' => $php_estado,
    'datosop' => $data,
    'asesora_comercial'=>$asesora_comercial,
    'sede'=>$sede,
    'plan_maestro'=>$plan_maestro,
    'tipo_cliente'=>$tipo_cliente,
    'nidentificacion'=>$nidentificacion,
    'nombrescompletos'=>$nombre,
    'apellidoscompletos'=>$apellido,
    'telefono_cliente'=>$telefono,
    'POST' => $_POST
);


echo json_encode($datos, JSON_FORCE_OBJECT);