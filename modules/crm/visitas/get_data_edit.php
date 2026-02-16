<?php
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//se crea un objeto de la clase programacion
$cls_visitas_comerciales = new cls_visitas_comerciales();
$t1_terceros = new t1_terceros();
$visita_clientes = new visitas_clientes();
$t5_obras = new t5_obras();
$oportunidad_negocio = new oportunidad_negocio();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $cls_visitas_comerciales->get_visitas_comerciales_id($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            $id = $key['id'];
            $titulo = '';

            $id_comercial = $key['id_comercial'];
            $select_comercial = $oportunidad_negocio->select_comercial($key['id_comercial']);
            //$asesor_comercial = $key['asesor_comercial'];
            $id_objetivo_visita = $key['id_objetivo_visita'];
            $select_objetivo_visita = $visita_clientes->select_tipo_visita($key['id_objetivo_visita']);
            //$objetivo_visita = $key['objetivo_visita'];
            $id_tipo_cliente = $key['id_tipo_cliente'];
            $select_tipo_cliente = $oportunidad_negocio->select_tipo_cliente($key['id_tipo_cliente']);
            //$tipo_cliente = $key['tipo_cliente'];
            $id_tipo_plan_maestro = $key['id_tipo_plan_maestro'];
            $select_tipo_plan_maestro = $oportunidad_negocio->select_tipo_plan_maestro($key['id_tipo_plan_maestro']);
            //$plan_maestro = $key['plan_maestro'];
            $id_cliente = $key['id_cliente'];
            $documento = $key['documento'];
            $nombre_cliente = $key['nombre_cliente'];
            $telefono_cliente = $key['telefono_cliente'];
            $id_obra = $key['id_obra'];
            $nombre_obra = $key['nombre_obra'];
            $direccion_obra = $key['direccion_obra'];
            $id_sede = $key['id_sede'];
            $sede = $key['sede'];
            $id_departamento = $key['id_departamento'];
            $select_departamento = $oportunidad_negocio->select_departamento($key['id_departamento']);
            $id_municipio = $key['id_municipio'];
            $select_municipio= $oportunidad_negocio->select_municipio($id_departamento, $key['id_municipio']);
            $municipio = $key['municipio'];
            $id_zona = $key['id_zona'];
            $selct_zona = $oportunidad_negocio->select_comuna(intval($key['id_municipio']),$key['id_zona'] );
            $zona_comuna = $key['zona_comuna'];
            $barrio = $key['barrio'];
            $maestro_nuevo = $key['maestro_nuevo'];
            $id_maestro = $key['id_maestro'];
            $nombre_maestro = $key['nombre_maestro'];
            $telefono_maestro = $key['telefono_maestro'];
            $metros_potenciales = $key['metros_potenciales'];
            $fecha_fundida = $key['fecha_fundida'];
            $id_forma_contacto = $key['id_forma_contacto'];
            $select_forma_contacto = $oportunidad_negocio->select_resultado_visita($key['id_forma_contacto']);
            
            $id_resultado_visita = $key['id_resultado_visita'];
            $select_resultado_visita = $oportunidad_negocio->select_contacto($key['id_resultado_visita']);
          
            $observaciones = $key['observaciones'];
            $fecha_cumplimiento = $key['fecha_cumplimiento'];
            $start = $key['start'];
            $end = $key['end'];
 
            
      
        }
    } else {
        $data = false;
    }
} else {
    $data = false;
}

$datos = array(
    'post' => $_POST,
    'id'=>$id,
    'titulo' => $titulo,
    'id_comercial' => $id_comercial,
    'select_comercial' =>$select_comercial,
    'id_objetivo_visita' =>$id_objetivo_visita,
    'select_objetivo_visita' =>$select_objetivo_visita,
    'id_tipo_cliente' => $id_tipo_cliente,
    'select_tipo_cliente' => $select_tipo_cliente,
    'tipo_plan_maestro' => $select_tipo_plan_maestro,
    'documento' => $documento,
    'nombre_cliente' => $nombre_cliente,
    'telefono_cliente' => $telefono_cliente,
    'nombre_obra' => $nombre_obra,
    'direccion_obra' => $direccion_obra,
    'id_sede'=>$id_sede,
    'id_departamento'=>$id_departamento,
    'select_departamento'=> $select_departamento,
    'id_municipio'=>$id_municipio,
    'select_municipio'=>$select_municipio,
    'id_zona'=>$id_zona,
    'selct_zona'=>$selct_zona,
    'barrio'=>$barrio,
    'maestro_nuevo'=>$maestro_nuevo,
    'nombre_maestro'=>$nombre_maestro,
    'telefono_maestro'=>$telefono_maestro,
    'metros_potenciales'=>$metros_potenciales,
    'fecha_fundida'=>$fecha_fundida,
    'id_forma_contacto'=>$select_forma_contacto,
    'id_resultado_visita'=>$select_resultado_visita,
    'observaciones'=>$observaciones,
    'inicio' => $start,
    'fin' => $end,
    
);

echo json_encode($datos, JSON_FORCE_OBJECT);
