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


if(isset($_POST['id_detalle_prog']) && !empty($_POST['id_detalle_prog']) )
{
    $id_detalle_prog = intval(test_input($_POST['id_detalle_prog']));
    $hora_cargue = test_input($_POST['hora_cargue']);
    $hora_mix_obra = test_input($_POST['hora_mix_obra']);
    $observacion = test_input($_POST['observacion_edit']);
    $id_vehiculo =intval(test_input($_POST['txt_mixer_edit']));
    $id_conductor=intval(test_input($_POST['txt_conductor_edit']));


    // Falta Crear una Validacion si ya existe esta programacion

    $resultado = $t8_programacion->detallevariableprog($hora_cargue,$hora_mix_obra,$id_vehiculo,$id_conductor, $observacion, $id_detalle_prog);

    if($resultado)
    {
        $php_estado = true;
    }else{
    $php_errores =  "error al guardar";

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
