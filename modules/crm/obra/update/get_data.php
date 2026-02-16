<?php 

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$modelo_obra = new modelo_obras();
$php_estado = false;
$errores = "";
$select_ciudad = null;
$select_dpt = null;

if(!empty($_POST['task']) && isset($_POST['task']))
{
    if(intval($_POST['task']) == 1)
    {
        $id_municipio = intval($_POST['id_municipio']);
        $id_departamento = intval($_POST['id_departamento']);
        $select_ciudad = $modelo_obra->select_ciudad($id_departamento,$id_municipio);
        $select_dpt = $modelo_obra->select_departamento($id_departamento);
    }elseif (intval($_POST['task']) == 2) {
        $id_departamento = intval($_POST['id_departamento']);
        $select_ciudad = $modelo_obra->select_ciudad($id_departamento);
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores'  => $errores,
    'ciudad'  => $select_ciudad,
    'departamento'  => $select_dpt,
    'post' => $_POST
);

echo json_encode($datos, JSON_FORCE_OBJECT);