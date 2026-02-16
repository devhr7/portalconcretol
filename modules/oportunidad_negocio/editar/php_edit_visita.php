<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;


if (isset($_POST['id_visita']) && !empty($_POST['id_visita']) &&
    isset($_POST['edit_fecha_vist']) && !empty($_POST['edit_fecha_vist'])
){
    $id = $_POST['id_visita'];
    $id_cliente = intval($_POST['id_clente_edit']);
    $fecha = $_POST['edit_fecha_vist'];
    $resultado = $_POST['edit_result_visit'];
    $observacion = $_POST['edit_obs_visit'];
   
    
    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */
    
    if($id_lastinsert = $op->edit_visita($id,$fecha,$resultado,$observacion)){
        if(is_array($arraydata = $op->getdate_for_id(intval($id_cliente))))
    {
        $php_estado = true;
        foreach ($arraydata as $key) {
            
            if(intval($id) == intval($key['id']))
            {
                $op->actualizar_resultado_op($id_cliente,$resultado); 
            }
        

        }
    }

    /**
     * /internal/images/remisiones/85017C96BDE3385DB4E956FF354D9710B30683F1.PNG
     * 
     */
    
    
        $php_estado = true;
    }else{
        $php_estado = false;
    }
} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);