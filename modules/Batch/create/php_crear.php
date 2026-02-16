<?php

session_start();
header('Content-Type: application/json');



require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//require '../../../modelos/t4_productos.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t5_obras = new t5_obras();
$t26_remisiones = new t26_remisiones();
$t29_batch = new t29_batch();
$t10_vehiculo = new t10_vehiculo();


$general_modelos = new general_modelos();
$t4_productos = new t4_productos();


//$id_batch = $_POST['txt_remision_batch'];
$php_estado = false;
$error=array();
$success =array();
$rst = "";
$metros = 0;
$last_insert = 0;



if (isset($_POST['txt_remision_batch']) && !empty($_POST['txt_remision_batch'])) {

    $numero_remi = $php_clases->HR_Crypt($_POST['txt_remision_batch'], 2);
    $numero_remi = intval($numero_remi);
    $datos_remision = $t29_batch->select_batch_remi($numero_remi);


    if ($datos_remision) {
        foreach ($datos_remision as $datos) {
            //$remision = $fila1['ct29_Remision'];
            $num_remi = $datos['ct29_Remision'];
            $id_planta = $datos['ct29_IdPlanta'];
            $fecha_remision_remi = $datos['ct29_Fecha'];
            $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
            //$fecha_remision_remi = strftime("%A , %d de %B  del %Y", strtotime($fecha));
            $nombre_cliente_remi = $datos['ct29_IdCliente'];
			$nit = intval($datos['ct29_NIT']);
            $nit2 = intval($datos['ct29_CodigoCliente']);
            $nombre_obra =  $datos['ct29_IdObra'];
            $hora = $datos['ct29_Hora'];
            $placa = $datos['ct29_IdMixer'];
            $conductor = $datos['ct29_MixerDriver'];
            $sello = $datos['ct29_NumeroCilindro'];
            $metros += $datos['ct29_MetrosCubicos'];
            $idplanta = $datos['ct29_IdPlanta'];
            $nombre_producto = $datos['ct29_NombreFormula'];
            $descripcion_formula = $datos['ct29_DescripcionFormula'];
            $asentamiento = $datos['ct29_Asentamiento'];
            $despachador = $datos['ct29_Responsable'];
            $producto = $datos['ct29_NombreFormula'];

           
        }


        $codigo_remi = intval($num_remi);
        $razon_social = $nombre_cliente_remi;
        $nombre_obra = $nombre_obra;
        $nit = $php_clases->quitar_dv($nit);
        $placa = str_replace(' ', '',$placa);
        $placa = str_replace('  ', '',$placa);





        $descripcion_producto = $descripcion_formula;
        $codigo_producto = $nombre_producto;
        $id_vehiculo = null;

        $id_obra = 0;

        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($id_cliente = $t1_terceros->buscar_cliente_nit($nit)) {
        } elseif ($id_cliente = $t1_terceros->buscar_cliente_nit($nit2)) {
        } elseif ($id_cliente = $t1_terceros->buscar_cliente_razon_social($nombre_cliente_remi)) {
        } else {
            $id_cliente = null;
        }
        if (!is_null($id_cliente) || !empty($id_cliente) || $id_cliente = 0 || $id_cliente) {
            $success[] = "Cliente sincronizado correctamente ";
        } else {
            $error[] = "Error al sincronizar Cliente ";
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        if($t5_obras->sincro_obra_nombre($id_cliente,$nombre_obra)){
            $id_obra = $t5_obras->sincro_obra_nombre($id_cliente,$nombre_obra);
            $success[] = "Obra sincronizada correctamente";
        }else {
            $id_obra = null;
            $error[] = "Error al sincronizar Obra";
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($t4_productos->buscar_productos_descripcion($descripcion_producto)) {
            $id_producto = $t4_productos->buscar_productos_descripcion($descripcion_producto);
            $success[] = "Producto sincronizada correctamente";
        } else {
            if ($t4_productos->buscar_productos_codigo($codigo_producto)) {
                $id_producto = $t4_productos->buscar_productos_codigo($codigo_producto);
                $success[] = "Producto sincronizada correctamente";
            } else {
                $id_producto = null;
                $error[] = "Error al sincronizar Producto";
            }
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($t10_vehiculo->buscarvehiculo($placa)) {
            $id_vehiculo = $t10_vehiculo->buscarvehiculo($placa);
            $success[] = "Vehiculo sincronizado correctamente";
        } else {
            $id_vehiculo = null;
            $error[] = "Error al sincronizar Vehiculo";
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*
        if($t1_terceros->buscar_nombre_conductor($conductor)){
            $id_conductor = $t1_terceros->buscar_nombre_conductor($conductor);
            $success[] = "Conductor sincronizado correctamente";

        }else{
            $id_conductor = null;
            $error[] = "Error al sincronizar Conductor";
        }
        */
        



        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////


        $validar_existencia =   TRUE;

        
        

        if ($validar_existencia) {
            $id_conductor =null;
            $last_insert =  $t26_remisiones->insertar_remision($hora, $asentamiento, $despachador, $sello,$codigo_remi,$fecha, $id_planta,$id_cliente , $nit,  $nombre_cliente_remi, $id_obra, $nombre_obra, $metros, $id_producto,$codigo_producto, $descripcion_producto,  $id_vehiculo, $placa, $id_conductor, $conductor);

            if($last_insert){
                $success[] = "Remision Generada Exitosamente";
                    $last_insert = $php_clases->HR_Crypt($last_insert,1);
                $php_estado = true;
            }else{
                $error[] = "Error en al guardar la remision";

            }
        } else {
            $error[] = "Esta remision ya existe en la base de datos";
        }
        //$php_estado = true;
    } else {
        $php_estado = false;
        $error[] = "Error en la generacion de remision";
    }
} else {
    $php_estado = false;
    $error[] = "Faltan Campos ";
}


$datos = array(
    'estado' => $php_estado,
    'ultimo' => $last_insert,
    'exitoso' => $success,
    'errores' => $error,
    'resultado' => $rst,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
