<?php
session_start();
header('Content-Type: application/json');
require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';

$t1_terceros = new t1_terceros();
$php_clases = new php_clases();

$php_estado = false;
$php_mensaje = "";
$php_codigo = "#";
$errores = array();

if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia']))
{
    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars($_POST['contrasenia']);

    $datos_user = "NA";
    $datos_usuario = false;
    //$datos = false;
    $validacion_autenticacion = false;

    
    if(!$datosuser = $t1_terceros->autenticacion_tercero($php_usuario,$php_password) ){
        $php_mensaje =  "Usuario o Contraseña Incorrectos12";
    }else{
        $datos_user = $t1_terceros->get_datos_terceros_user($datosuser);
        foreach ($datos_user as $valor) {
            $id_usuario = $valor['ct1_IdTerceros'];
            $tipo_tercero = $valor['ct1_TipoTercero'];
            $nombre_usuario = $valor['ct1_RazonSocial'];
            $rol_usuario = $valor['ct1_rol'];
            $estado = $valor['ct1_Estado'];
            if($tipo_tercero == 3 && $estado == 1){
                $validacion_autenticacion = true;
            }elseif($tipo_tercero == 1 && $estado == 1){
                $validacion_autenticacion = true;
            }else{
                $php_mensaje = "El usuario(a) se encuentra inhabilitado ";
            }
        } // Fin Foreach

        if($validacion_autenticacion && $rol_usuario>100){
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $rol_usuario;
            $_SESSION['tipo'] = $tipo_tercero;


            switch ($rol_usuario) {
                case 101:
                case '101':
                    $php_estado = true;
                    $php_codigo = "portalcliente/modulos/facturacione/index.php";
                    break;
                case 102:
                case '102':
                    $php_estado = true;
                    
                    if( $php_usuario == $php_password){
                        $php_codigo = "portalcliente/modulos/profile/passnew.php";
                    }else{
                        $php_codigo = "portalcliente/modulos/remisiones/index.php";
                    }
                  
                    break;
                    case 103:
                        case '103':
                    $php_estado = true;
                            
                            if($php_usuario == $php_password){
                                $php_codigo = "portalcliente/modulos/profile/passnew.php";
                            }else{
                                $php_codigo = "portalcliente/modulos/remisiones_cliente/index.php";
                            }
                          
                            break;
        
                default:
                    $php_codigo = "cerrar.php";
                    $php_estado = false;
                    $php_error ="Usuario o Contraseña Incorrectos2";
                    break;
            }


        }else{
            $php_mensaje = "El usuario(a) se encuentra inhabilitado ";
        }


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

