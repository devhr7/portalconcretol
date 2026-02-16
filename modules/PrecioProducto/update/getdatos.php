<?php

session_start();
header('Content-Type: application/json');

include '../../../include/conexion.php'; 

$connection = new conexion();
$connection->connect();


$php_estado = false;
$errores = "ninguno";
$resultado = "";
$option_cliente = "";

/******************************************************************************************************************************/
/******************************************************************************************************************************/
if($_POST['task'] == 2 && $_POST['tipo']== "Get_Obra"){
    
    $IdCliente = $_POST['id_cliente'];
    $EstadoCliente = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;
    
    //
    $EstadoObra = 1;
    $ct5_CupoEstado = "";
    $ct5_Cupo = "";
    $ct5_SaldoDisponible = "";
    $ct5_SaldoCartera = "";
            
  
    $ct5_CupoExtraEstado = "";
    $ct5_CupoExtra = "";
    $ct5_SaldoExtra = "";
  
    //
    $rowsArray_obra =  '';
    
    $QueryObra = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` =  ? AND `ct5_EstadoObra` = ?";
    $StmtObra = mysqli_prepare($connection->myconn, $QueryObra);
    $StmtObra->bind_param("ii",$IdCliente,$EstadoObra);
    $rowsArray_Obra = "";
    if ($StmtObra->execute()) {
        $php_msg = "Ejecuto Bien";
        $result = $StmtObra->get_result();
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
            $php_msg = "Hay Registros";
            $rowsArray_obra .=  '<option value="0">Seleccionar Obra</option>';
            while ($fila = $result->fetch_assoc()) {
              
                $rowsArray_obra .= '<option  value="' . $fila['ct5_IdObras'] . '">' . $fila['ct5_NombreObra'] . '</option>';
            }

            $php_msg = "Ejecuto Bien";
         
            $php_estado = true;
          
        }else {
            $rowsArray_obra =  '<option value="0">No se Encontraron Obras</option>';
            $php_estado = false;
        }
        
        
        $StmtObra->close();
    }else{
        $rowsArray_obra =  '<option value="0">Error Al cargar Obras</option>';;
       $php_msg = "Error Al Ejecutar Consulta Clientes";
       
    }
    
    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,
        'Obra' => $rowsArray_obra,

        
        
    );
     echo json_encode($datos, JSON_FORCE_OBJECT);
         
}


