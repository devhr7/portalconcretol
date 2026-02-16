<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//$con = new conexionPDO();
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;


if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id_remision = (int)htmlspecialchars($_POST['id']);

    if (isset($_POST['check_habilitar_horas']) || !empty($_POST['check_habilitar_horas'])) {

        $h_salida_mix_planta = $_POST['h_salida_mix_planta'];
        if($_POST['h_salida_mix_planta']<=0){
            $h_salida_mix_planta = NULL;
        }

        $h_llegada_mix_obra = $_POST['h_llegada_mix_obra'];
        if($_POST['h_llegada_mix_obra']<=0){
            $h_llegada_mix_obra = NULL;
        }

        $h_inicio_descargue = $_POST['h_inicio_descargue'];
        if($_POST['h_inicio_descargue']<=0){
            $h_inicio_descargue = NULL;
        }

        $h_terminacion_descargue = $_POST['h_terminacion_descargue'];
        if($_POST['h_terminacion_descargue']<=0){
            $h_terminacion_descargue = NULL;
        }

        $h_llegada_mix_planta = $_POST['h_llegada_mix_planta'];
        if($_POST['h_llegada_mix_planta']<=0){
            $h_llegada_mix_planta = NULL;
        }

        

        if ($result_hora = $t26_remisiones->actualizar_horas_remi($id_remision, $h_salida_mix_planta, $h_llegada_mix_obra, $h_inicio_descargue, $h_terminacion_descargue, $h_llegada_mix_planta)) {
            $php_estado = true;
            $php_error[] = "Guardo Correctamente las Horas";

        } else {
            $php_error[] = "Error al Guardar las Horas";
        }
    }else{
        $php_error[] = "No se ha habilitado ningun cambio horas" ;
    }

    ///////////////////////////////////////////////////////////////////////////

    if (isset($_POST['check_habilitar']) || !empty($_FILES['imgfiles'])) {

        $img_remi = htmlspecialchars($_FILES['imgfiles']['name']);
        $ruta = htmlspecialchars($_FILES['imgfiles']['tmp_name']);

        $result2 =  $t26_remisiones->editar_remision($img_remi, $ruta, $id_remision);

        if ($result2) {
            $php_estado = true;
            $php_error[] = "Guardo Correctamente la remision Fisica";
            
        } else {
            $php_estado = false;
            $php_error[] = "error al guardar en la base de datos";
        }
    }else{
        $php_error[] = "No se ha habilitado ningun cambio remision " ;
    }
    

} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
