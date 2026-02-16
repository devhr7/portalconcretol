<?php
session_start();
ob_start();

if (
    isset($_SESSION['session_key'])         && !empty($_SESSION['session_key']) &&
    isset($_SESSION['id_usuario'])  && !empty($_SESSION['id_usuario']) &&
    isset($_SESSION['rol_funcionario'])         && !empty($_SESSION['rol_funcionario'])
) {
    if (intval($_SESSION['rol_funcionario'] < 100)) {
        require '../../../librerias/autoload.php';
        include '../../../modelos/autoload.php';
        include '../../../vendor/autoload.php';
        $firephp = FirePHP::getInstance(true);


        $id_usuario = $_SESSION['id_usuario'];
        $nombre_usuario = $_SESSION['nombre_usuario'];
        $rol_user = intval($_SESSION['rol_funcionario']);
    } else {
        header('location: ../../../cerrar.php');
    }
} else {
    header('location: ../../../cerrar.php');
}
