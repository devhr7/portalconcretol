<?php
header('Content-Type: application/json');
include '../../../include/conexion.php'; 

$connection = new conexion();
$connection->connect();





// TRAER SELECT CLIENTES
if($_POST['task'] == 1 && $_POST['tipo']== "Get_Cliente"){
    
    $rowsArray_cliente = "";
     $TipoTercero = 1; // 1 -> CLIENTE
    $EstadoCliente = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;
    
    $QueryCliente = "SELECT  `ct1_IdTerceros`,`ct1_NumeroIdentificacion`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_TipoTercero` = ? AND `ct1_Estado` = ?";
    $StmtCliente = mysqli_prepare($connection->myconn, $QueryCliente);
    $StmtCliente->bind_param("ii",$TipoTercero,$EstadoCliente);
    $rowsArray_cliente =  "";
    if ($StmtCliente->execute()) {
        $php_msg = "Ejecuto Bien";
        $result = $StmtCliente->get_result();
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
            $php_msg = "Hay Registros";
            $rowsArray_cliente .=  '<option value="0">Seleccionar Cliente</option>';;
            while ($fila = $result->fetch_assoc()) {
              
                $rowsArray_cliente .= '<option  value="' . $fila['ct1_IdTerceros'] . '">' . $fila['ct1_NumeroIdentificacion'] . " - " . $fila['ct1_RazonSocial'] . '</option>';
            }
            $php_estado = true;
        }else {
            $php_estado = false;
            $rowsArray_cliente .= '<option value="0">No hay Registro en la base de datos</option>';
        }
        
        
        $StmtCliente->close();
    }else{
       $php_msg = "Error Al Ejecutar Consulta Clientes";
       $rowsArray_cliente .= '<option value="0">Error Al Cargar Clientes</option>';
    }
    
    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,
        'cliente' => $rowsArray_cliente,
    );
     echo json_encode($datos, JSON_FORCE_OBJECT);
         
}

/******************************************************************************************************************************/
/******************************************************************************************************************************/


if($_POST['task'] == 2 && $_POST['tipo']== "get_DatosCliente"){
    
    $IdCliente = $_POST['id_cliente'];
    $EstadoCliente = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;
    
    //
    $ct3_CupoEstado = "";
    $ct3_Cupo = "";
    $ct3_SaldoDisponible = "";
    $ct3_SaldoCartera = "";
            
    $ct3_CupoExtraEstado = "";
    $ct3_CupoExtra = "";
    $ct3_SaldoExtra = "";
    $std = "";
  
    //
    
    $QueryCliente = "SELECT `ct3_IdTerceros`, `ct3_CupoEstado`, `ct3_Cupo`, `ct3_TotalDespachados`, `ct3_TotalRecaudado`, `ct3_SaldoDisponible`, `ct3_SaldoCartera`, `ct3_SaldoInicialCartera`, `ct3_CupoExtraEstado`, `ct3_CupoExtra`, `ct3_SaldoExtra` FROM `ct3_clientes` WHERE `ct3_IdTerceros` = ? AND `ct3_CupoEstado` = ?";
    $StmtCliente = mysqli_prepare($connection->myconn, $QueryCliente);
    $StmtCliente->bind_param("ii",$IdCliente,$EstadoCliente);
    $rowsArray_cliente = "";
    if ($StmtCliente->execute()) {
        $php_msg = "Ejecuto Bien";
        $result = $StmtCliente->get_result();
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
            $php_msg = "Hay Registros";
            while ($fila = $result->fetch_assoc()) {
                $ct3_CupoEstado = $fila['ct3_CupoEstado'];
                $ct3_Cupo1 = (double)$fila['ct3_Cupo'];
                $ct3_Cupo = number_format($fila['ct3_Cupo'],2,',', ' ');
                $ct3_SaldoDisponible1 =(double)$fila['ct3_SaldoDisponible'];
                $ct3_SaldoDisponible = number_format($fila['ct3_SaldoDisponible'],2,',', ' ');
                $ct3_SaldoCartera =number_format($fila['ct3_SaldoCartera'],2,',', ' '); 
                
                $ct3_CupoExtraEstado = $fila['ct3_CupoExtraEstado'];
                
                if($ct3_CupoExtraEstado == 1){
                    $ct3_CupoExtra = $fila['ct3_CupoExtra'];
                    $ct3_SaldoExtra = $fila['ct3_SaldoExtra'];
                }else{
                    $ct3_CupoExtra = 0;
                    $ct3_SaldoExtra = 0;
                }
                
               
                
                
            }
            $PorcentajeCliente = ($ct3_SaldoDisponible1 / $ct3_Cupo1) * 100;
            
            $std_danger = " bg-danger ";
            $std_warning = " bg-warning ";
            $std_success = " bg-success ";

            $barraCliente = '<div class="progress-bar" style="width:' . $PorcentajeCliente . '%" ></div>';

            if ($PorcentajeCliente > 80) {
                $std = $std_success;
            }
            if ($PorcentajeCliente > 60 && $PorcentajeCliente < 80) {
                $std = $std_warning;
            }
            if ($PorcentajeCliente < 60) {
                $std = $std_danger;
            }
            
            $php_estado = true;
        }else {
            $php_estado = false;
        }
        
        
        $StmtCliente->close();
    }else{
       $php_msg = "Error Al Ejecutar Consulta Clientes";
       
    }
    
    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,
        'cupo' => $ct3_Cupo,
        'saldo_disponible' => $ct3_SaldoDisponible,
        'saldo_cartera' => $ct3_SaldoCartera,
        'cupo_extra'=>$ct3_CupoExtra,
        'saldo_extra' => $ct3_SaldoExtra,
        'std' => $std,
        
        
    );
     echo json_encode($datos, JSON_FORCE_OBJECT);
         
}

/******************************************************************************************************************************/
/******************************************************************************************************************************/
if($_POST['task'] == 3 && $_POST['tipo']== "Get_Obra"){
    
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



/******************************************************************************************************************************/
/******************************************************************************************************************************/
if($_POST['task'] == 4 && $_POST['tipo']== "get_DatosObra"){
    
    $id_Obra = $_POST['id_Obra'];
    $EstadoCliente = 1; // 1 = HABILITADO: 2 ->INABILITADO : 3 -> PENDIENTE
    $php_msg = "iniciando";
    $php_estado = false;
    
    $ct5_CupoObra = "";
    $ct5_SaldoDisponibleObra = "";
    $ct5_CupoExtra = "";
    $ct5_SaldoExtra = "";
    
    
    //
  
    $std = "";
  
    //
    
    $QueryObra = "SELECT * FROM `ct5_obras` WHERE `ct5_IdObras`  = ?";
    $StmtObra = mysqli_prepare($connection->myconn, $QueryObra);
    $StmtObra->bind_param("i",$id_Obra);
    $rowsArray_obra = "";
    if ($StmtObra->execute()) {
        $php_msg = "Ejecuto Bien";
        $result = $StmtObra->get_result();
        $rowcount = $result->num_rows;
        if ($rowcount > 0) {
            $php_msg = "Hay Registros";
            while ($fila = $result->fetch_assoc()) {
               
                $ct5_CupoObra = $fila['ct5_CupoObra'];
                $ct5_SaldoDisponibleObra = $fila['ct5_SaldoDisponibleObra'];
               
                
                $ct5_CupoExtraEstado = $fila['ct5_CupoExtraEstado'];
                
                if($ct5_CupoExtraEstado == 1){
                    $ct5_CupoExtra = $fila['ct5_CupoExtra'];
                    $ct5_SaldoExtra = $fila['ct5_SaldoExtra'];
                }else{
                    $ct5_CupoExtra = 0;
                    $ct5_SaldoExtra = 0;
                }  
                
            }
            $PorcentajeCliente = ($ct5_SaldoDisponibleObra / $ct5_CupoObra) * 100;
            
            $std_danger = " bg-danger ";
            $std_warning = " bg-warning ";
            $std_success = " bg-success ";

            $barraCliente = '<div class="progress-bar" style="width:' . $PorcentajeCliente . '%" ></div>';

            if ($PorcentajeCliente > 80) {
                $std = $std_success;
            }
            if ($PorcentajeCliente > 60 && $PorcentajeCliente < 80) {
                $std = $std_warning;
            }
            if ($PorcentajeCliente < 60) {
                $std = $std_danger;
            }
            
            $php_estado = true;
        }else {
            $php_estado = false;
        }
        
        
        $StmtObra->close();
    }else{
       $php_msg = "Error Al Ejecutar Consulta Clientes";
       
    }
    
    $datos = array(
        'estado' => $php_estado,
        'msg' => $php_msg,

        'std' => $std,
        'CupoObra' => $ct5_CupoObra,
        'SaldoDisponibleObra' => $ct5_SaldoDisponibleObra,
        'CupoExtra' => $ct5_CupoExtra,
        'SaldoExtra' => $ct5_SaldoExtra,
        //'' = $,
        
    );
     echo json_encode($datos, JSON_FORCE_OBJECT);
         
}

