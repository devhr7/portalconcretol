<?php

header('Content-Type: application/json');
session_start();
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;

$errores = "nada";

if (
    isset($_POST['id_oportunidad_negocio']) && !empty($_POST['id_oportunidad_negocio'])
) {
    $id = $_POST['id_oportunidad_negocio'];
    //$op->log_registro_oportunidad_negocio($accion, $descripcion, $id_oportunidad, $id_usuario);
    $errores = "paso 0";
    if (isset($_POST['check_hab_asesora_comercial']) && !empty($_POST['check_hab_asesora_comercial'])) {
        if ($op->actualizar_asesora_comercial($_POST['asesora_comercial'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['asesora_comercial'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_sede']) && !empty($_POST['check_hab_sede'])) {
        $nombre_sede = $op->get_nombre_sede($_POST['sede']);

        if ($op->actualizar_sede($_POST['sede'], $nombre_sede, $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['sede'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_fecha_contacto']) && !empty($_POST['check_hab_fecha_contacto'])) {
        if ($op->actualizar_fecha_contacto($_POST['fecha_contacto'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['fecha_contacto'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
        if ($op->actualizar_fecha_contacto($_POST['fecha_contacto'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['fecha_contacto'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }

    if (isset($_POST['check_tipo_cliente']) && !empty($_POST['check_tipo_cliente'])) {
        if (!empty($_POST['tipo_plan_maestro'])) {
            if ($op->actualizar_tipo_cliente($_POST['tipo_cliente'], $_POST['tipo_plan_maestro'], $id)) {
                $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['tipo_cliente'] . " - " . $_POST['tipo_plan_maestro'], $id, $_SESSION['id_usuario']);
                $php_estado = true;
            }
        } else {
            if ($op->actualizar_tipo_cliente($_POST['tipo_cliente'], 3, $id)) {
                $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['tipo_cliente'] . " - ", $id, $_SESSION['id_usuario']);
                $php_estado = true;
            }
        }
    }

    if (isset($_POST['check_hab_dpt_municipio']) && !empty($_POST['check_hab_dpt_municipio'])) {
        if (!empty($_POST['comuna'])) {
            if ($op->actualizar_dep_municipio($_POST['departamento'], $_POST['municipio'], $_POST['comuna'], preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['barrio'])), $id)) {
                $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['departamento'] . $_POST['municipio'] . " - " . $_POST['comuna'] . " - " . $_POST['barrio'], $id, $_SESSION['id_usuario']);
                $php_estado = true;
            } else {
                if ($op->actualizar_dep_municipio($_POST['departamento'], $_POST['municipio'], " ", preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['barrio'])), $id)) {
                    $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['departamento'] . $_POST['municipio'] . " - " . $_POST['barrio'], $id, $_SESSION['id_usuario']);
                    $php_estado = true;
                }
            }
        }
    }
    if (isset($_POST['check_hab_datos_cliente']) && !empty($_POST['check_hab_datos_cliente'])) {
        if ($op->actualizar_datos_cliente(preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['nit']), preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_completo'])), preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['ap_completo'])), preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['telefono_cliente']), $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['nit'] . $_POST['nombre_completo'] . " - " . $_POST['ap_completo'] . " - " . $_POST['telefono_cliente'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
        if ($op->actualizar_nombre_completo(preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_completo'])), preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['ap_completo'])), $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['nombre_completo'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_datos_obra']) && !empty($_POST['check_hab_datos_obra'])) {
        if ($op->actualizar_datos_obra(preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_obra'])), strtoupper($_POST['direccion_obra']), $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['nombre_obra'] . $_POST['direccion_obra'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_datos_maestro']) && !empty($_POST['check_hab_datos_maestro'])) {
        if ($op->actualizar_datos_maestro(preg_replace('/[@\.\;\%\$\%\&]+/', '', strtoupper($_POST['nombre_maestro'])), preg_replace('/[@\.\;\%\$\%\ ]+/', '', $_POST['celular_maestro']), $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['nombre_maestro'] . $_POST['celular_maestro'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_potencial']) && !empty($_POST['check_hab_potencial'])) {
        if ($op->actualizar_datos_potencia($_POST['m3_potenciales'], $_POST['fecha_posible_fundida'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['m3_potenciales'] . $_POST['fecha_posible_fundida'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_resultado']) && !empty($_POST['check_hab_resultado'])) {
        if ($op->actualizar_datos_resultado($_POST['resultado'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['resultado'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if (isset($_POST['check_hab_contacto']) && !empty($_POST['check_hab_contacto'])) {
        if ($op->actualizar_datos_contacto($_POST['contacto_cliente'], $id)) {
            $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['contacto_cliente'], $id, $_SESSION['id_usuario']);
            $php_estado = true;
        }
    }
    if ($op->actualizar_datos_observaciones($_POST['observacion'], $id)) {
        $op->log_registro_oportunidad_negocio("Actualizar", "se actualizo el campo " . $_POST['observacion'], $id, $_SESSION['id_usuario']);
        $php_estado = true;
    }
    /**
     * STATUS
     * 1- Aprobado
     * 2- En Progreso
     * 10- Rechazhado 
     */

    // if($id_lastinsert = $op->editar_oportunidad($id,$numero_identificacion,$nombre_completo, $apellido_completo, $resultado)){
    //     $op->actualizar_resultado_op($id,$resultado);
    //     $php_estado = true;

    // }else{
    //     $php_estado = false;
    // }


} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
