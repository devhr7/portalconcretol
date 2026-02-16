<?php
session_start();
header('Content-Type: application/json');
require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';

$t1_terceros = new t1_terceros();
$t11_usuarios = new t11_usuarios();
$php_clases = new php_clases();

$php_estado = false;
$php_mensaje = "";
$php_codigo = "#";
$errores = array();

if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia']))
{
    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars($_POST['contrasenia']);

    $datos_usuario = false;
    $datos = false;
    $validacion_autenticacion = false;

    $datos =   $t1_terceros->autenticacion_tercero($php_usuario,$php_password);

    if($datos == false){
        $datos =   $t1_terceros->autenticacion_tercero_email($php_usuario,$php_password);
        if($datos == false){
            $datos_usuario = $t11_usuarios->autenticacion_usuario($php_usuario,$php_password);
            if($datos_usuario == false){
                $errores =  "El usuario No se pudo autenticar";
            }
        }
    }
    
    // Traer datos
    if($datos){
        $datos = $t1_terceros->get_datos_terceros_user($datos);
        foreach ($datos as $valor) {
            $id_usuario = $php_clases->HR_Crypt($valor['ct1_IdTerceros'],1);
            $tipo_tercero = $valor['ct1_TipoTercero'];
            $nombre_usuario = $valor['ct1_RazonSocial'];
            $rol_usuario = $valor['ct1_rol'];
            $estado = $valor['ct1_Estado'];

            if($tipo_tercero == 10 && $estado == 1){
                $validacion_autenticacion = true;
            }else{
                $php_mensaje = "El usuario(a) se encuentra inhabilitado ";
            }
            
        }
    }
    if($datos_usuario){
        $datos_usuario = $t11_usuarios->get_datos_usuario($datos_usuario);   
        foreach ($datos_usuario as $valor) {
           
            $id_usuario = $php_clases->HR_Crypt($valor['ct11_IdUsuario'],1);
            $nombre_usuario = $valor['ct11_NombreUsuario'];
            $rol_usuario = $valor['ct11_IdRoles'];
            $estado = $valor['ct11_Estado'];
            
            if($estado == 1){
                $validacion_autenticacion = true;
            }else{
                $php_mensaje= "El usuario(a) se encuentra inhabilitado ";
            }
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////
        $hoy = date("d-m-Y H:i:s");
    if($validacion_autenticacion && $rol_usuario<100){
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol_funcionario'] = $rol_usuario;
        $key = base64_encode($hoy);
        $_SESSION['session_key'] = $key;


        //$validar_rol = $php_clases->validar_rol(array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30),$rol_usuario);
        



        switch ($rol_usuario){
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 21:
            case 22:
            case 23:
            case 24:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
                $php_codigo = "menu/dashboard.php";
                $php_estado = true;
            break;
        
        
            case 25:
                $php_codigo = "modules/datos_remisiones/";
                $php_estado = true;
            break;
        
            default:
                $php_codigo = "cerrar.php";
                $php_estado = false;
                $php_mensaje = "No tiene Permisos "; 
            break;
        }


    }else{
        $php_mensaje = "El usuario no tiene permisos";
    }
    

}else{
    $php_mensaje = "Faltan datos Requeridos para la autenticacion";
}



$datos = array(
    'estado' => $php_estado,
    'codigo' => $php_codigo,
    'errores' => $php_mensaje,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
