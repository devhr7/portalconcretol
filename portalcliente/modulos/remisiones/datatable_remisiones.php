<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$cls_remisiones = new modelo_remisiones();
$data = "no hay nada";

/**
 * Se verifica que la variable exista y no este vacia
 */
if (isset($_POST['id_cliente']) &&  isset($_POST['id_obra'])  ) {
    /**
     * Se valida que la con
     */
    if (!is_null($_POST['opcion']) || intval($_POST['opcion']) == 0 || !empty($_POST['opcion']) ) {
        /**
         * Trae Datos de los clientes y obras asociados a esa novedad id_novedad
         */
        $id_cliente = intval($_POST['id_cliente']);

        $data = $cls_remisiones->datatable_remisiones_cliente($id_cliente, null);
    } elseif($_POST['id_obra']) {
        $id_cliente = intval($_POST['id_cliente']);
        $id_obra = intval($_POST['id_obra']);
        $data = $cls_remisiones->datatable_remisiones_cliente($id_cliente, $id_obra);
    }

    
}

//print json_encode($datos, JSON_FORCE_OBJECT);



//print json_encode($clientes, JSON_UNESCAPED_UNICODE);
//print json_encode($obras, JSON_UNESCAPED_UNICODE);
print json_encode($data, JSON_UNESCAPED_UNICODE);
