<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


require 'modelo_prog.php';

$modelo_prog = new modelo_prog();

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

    $task = (int)htmlspecialchars($_POST['task']);
    $tipo = htmlspecialchars($_POST['tipo']);

// =======================================================================================================
    // Task 1 => Select Cliente
    if($task == 1 )
    {
        //$id_cliente = (int)$_POST['id_cliente'];
        $option_cliente = $modelo_prog->option_cliente_edit($id_cliente = null);
        $option_vehiculo = $modelo_prog->select_vehiculo_edit();
        $option_conductor = $modelo_prog->select_conductor();

        if($option_cliente)
        {
            $php_estado = true; 
        }else{
            $php_error[] = "Hubo Un Error al Cargar el Cliente";
        }

        // Guardar Array
        $datos = array(
            'estado' => $php_estado,
            'option_cliente' => $option_cliente,
            'option_vehiculo' => $option_vehiculo,
            'option_conductor' => $option_conductor,
        );

    }

// =======================================================================================================
    // Task 2 => Select Obra
    if($task == 2 && isset($_POST['id_cliente']))
    {
        $id_cliente = (int)$_POST['id_cliente'];
        $option_obra  =  $modelo_prog->option_obras($id_cliente);

        if($option_obra)
        {
            $php_estado = true; 
        }else
        {
            $php_error[] = "Hubo Un Error al Cargar La Obra";
        }
        // Guardar Array
        $datos = array(
            'estado' => $php_estado,
            'option' => $option_obra,
        );


    }
// =======================================================================================================

    // Task 3 => Select producto
    if($task == 3 && isset($_POST['id_cliente']) && isset($_POST['id_obras']))
    {
        $id_cliente = (int)$_POST['id_cliente'];
        $id_obra = (int)$_POST['id_obras'];
        $option_producto  =  $modelo_prog->option_producto_prog($id_obra,$id_cliente,$id_producto = null);

        if($option_producto)
        {
            $php_estado = true; 
        }else
        {
            $php_error[] = "Hubo Un Error al Cargar el producto";
        }
        // Guardar Array
        $datos = array(
            'estado' => $php_estado,
            'option' => $option_producto,
        );
    }

      // Task 3 => precio Producto
      if($task == 4 && isset($_POST['id_cliente']) && isset($_POST['id_obras']) && isset($_POST['id_producto']))
      {
          $id_cliente = (int)$_POST['id_cliente'];
          $id_obra = (int)$_POST['id_obras'];
          $id_producto = (int)$_POST['id_producto'];
      
          $precio_producto = $t4_productos->datos_precio_producto_prog($id_cliente,$id_obra,$id_producto); // traer option Obra
      
          if($precio_producto)
          {
              $php_estado = true; 
          }else
          {
              $php_error[] = "Hubo Un Error al Cargar el producto";
          }
          // Guardar Array
          $datos = array(
              'estado' => $php_estado,
              'precio' => $precio_producto,
          );
      }



    
}





echo json_encode($datos, JSON_FORCE_OBJECT);
