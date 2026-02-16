<?php

session_start();

header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$t5_obras = new t5_obras();
$modelo_obras = new modelo_obras();
$php_estado = false;
$errores = "ninguno";
$result = "";
$id_obra = null;

if (isset($_POST['cliente']) && !empty($_POST['cliente']) && isset($_POST['nombre_obra']) && !empty($_POST['nombre_obra'])) {
    $id_cliente = (int)htmlspecialchars($_POST['cliente']);
    $nombre_obra = htmlspecialchars($_POST['nombre_obra']);
    $id_departamento = htmlspecialchars($_POST['departamento']);
    $nombre_departamento = $modelo_obras->get_nombre_departamento($id_departamento);
    $id_ciudad = htmlspecialchars($_POST['municipio']);
    $nombre_ciudad = $modelo_obras->get_nombre_ciudad($id_ciudad);
    $id_comuna = htmlspecialchars($_POST['comuna']);
    $nombre_comuna = $modelo_obras->get_nombre_comuna($id_comuna);
    $barrio = htmlspecialchars($_POST['barrio']);
    $segmento = htmlspecialchars($_POST['segmento']);
    $direccion = htmlspecialchars($_POST['direccion']);

    $longitud = htmlspecialchars($_POST['txt_longitud']);
    $latitud = htmlspecialchars($_POST['txt_latitud']);
  


    $validar_existencia = $modelo_obras->validar_obra($id_cliente, $nombre_obra);
    if ($validar_existencia) {
        $id_obra = $modelo_obras->crear_obra($id_cliente, $nombre_obra, $id_departamento, $nombre_departamento, $id_ciudad, $nombre_ciudad, $id_comuna, $nombre_comuna, $barrio, $segmento, $direccion);
        if ($id_obra) {
            $modelo_obras->update_ciudad_departamento($id_obra, $id_departamento, $id_ciudad);
            $modelo_obras->update_latitud_longitud($id_obra, $latitud, $longitud);
            $php_estado = true;
        } else {
            $php_estado = false;
            $errores = "error al guardar en la base de datos";
        }
    } else {
        $errores = "Esta Obra ya existe en la base de datos";
    }
} else {
    $errores = "faltan campos requeridos";
}





$datos = array(

    'estado' => $php_estado,

    'errores'  => $errores,

    'last_id' => $id_obra,

    'post' =>$_POST

  

);





echo json_encode($datos, JSON_FORCE_OBJECT);

