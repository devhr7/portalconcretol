<?php
session_start();
require '../../../librerias/autoload.php';
    include '../../../modelos/autoload.php';
    include '../../../vendor/autoload.php';

if(isset($_SESSION['tipo'])         && !empty($_SESSION['tipo']) && 
    isset($_SESSION['id_usuario'])  && !empty($_SESSION['id_usuario']) &&
    isset($_SESSION['id_cliente1'])         && !empty($_SESSION['id_cliente1']) )
    {
        if ($_SESSION['tipo'] > 2)
        {
            $rs = true;
        }else
        {
            $rs = false;
        }
    }else {
        $rs = false;
    }



if($rs)
{
    require '../../../librerias/autoload.php';
    include '../../../modelos/autoload.php';
    include '../../../vendor/autoload.php';
    //include '../../../include/model/autoloaed3.php';
    
    

    $id_usuario = $_SESSION['id_usuario'];
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $rol_user = $_SESSION['rol'];
    $id_cliente = $_SESSION['id_cliente1'];


    
    
}else{
   // header('location: ../../../cerrar.php');
}
?>
    