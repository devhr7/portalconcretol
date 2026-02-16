<?php


class t26_remisiones extends conexionPDO {

    private $id;
    

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    
    
    function editar_datos_remision($id_remision,$id_cliente,$id_obra,$id_conductor,$codigo_remi){
  
        $this->id_remision = $id_remision;
        $this->id_obra = $id_obra;
        $this->conductor = $id_conductor;
        $this->codigo_remi = $codigo_remi;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_idObra`= :id_obra,`ct26_conductor`= :id_conductor, `ct26_codigo_remi`= :codigo_remi WHERE `ct26_id_remision` = :id_remision";
        
        
        $stmt = $this->con->prepare($sql);
     
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_conductor', $this->conductor, PDO::PARAM_INT);
        $stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    
      
        // Ejecutar 
      $result = $stmt->execute();

      //resultado
      return $result;

       //Cerrar Conexion
      $this->PDO->closePDO();

    }
    // function editar_remision($img_remi,$ruta,$id_remision){
    //     $php_fechatime = date("Y-m-d H:i:s");
    //     $date = "".date('Y/m/d h:i:s', time());
        
    //     $this->id_remision = $id_remision;
    //     $this->img_remi = $img_remi;

    //     $php_fileexten = strrchr($this->img_remi, ".");
    //     $php_serial = strtoupper(substr(hash('sha1', $this->img_remi . $date), 0, 40)) . $php_fileexten;
        
        
    //     $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
    //     $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);

        
   

    //     $sql = "UPDATE `ct26_remisiones` SET `ct26_imagen_remi` = :img_remi WHERE `ct26_id_remision` = :id_remision";
    //     $stmt = $this->con->prepare($sql);

    //     $stmt->bindParam(':img_remi', $php_tempfoto, PDO::PARAM_STR);

    //     $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    //   // Ejecutar 
    //   if($result = $stmt->execute()){
    //     $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
    //   }

    //   //Cerrar Conexion
    //   $this->PDO->closePDO();

    //   //resultado
    //   return $result;
    // }
 


    function select_remisiones_obra($id_obra){
  
        $this->id = $id_obra;
        $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra  ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC";
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

    
       function select_remisiones_for_table(){
      
        $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_idObra , ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

    function select_remisiones(){
        $sql = "SELECT * FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
    function get_remision_id($id_remision){
         $this->id = $id_remision;
        
        $sql = "SELECT * FROM `ct26_remisiones`  WHERE ct26_id_remision = :id_remision ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
     function get_datos_for_admin()
    {
        //$this->id = $id_conductor;
        
        $sql = "SELECT * FROM `ct26_remisiones` INNER JOIN ct5_obras ON ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
    function get_datos_for_conductor($id_conductor)
    {
        $this->id = $id_conductor;
        
        $sql = "SELECT * FROM ct26_remisiones INNER JOIN ct5_obras ON ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE ct26_conductor = :id_conductor ORDER BY ct26_remisiones.ct26_id_remision DESC";
        
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_conductor', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
}