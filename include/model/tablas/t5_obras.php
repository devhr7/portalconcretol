<?php

class t5_obras extends conexionPDO {

    private $id;
    private $estado;
    private $fecha_creacion; 
    private $id_cliente;
    private $nombre_obra;
    private $direccion_obra;



    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function option_obra_edit2( $id_obra){
       
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
      
        
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($id_obra == $fila['ct5_IdObras']){
                $selection = "selected='true'";
            }else{
                $selection = "";
                
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" '. $selection .' >' . $fila['ct5_NombreObra']  . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    function option_obra($id_cliente){
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
           
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" >' . $fila['ct5_NombreObra']  . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    function eliminar_obra($id){
        $this->id = $id;
        
        $sql = "DELETE FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        
         //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }
    
    

    function option_obra_edit($id_cliente, $id_obra){
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($id_obra == $fila['ct5_IdObras']){
                $selection = "selected='true'";
            }else{
                $selection = "";
                
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" '. $selection .' >' . $fila['ct5_NombreObra']  . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    
        function select_obras_id_for_table($id_obra){
        
        $this->id = $id_obra;

        $sql = "SELECT ct5_NombreObra, ct5_IdTerceros FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    
}


    function select_obras_id($id_obra){
        
        $this->id = $id_obra;

        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    
}

    function select_obras(){
       

            $sql = "SELECT * FROM ct5_obras ORDER BY `ct5_IdObras` DESC";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
    
            // Asignando Datos ARRAY => SQL
            //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
            // Ejecutar 
            $result = $stmt->execute();
    
            //Cerrar Conexion
            $this->PDO->closePDO();
    
            //resultado
            return $stmt;
        
    }

    function insertar_obra($id_cliente,$nombre_obra,$direccion_obra,$fecha_creacion){
        $this->estado = 1; 
        $this->fecha_creacion = $fecha_creacion;
        $this->id_cliente = $id_cliente;
        $this->nombre_obra = $nombre_obra;
        $this->direccion_obra = $direccion_obra;


        $sql="INSERT INTO `ct5_obras`(`ct5_EstadoObra`, `ct5_FechaCreacion`, `ct5_IdTerceros`, `ct5_NombreObra`, `ct5_DireccionObra`) VALUES (:estado, :fecha_creacion, :id_cliente, :nombre_obra, :direccion_obra)";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra',$this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $this->direccion_obra, PDO::PARAM_STR);
         
        $result = $stmt->execute();
        

        return $result;
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function editar_obra($id_obra,$id_cliente,$nombre_obra,$direccion_obra){
      
        
        $this->id_cliente = $id_cliente;
        $this->nombre_obra = $nombre_obra;
        $this->direccion_obra = $direccion_obra;
        $this->id = $id_obra;
       

        $sql="UPDATE `ct5_obras` SET `ct5_IdTerceros`= :id_cliente,`ct5_NombreObra`= :nombre_obra,`ct5_DireccionObra`= :direccion_obra WHERE `ct5_IdObras` = :id_obra";
        //$sql="INSERT INTO `ct5_obras`(`ct5_EstadoObra`, `ct5_FechaCreacion`, `ct5_IdTerceros`, `ct5_NombreObra`, `ct5_DireccionObra`) VALUES (:estado, :fecha_creacion, :id_cliente, :nombre_obra, :direccion_obra)";
        $stmt = $this->con->prepare($sql);
        
        

    
        $stmt->bindParam(':id_cliente',  $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $this->direccion_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra',  $this->id, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }


}