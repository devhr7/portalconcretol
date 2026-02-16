<?php

header('Content-Type: application/json');
include '../../../../layout/validar_session4.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$php_clases = new php_clases();


$php_estado = false;
$errores = "";
$rst = "";

$cls_laboratorio = new cls_laboratorio();
$id_usuario = $php_clases->HR_Crypt($_SESSION['id_usuario'], 2);
$errores = "nada";

if (
    isset($_POST['id_resultado']) && !empty($_POST['id_resultado'])
) {
    $id = $_POST['id_resultado'];
   $datos_post['id_resultado'] = $_POST['id_resultado'];
   $datos_post['id_muestra'] = $_POST['id_muestra'];
   $datos_post['id_periodo'] = $_POST['id_periodo'];
   $datos_post['nombre_peridofallo'] = $cls_laboratorio->get_nombre_periodo_fallo($_POST['id_periodo']);
   $datos_post['resistencia'] = $cls_laboratorio->get_resistencia_for_muestra( $_POST['id_muestra']);

    if ($cls_laboratorio->delete_resultado_muestra($id)) {

        if($cls_laboratorio->eliminar_consolidado_resultados($datos_post)){

        }

        $datos_post['promediokgcm2'] = $cls_laboratorio->promedio_kg_sobre_cm2($datos_post);
      
        $datos_post['porcentaje'] = $cls_laboratorio->porcentaje_por_edad($datos_post['promediokgcm2'],$datos_post['resistencia']);


        
        $cls_laboratorio->crear_consolidado_resultados($datos_post);
        $php_estado = true;
        $errores = "Eliminado Correctamente";


    } else {
        $php_estado = false;
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $datos_post,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
