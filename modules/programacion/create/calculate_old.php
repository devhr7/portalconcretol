<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$t8_programacion = new t8_programacion();
$t1_terceros = new t1_terceros();
$t3_clientes = new t3_clientes();
$t4_productos = new t4_productos();
$t5_obras = new t5_obras();

$php_estado = false;
$subtotal = 0;
$php_error = "Todo Bien";


if ($_POST['task'] == 10 && $_POST['tipo'] == "calculate") {

    
    // se Valida si existen los Campos Requeridos
    if(isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])  && isset($_POST['id_obras']) && !empty($_POST['id_obras'])  && isset($_POST['id_producto']) && !empty($_POST['id_producto'])  &&  isset($_POST['cantidad']) && !empty($_POST['cantidad'])  ){
        
        //se guardan los datos POST en variables
        $id_cliente = intval($_POST['id_cliente']);
        $id_obra = intval($_POST['id_obras']);
        $id_producto = intval($_POST['id_producto']);
        //$precio_producto = $_POST['precio_producto']; //señuelo
        $cantidad = $_POST['cantidad'];
        
        // Se realiza funcion para traer el precio del producto
        $precio_producto = $t4_productos->datos_precio_producto_prog($id_cliente,$id_obra,$id_producto);

        // se realiza el calculo para guardar el Sub Total
        $pre_subtotal = $precio_producto * $cantidad;

        // Se valida que la Variable Traiga un valor
        if($pre_subtotal){ 

            //
            // ALTER TABLE `ct5_obras` ADD `ct5_cupo_estado` INT(10) NULL AFTER `ct5_DireccionObra`;
            //

            $datos_cliente = $t3_clientes->get_datos_cliente($id_cliente);

            if($datos_clientes){
                foreach ($datos_clientes as $key_client) {
                    $tipo_cli = $key_client['ct3_TipoCliente'];
                    $modalidad_pago_cli = $key_client['ct3_ModalidadPago'];
                    $cupo_estado_cli = $key_client['ct3_CupoEstado'];
                    $cupo_cli = $key_client['ct3_Cupo'];
                    $saldo_cartera_cli = $key_client['ct3_SaldoCartera'];

                }
            }

            // se valida la modalidad de pago credito o anticipado
            if($modalidad_pago_cli == 1){ //Credito
                //Evaluamos el estado del cupo
                if($cupo_estado_cli == 1){ // cupo estado activo
                    $saldo_disponible = $cupo_cli - $saldo_cartera_cli;
                    if($saldo_disponible > 0){ // se valida que sea un valor 
                        
                    }
                }else{

                }
                //
            }else
            if($modalidad_pago_cli == 2){ // Pago Anticipado
                //
                //
                //
            }else{
                //
                // 
            }

            //"SELECT  `ct3_TipoCliente`, `ct3_ModalidadPago`, `ct3_CupoEstado`, `ct3_Cupo`, `ct3_TotalDespachados`, `ct3_TotalRecaudado`, `ct3_SaldoDisponible`, `ct3_SaldoDisponibleInicial`, `ct3_SaldoCartera`, `ct3_SaldoInicialCartera`, `ct3_CupoExtraEstado`, `ct3_FechaCreacionCupoExtra`, `ct3_FechaLimiteCupoExtra`, `ct3_CupoExtra`, `ct3_SaldoExtra` FROM `ct3_clientes` WHERE 1"

            //si la modalidad de pago es de credito  o anticipado

            //Evaluar el estado del cupo

            //obtenemos  el saldo disponible.  = cupo credito - Saldo Cartera;

            // operamos  Saldo disponible - presubtotal;

            //validamos si se puede despachar. 

            // ------------------------------

            // Se Valida si tiene cupo de Obra cantidades. ?no => entonces se puede despachar si calculo.



            // 
            
            


            $php_estado = true;
            $subtotal = $pre_subtotal;
        }else{
            $php_error="Error al hacer calculo -PRE";
        }

    }else{
        $php_error = "Faltan Llenar los Campos requeridos";
    }


}else{
    $php_error = "Error 1";
} 


$datos = array(
    'estado' => $php_estado,
    'subtotal' => $subtotal,
    'err' => $php_error,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
