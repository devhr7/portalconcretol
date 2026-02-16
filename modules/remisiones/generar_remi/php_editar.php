<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
//$con = new conexionPDO();
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();


$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error= "";
$result_bm = false;


if (isset($_POST['txt_cliente'])    && !empty($_POST['txt_cliente'])    &&
    isset($_POST['txt_mixer'])    && !empty($_POST['txt_mixer'])    && 
    isset($_POST['C_Obras'])        && !empty($_POST['C_Obras'])        && 
    isset($_POST['C_id_conductor']) && !empty($_POST['C_id_conductor']) && 
    isset($_POST['C_IdProductos'])  && !empty($_POST['C_IdProductos']) ) {

    $id_remision = $php_clases->HR_Crypt($_POST['id'],2);

    $id_cliente =(int) htmlspecialchars($_POST['txt_cliente']);
    
    $nombre_cliente_remi = $t26_remisiones->nombre_cliente($id_cliente);
    $nit = $t26_remisiones->identificacion_cliente($id_cliente);

    $id_obra = (int) htmlspecialchars($_POST['C_Obras']);

    $nombre_obra = $t26_remisiones->nombre_obra($id_obra);

    $id_mixer = (int)htmlspecialchars($_POST['txt_mixer']);
    
    
    $id_conductor = (int) htmlspecialchars($_POST['C_id_conductor']);
    $nombre_conductor = $t26_remisiones->nombre_cliente($id_conductor);
    $identificacion_conductor = $t26_remisiones->identificacion_cliente($id_conductor);




    $id_producto = (int)htmlspecialchars($_POST['C_IdProductos']);

    $codigo_producto = $t26_remisiones->codigo_producto($id_producto);
    $descripcion_producto = $t26_remisiones->descripcion_producto($id_producto);


    $observacion_desp = htmlspecialchars($_POST['txt_observaciones']);

    $estado = 3;
    //$result = $t26_remisiones->editar_datos_remision1($id_remision, $cliente, $obra_remi, $id_mixer,  $conductor, $id_producto,$estado,$observacion_desp  );
    $result = $t26_remisiones->editar_datos_remision1($id_remision, $id_cliente,$nit, $nombre_cliente_remi, $id_obra, $nombre_obra,  $id_mixer,$id_conductor , $identificacion_conductor,$nombre_conductor, $id_producto, $codigo_producto, $descripcion_producto, $estado, $observacion_desp);
    
    $tipo_hora_prog = $_POST['select_hora_programada'];
    $hora_programada = $_POST['hora_programada'];

    
    $result2 = $t26_remisiones->actualizar_hora_programada($id_remision,$tipo_hora_prog, $hora_programada); 

 
    if ($result) {

    

        $bomba = htmlspecialchars($_POST['select_servicio_bomba']);
        $id_op_bomba = (int)htmlspecialchars($_POST['select_op_bomba']);
        if($id_op_bomba<=0){
            $id_op_bomba = null;
        }
        $id_aux_bomba = (int)htmlspecialchars($_POST['select_aux_bomba']);
        if($id_aux_bomba<=0){
            $id_aux_bomba = null;
        }


        $result_bm = $t26_remisiones->actualizar_bombeo($id_remision,$bomba, $id_op_bomba, $id_aux_bomba);
        if($result_bm){
            $php_estado = true;
            $php_error = $result_bm;

        }else{
        $php_estado = false;
        $php_error = "error ". $id_aux_bomba;

        }

        //$php_error = $result;
    } else {
        $php_estado = false;
        $php_error = "error al guardar en la base de datos";
    }

}else{
    $php_error = "Faltan llenar los campos requeridos" ;
 }


$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $result_bm,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
