<?php


class t3_clientes extends conexionPDO{
   
    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    
    function select_table_t1_cientes() {
        
      
        
        $sql = "SELECT * FROM `ct3_clientes`";         
        $stmt = $this->con->prepare($sql);
        
        //$stmt->bindParam(':id_tercero',$this->id, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        if($result){
        return $stmt;    
        }else{
            return false;
        }
        
        
         while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $id_terceros = $fila['ct3_IdTerceros'];
             $this->id_terceros =  $id_terceros;
             
             if (!empty($id_terceros)){
             
               $sql2 = "SELECT ct1_NumeroIdentificacion, ct1_RazonSocial FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";
               $stmt2 = $this->con->prepare($sql2);
               $stmt2->bindParam(':id_tercero',$this->id_terceros, PDO::PARAM_INT);        
               $result2 = $stmt2->execute();
               while ($fila2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                   $nit = $fila2['ct1_NumeroIdentificacion'];
                   $razon_social =$fila2['ct1_RazonSocial'];
               }
             }
             
             $tipo_cliente = $fila['ct3_TipoCliente'];
             $modalidad_pago = $fila['ct3_ModalidadPago'];
             $cupo_estado = $fila['ct3_CupoEstado']; 
         }
         
         
         
         
        
        
    }
    
    
}
