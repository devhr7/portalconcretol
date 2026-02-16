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
$id_muestra = "#";

if (
    isset($_POST['txt_id_remi']) && !empty($_POST['txt_id_remi'])  &&  isset($_POST['txt_fecha_muestra']) && !empty($_POST['txt_fecha_muestra']) && isset($_POST['txt_hora_muestra']) && !empty($_POST['txt_hora_muestra'])
) {

    $fecha_muestra = $_POST['txt_fecha_muestra'];
    $hora_muestra = $_POST['txt_hora_muestra'];
    $id_remision = $_POST['txt_id_remi'];

    if ($cls_laboratorio->validar_muestra($cls_laboratorio->consql(), $_POST['txt_id_remi'])) {
        if ($datos_remi = $cls_laboratorio->get_data_remi($cls_laboratorio->consql(), $_POST['txt_id_remi'])) {
            $cod_remi = $datos_remi['remision'];
            $id_cliente = $datos_remi['id_cliente'];
            $cliente = $datos_remi['cliente'];
            $id_obra = $datos_remi['id_obra'];
            $obra = $datos_remi['obra'];
            $id_producto = $datos_remi['id_producto'];
            $codigo_producto = $datos_remi['cod_producto'];
            $descripcion_producto = $datos_remi['descripcion_producto'];
            $id_mixer = $datos_remi['id_vehiculo'];
            $placa = $datos_remi['mixer'];
            $metros_cubicos = $datos_remi['metros'];
            $asentamiento = $_POST['txt_asentamiento'];
            $temperatura = $_POST['txt_temperatura'];
            $linea = $datos_remi['linea'];

            switch ($datos_remi['linea']) {
                case 'RMI':
                case 'RZO':
                    $sede = "RMI";
                    break;
                case 'RMT':
                    $sede = "RMT";
                    break;
                case 'HND':
                    $sede = "HND";
                    break;
                default:

                    break;
            }


            if ($id_muestra = $cls_laboratorio->crear_muestra($fecha_muestra, $hora_muestra, $id_remision, $cod_remi, $id_cliente, $cliente, $id_obra, $obra, $id_producto, $codigo_producto, $descripcion_producto, $id_mixer, $placa, $metros_cubicos, $asentamiento, $temperatura, $sede)) {
                $php_estado = true;
                $datos_post['id_muestra'] = $id_muestra;
                $datos_post['hora'] = $_POST['txt_hora_muestra'];
                $datos_post['asentamiento'] = $_POST['txt_asentamiento'];
                $datos_post['temperatura'] = $_POST['txt_temperatura'];
                $cls_laboratorio->registrar_manejeabilidad($datos_post);
            } else {
                $errores = "Error al Guardar";
            }
        } else {
            $errores = "Error al Traer los datos de las remisiones";
        }
    } else {
        $errores = "Ya existen Muestras con esta remision";
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'id_muestra' => $id_muestra,
    'errores' => $errores,
    'rst' => $php_estado,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
