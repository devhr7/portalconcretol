<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$data = false;

/**
 * Se verifica que la variable exista y no este vacia
 */
if (isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] &&  isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad']))) {
    /**
     * Se valida que la con
     */
    if (is_null($_POST['id_cliente']) && is_null($_POST['id_obra']) || empty($_POST['id_cliente']) && empty($_POST['id_obra'] )) {
        /**
         * Trae Datos de los clientes y obras asociados a esa novedad id_novedad
         */
        if (is_array($data_cli_obra = $cls_novedades->select_datos_cliente($_POST['id_novedad']))) {
            foreach ($data_cli_obra as $key) {
                $id_clientes[] = $key['id_cliente'];
                $id_obras[] = $key['id_obra'];
            }
            /**
             * Organiza el array el en una variable $var =  [1,2,3,4,5]; 
             * Con el fin de crear la consulta con IN.
             */
            $clientes = implode(",", $id_clientes);
            $obras = implode(",", $id_obras);
        }
    } else {
        $clientes = $_POST['id_cliente'];
        $obras = $_POST['id_obra'];
    }
    $data = $cls_novedades->select_datos_remisiones($_POST['fecha_novedad'], $clientes, $obras);
}

//print json_encode($datos, JSON_FORCE_OBJECT);



//print json_encode($clientes, JSON_UNESCAPED_UNICODE);
//print json_encode($obras, JSON_UNESCAPED_UNICODE);
print json_encode($data, JSON_UNESCAPED_UNICODE);
