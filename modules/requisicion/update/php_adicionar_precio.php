<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//$con = new conexionPDO();
$php_clases = new php_clases();
$cls_requisiciones = new cls_requisiciones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;


if (isset($_POST['txt_id_item1']) && !empty($_POST['txt_id_item1'])) {
   

    $proveedor = htmlspecialchars($_POST['txt_proveedor']);
    $id_item = htmlspecialchars($_POST['txt_id_item1']);
    $precio = htmlspecialchars($_POST['txt_precio']);
    $tipo_pago = htmlspecialchars($_POST['txt_tipo_pago']);
    $observacion_precio = $_POST['txt_observacion_precio'];


    if($id_cotizacion = $cls_requisiciones->crear_cotizacion_item($id_item, $proveedor, $precio,$observacion_precio,$tipo_pago)){
        if($_POST['txt_select_cotizacion'] == "subir_cotizacion"){

        
        
            $file_item = htmlspecialchars($_FILES['txt_file_cotizacion']['name']);
            $ruta_file = htmlspecialchars($_FILES['txt_file_cotizacion']['tmp_name']);
            $php_tempfoto = null;
        $cls_requisiciones->actualizar_pdf_cotizacion($id_cotizacion,$php_tempfoto,  $file_item, $ruta_file);

        }else{
                $php_tempfoto = $cls_requisiciones->get_ubicacion_filepfd(intval($_POST['txt_select_cotizacion']));
                $file_item = null;
                $ruta_file = null;
        $cls_requisiciones->actualizar_pdf_cotizacion($id_cotizacion,$php_tempfoto,  $file_item, $ruta_file);

    }

        $php_estado=  true;


}else{
    $php_estado=  false;

}


} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    'post' => $_POST,

    'result' => $id_cotizacion,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
