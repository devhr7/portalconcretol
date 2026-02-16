<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$eventos = new eventos();
$programacion = new programacion();
$php_clases = new php_clases();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['rol_funcionario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol_funcionario'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
}

$fecha_actual = new DateTime();
$hoy = $fecha_actual->format("Y-m-d H:i:s");

if (isset($_POST['task'])) {
    if ($_POST['task'] == 1) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id'];
            $inicio = $_POST['start'];
            $fin = $_POST['end'];
            if ($programacion->editar_programacion($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
            }
        }else{
            $php_error = "No puede hacer eso joven";
        }
    } elseif ($_POST['task'] == 2) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id_prog_evento']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id_prog_evento'];
            $estado = 2;
            $id_cliente = $_POST['edit_txt_cliente'];
            $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
            $id_obra = $_POST['edit_txt_obra'];
            $nombre_obra = $programacion->get_nombre_obra($id_obra);
            $cantidad = $_POST['edit_txt_cant'];
            $id_producto = $_POST['edit_txt_producto'];
            $nombre_producto = $programacion->get_nombre_producto($id_producto);
            $inicio = $_POST['edit_start'];
            $fin = $_POST['edit_end'];
            if ($programacion->editar_toda_prog_semanal($id, $estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_producto, $nombre_producto, $cantidad, $inicio, $fin, $id_usuario, $nombre_usuario, $hoy)) {
                $php_estado = true;
            }
        }else{
            $php_error = "No puede hacer esta accion";
        }
    } elseif ($_POST['task'] == 3) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id'];
            if ($programacion->eliminar_programacion($id)) {
                $php_estado = true;
            }
        }else{
            $php_error = "No puede modificar esta programacion";
        }
    }
}

$datos = array(
    'POST' => $_POST,
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'task' => $_POST['task']
);

echo json_encode($datos, JSON_FORCE_OBJECT);
