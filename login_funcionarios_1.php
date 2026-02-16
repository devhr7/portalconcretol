<?php
session_start();
header('Content-Type: application/json');

require_once 'validacion.php';

$php_estado = false;
$php_codigo = "nada";
$php_error = "nada";
$datos_session = null;

if(isset($_POST['usuario']) && !empty($_POST['usuario']) && isset($_POST['contrasenia']) && !empty($_POST['contrasenia']))
{
    $php_usuario = htmlspecialchars($_POST['usuario']);
    $php_password = htmlspecialchars($_POST['contrasenia']);

    

    $datos_session =  $validacion->validar_sesion_funcionario($php_usuario, $php_password);
    
    if($datos_session)
    {
        $_SESSION['id_usuario'] = $datos_session['id_tercero'];
        $_SESSION['nombre_usuario'] = $datos_session['razon_social'];
        $_SESSION['rol_funcionario'] = $datos_session['rol_user'];
        $_SESSION['tipo'] = 2;
        
        
        switch ($datos_session['rol_user']){
            
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
            //case 25:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
            case 33:
                $php_codigo = "menu/dashboard.php";
                $php_estado = true;
            break;
        
        
            case 25:
                $php_codigo = "modules/datos_remisiones/";
                $php_estado = true;
            break;
        
            default:
                //$php_codigo = "cerrar.php";
                $php_estado = false;
                $php_error = "No tiene Permisos "; 
            break;
        }
    }else
    {
        $php_error = "usuario y contraseña Incorrectos";   
    }
    
}else
{
  $php_error = "Faltan llenar los campos Requeridos";   
}




            

$datos = array(
    'estado' => $php_estado,
    'codigo' => $php_codigo,
    'errores' => $php_error,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
?>