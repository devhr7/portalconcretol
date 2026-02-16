<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';




$t8_programacion = new t8_programacion();

$php_estado = false;
$php_errores="";
$resultado = "";


if(isset($_POST['fecha_prog']) && !empty($_POST['fecha_prog']) && isset($_POST['fecha_prog']) && !empty($_POST['fecha_prog']) )
{
    $fecha_prog = test_input($_POST['fecha_prog']);
    $linea_despacho = test_input($_POST['linea_despacho']);
    $id_programacion =intval(test_input($_POST['codprog']));

    // Falta Crear una Validacion si ya existe esta programacion

    //$resultado = $t8_programacion->crear_porg($fecha_prog, $linea_despacho);

    if($id_programacion)
    {
        
        if (isset($_POST['txb_cliente']) && !empty($_POST['txb_cliente'])){

            $hora_cargue = test_input($_POST['txb_horacargue']);
            $hora_mix_obra = test_input($_POST['txb_hora_mixer_obra']);
            $id_cliente = test_input($_POST['txb_cliente']);
            $id_obra = test_input($_POST['txb_obras']);
            $id_producto = test_input($_POST['txb_producto']);
            $cantidad = test_input($_POST['txb_cantidad']);
            $cantidad = doubleval($cantidad);
            $total_despachado = test_input($_POST['txb_subTotal']);

            $id_vehiculo = test_input($_POST['txt_mixer']);
            $id_vehiculo = validar_vacios($id_vehiculo);
            $id_conductor = test_input($_POST['txt_conductor']);
            $id_conductor = validar_vacios($id_conductor);
            $observacion = test_input($_POST['txb_observaciones']);
            $observacion =validar_vacios($observacion);


            $id_detalle_prog = $t8_programacion->crear_detalle_porg($id_programacion,$hora_cargue,$hora_mix_obra,$id_cliente,$id_obra,$id_producto,$cantidad,$total_despachado);
            $t8_programacion->detallevariableprog($hora_cargue,$hora_mix_obra,$id_vehiculo,$id_conductor, $observacion, $id_detalle_prog);
            $php_estado = true;

        

        }else{
             $php_errores =  "Faltan Campos Requeridos";

        }

    }else{
        $php_errores =  "Error al Guardar la programacion #1";
    }
}else{
    $php_errores =  "Faltan Campos Requeridos";

}

function validar_vacios($data)
{
    if(empty($data)|| $data == 'NA')
    {
        $data = NULL;
    }
    
    return $data;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
