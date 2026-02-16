<?php

header('Content-Type: application/json');
session_start();
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$cls_visitas_comerciales = new cls_visitas_comerciales();

$errores = "nada";

if (
    isset($_POST['txt_inicio_edit']) && !empty($_POST['txt_inicio_edit']) && isset($_POST['txt_fin_edit']) && !empty($_POST['txt_fin_edit'] && isset($_POST['objetivo_visita_edit']) && !empty($_POST['objetivo_visita_edit']))
) {

    $id = $_POST['txt_id'];

    $id_objetivo_visita = $_POST['objetivo_visita_edit'];
    $cliente_nuevo = $_POST['cliente_nuevo_edit'];
    $documento = $_POST['nit_edit'];
    $nombre_cliente = $_POST['nombre_completo_edit'];
    $telefono_cliente = $_POST['telefono_cliente_edit'];
    $nombre_obra = $_POST['nombre_obra_edit'];
    $direccion_obra = $_POST['direccion_obra_edit'];

    $asesora_comercial = $_POST['txt_asesora_comercial_edit'];

    $id_tipo_cliente = $_POST['tipo_cliente_edit'];
    $id_tipo_plan_maestro = $_POST['tipo_plan_maestro_edit'];

    $id_sede =$_POST['txt_sede_edit'];
    $id_departamento = $_POST['departamento_edit'];
    $id_municipio = $_POST['municipio_edit'];
    $idzona = $_POST['comuna_edit'];
    $barrio = $_POST['barrio_edit'];

    $maestro_nuevo = $_POST['maestro_nuevo_edit'];
    $nombre_maestro = $_POST['nombre_maestro_edit'];
    $telefono_maestro = $_POST['celular_maestro_edit'];

    $metros_potenciales = $_POST['m3_potenciales_edit'];
    $fecha_fundida = $_POST['fecha_posible_fundida_edit'];

    $id_forma_contacto = $_POST['contacto_cliente_edit'];
    $id_resultado_visita = $_POST['resultado_edit'];

    $observaciones = $_POST['obs_visit_edit'];
    
    $start = $_POST['txt_inicio_edit'];
    $end = $_POST['txt_fin_edit'];

    if($cls_visitas_comerciales->update_up_visita($id,$id_objetivo_visita,$cliente_nuevo,$documento, $nombre_cliente, $telefono_cliente, $start,$end)){
        // Asesor Comercial Objetivo Visita
        $cls_visitas_comerciales->update_asesor_comercial($id, $asesora_comercial, $id_objetivo_visita);
        // Cliente Nuevo
        $cls_visitas_comerciales->update_cliente_nuevo($id, $cliente_nuevo);
        // Asesor Cliente y Obra Nuevo
        $cls_visitas_comerciales->update_cliente_obra_nuevos($id, $documento, $nombre_cliente, $telefono_cliente,$nombre_obra,$direccion_obra);
        // Tipo Cliente y Tipo Plan Maestro
        $cls_visitas_comerciales->update_tipo_plan_maestro($id, $id_tipo_cliente, $id_tipo_plan_maestro);
        // Ubicacion
        $cls_visitas_comerciales->update_lugar($id, $id_sede, $id_departamento,$id_municipio, $idzona, $barrio );
        // Maestros
        $cls_visitas_comerciales->update_maestro_nuevo($id, $maestro_nuevo, $nombre_maestro, $telefono_maestro);
        // M3 
        $cls_visitas_comerciales->update_proyeccion_fundida($id, $metros_potenciales, $fecha_fundida);
        //
        $cls_visitas_comerciales->update_resultado($id, $id_forma_contacto, $id_resultado_visita);
        //
        $cls_visitas_comerciales->update_observaciones($id, $observaciones);
        $php_estado = true;
    }else{
        $php_estado = false;
    }




} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);

