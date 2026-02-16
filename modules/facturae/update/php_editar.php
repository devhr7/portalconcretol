<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$t27_factura = new t27_factura();
$t26_remisiones = new t26_remisiones();
$php_fechatime = "" . date("Y-m-d H:i:s");

$php_estado = false;
$php_error[] = "";
$resultado = "";

$id_factura = intval($_POST['id_factura']);

if(isset($_POST['id_factura']) && !empty($_POST['id_factura']))
{
/**
 * ================================================================================================
 * Actualizar Valor de la Factura
 * ================================================================================================
 */
if(isset($_POST['check_habilitar_valor']) && !empty($_POST['check_habilitar_valor']))
{
    $valor_factura = $_POST['valor_factura'];
    if($t27_factura->editar_valor_fact($id_factura,$valor_factura))
    {
        $php_estado = true;
        $php_error[] = "Valor de la factura Actualizado Correctamente";
    }else{
        $php_error[] = "No Fue Posible Actualizar valor de la factura";
    }
}


/**
 * ================================================================================================
 * Actualizar Numero de la Factura
 * ================================================================================================
 */
if(isset($_POST['check_habilitar_titulo']) && !empty($_POST['check_habilitar_titulo']))
{
    $numero_factura = $_POST['numero_factura'];

    if($t27_factura->editar_num_fact($id_factura,$numero_factura))
    {
        $php_estado = true;

        $php_error[] = "Titulo de la factura Actualizado Correctamente";

    }else{
        $php_error[] = "No Fue Posible Actualizar titulo de la factura";
    }
}
 

    
/**
 * ================================================================================================
 *  Actializar Archiivo Factura
 * ================================================================================================
 */
if(isset($_POST['check_habilitar_arch']) && !empty($_POST['check_habilitar_arch']))
{
    $php_estado = true;

    $image = htmlspecialchars($_FILES['image']['name']);
    $ruta = htmlspecialchars($_FILES['image']['tmp_name']);

    $php_fileexten = strrchr($_FILES['image']['name'], ".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['image']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;

    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/facturas/';
    $php_tempfoto = ('/internal/images/facturas/' . $php_serial);

    $actualizar_factura = $t27_factura->editar_archivo_factura($php_tempfoto, $id_factura);

    if ($actualizar_factura) {
        $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);

        $php_error = "Factura actualizada correctamente";
    }
}
/**
 * ================================================================================================
 * Actualizar Cliente y Obra
 * ================================================================================================
 */
if(isset($_POST['check_habilitar_cli_ob']) && !empty($_POST['check_habilitar_cli_ob']))
{
    $id_cliente = intval($_POST['Txb_IdTercero']);
    $id_obra = intval($_POST['Txb_IdObras']);
    if($t27_factura->editar_cli_obra($id_factura,$id_cliente,$id_obra))
    {
        $php_estado = true;

        $php_error[] = "Cliente y Obra Actualizado Correctamente";

    }else{
        $php_error[] = "No Fue Posible Actualizar Cliente y Obra";
    }
}
/**
 * ================================================================================================
 *  Actualizar Las Remisiones
 * ================================================================================================
 */

$php_remisiones = $_POST["remision"];

///remisiones seleccionadas
//$php_contadorremisiones = count($php_remisiones);

if ($php_remisiones) {
    $eliminar_remisiones = $t27_factura->eliminafactura_remi($id_factura);
    if ($eliminar_remisiones) {
        foreach ($php_remisiones as $number => $idremisiones) {
            $estado = 1;
            $t26_remisiones->actualizar_estado_remi_fact($idremisiones, $estado);
            $result2 = $t27_factura->insertar_factura_remi($id_factura, $idremisiones);
            if ($result2) {
                $php_estado = true;
                //$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
            } else {
                $php_error[] = "hubo un error al guardar las remisiones";
            }
        }
    }
}


/**
 * ================================================================================================
 *  Actualizar Las Anexos
 * ================================================================================================
 */


///remisiones seleccionadas

if (isset($_POST["anexo"])) {
    $php_contadoranexos = count($_POST["anexo"]);
    if($php_contadoranexos >= 1){
    $eliminar_remisiones = $t27_factura->eliminafactura_anexo($id_factura);

        foreach ($_POST["anexo"] as $number => $id_anexo) {
            $estado = 1;
            $result2 = $t27_factura->insertar_factura_anexo($id_factura, $id_anexo);
            if ($result2) {
                $php_estado = true;
                //$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
            } else {
                $php_error[] = "hubo un error al guardar las anexos";
            }
        }
    }else{
    $eliminar_remisiones = $t27_factura->eliminafactura_anexo($id_factura);

    }
   
}else{
    $eliminar_remisiones = $t27_factura->eliminafactura_anexo($id_factura);

}


}else{
    $php_error[] = "No es posible Actualizar la factura";
}


$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'post' => $_POST
);


echo json_encode($datos, JSON_FORCE_OBJECT);