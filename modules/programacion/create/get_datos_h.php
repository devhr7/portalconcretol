<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$t8_programacion = new t8_programacion();
$t1_terceros = new t1_terceros();
$t4_productos = new t4_productos();
$t5_obras = new t5_obras();


$php_estado = false;
$option_obra = "<option>mal</option>";
$cupo_cliente = 0;
$std_danger = " bg-danger ";
$std_warning = " bg-warning ";
$std_success = " bg-success ";
$PorcentajeCliente = 0;
$cupo_cliente = 0;
$saldo_cliente = 0;
$std = "";
$err = "no detecta los POST";



if(isset($_POST['task']) && !empty($_POST['task']) && isset($_POST['tipo']) && !empty($_POST['tipo']) )
{

    // Task 1 => Select Cliente
    $task = (int)htmlspecialchars($_POST['task']);
    $tipo = htmlspecialchars($_POST['tipo']);


    if($task == 1 && isset($_POST['id_cliente']))
    {
        
    }

}



if ($_POST['task'] == 1 && $_POST['tipo'] == "get_obra") {

    $id_cliente = $_POST['idCliente'];
    $option_obra = $t5_obras->option_obras($id_cliente); // traer option Obra

    if ($option_obra) {
        $php_estado = true;
    }


    $datos_cliente = $t1_terceros->get_estado_cupo($id_cliente); // traer datos Cliente

    if ($datos_cliente) { // valida si los datos del cliente son validos
        foreach ($datos_cliente as $fila) {
            $cupo_cliente = $fila['ct3_Cupo']; // Cupo Cliente
            $saldo_cliente = $fila['ct3_SaldoCartera']; // saldo Cartera
            $PorcentajeCliente = ($saldo_cliente / $cupo_cliente) * 100; // Porcentaje Saldo 
        }

        // Validacion  Porcentaje Para cambiar el color del Card
        if ($PorcentajeCliente > 80) {
            $std = $std_success;
        }
        if ($PorcentajeCliente > 30 && $PorcentajeCliente < 80) {
            $std = $std_warning;
        }
        if ($PorcentajeCliente < 30) {
            $std = $std_danger;
        }
    } else {
        $php_error[] = " Este cliente esta definido el cupo ni saldo en cartera";
    }

    $cupo_cliente = number_format($cupo_cliente, 2, ',', ' '); // cupo formato pesos
    $saldo_cliente = number_format($saldo_cliente, 2, ',', ' '); // saldo Cliente Formato pesos
    $barraCliente = '<div class="progress-bar" style="width:' . $PorcentajeCliente . '%" ></div>'; // Barra de  estado de cartera 

    $datos = array(
        'estado' => $php_estado,
        'option' => $option_obra,
        'cupo_cliente' => $cupo_cliente,
        'saldo_cliente' => $saldo_cliente,
        'BarraCliente' => $barraCliente,
        'std' => $std,
        
    );
}



if ($_POST['task'] == 2 && $_POST['tipo'] == "get_datosobras") {


    $id_obra = $_POST['id_obras'];
    $id_cliente = $_POST['idCliente'];
    $option_producto = $t4_productos->option_producto_prog($id_obra,$id_cliente,$id_producto = null); // traer option Obra

    if ($option_producto) {
        $php_estado = true;
    } else {
        $option_producto = "<option>mal</option>";
    }

    $cupo_obra = 0;
    $saldo_obra = 0;
    $barraObra = 0;
    $std = 1;


    $datos = array(
        'estado' => $php_estado,
        'option' => $option_producto,
        'cupoObra' => $cupo_obra,
        'saldoObra' => $saldo_obra,
        'BarraCliente' => $barraObra,
        'std' => $std,
        'err' =>$err
    );
}



if ($_POST['task'] == 3 && $_POST['tipo'] == "get_datosproductos") {

    $id_cliente = $_POST['id_cliente'];
    $id_obra = $_POST['id_obras'];
    $id_producto = $_POST['id_producto'];

    $precio_producto = $t4_productos->datos_precio_producto_prog($id_cliente,$id_obra,$id_producto); // traer option Obra

    if ($precio_producto) {
        $php_estado = true;
    }

    $datos = array(
        'estado' => $php_estado,
        'precio' => $precio_producto,
        
        
    );
}else{
    
}




echo json_encode($datos, JSON_FORCE_OBJECT);
