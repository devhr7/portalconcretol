<?php

class t1_terceros extends conexionPDO {

    private $id;
    private $estado;
    private $tipo_tercero;
    private $numero_identificacion;
    private $razon_social;
    private $usuario;
    private $pass;
    private $rol;
    private $fecha_creacion;
    private $naturaleza;




    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    
    function select_tercero_id($id) {
        $this->id = $id;
          $sql = "SELECT * FROM ct1_terceros WHERE ct1_IdTerceros = :id_tercero";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

    function select_user_cliente() {
          $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 3 ORDER BY `ct1_IdTerceros` DESC" ;
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
    
    
    function restablecer_pass($id) {
        
        $this->id = $id;
        
        
         $sql = "SELECT ct1_NumeroIdentificacion FROM ct1_terceros WHERE ct1_IdTerceros = :id_tercero " ;
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        
         $stmt->bindParam(':id_tercero',$this->id, PDO::PARAM_INT);
        
          $result = $stmt->execute();
         
         while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $numero_identificacion = $fila['ct1_NumeroIdentificacion'];
             
         }
         
         
         if ($result &&  $numero_identificacion > 1){
                $this->pass = md5($numero_identificacion);
         
         
        $sql_edit = " UPDATE `ct1_terceros` SET ct1_pass = :pass WHERE `ct1_IdTerceros` = :id_cliente";
        
        $stmt2 = $this->con->prepare($sql_edit);
        
        $stmt2->bindParam(':pass',$this->pass, PDO::PARAM_STR);
        
        $stmt2->bindParam(':id_cliente',$this->id, PDO::PARAM_INT); 
         
        
          $result = $stmt2->execute();
        return $result;
         }else {
             return false;
         }
    
         
         
        
        
    }
    
    
    function editar_user_cliente ($numero_identificacion,$nombre1,$apellido1,$id_cliente1, $id) {
        $this->id = $id;
        
       
        $this->naturaleza = "PN";
       
        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->id_cliente1 = $id_cliente1;
        $this->apellido1 = $apellido1;
  
        $this->razon_social = $nombre1 . " ". $apellido1;

        $this->usuario = $numero_identificacion;
      
      

        $sql = "UPDATE ct1_terceros SET ct1_NumeroIdentificacion= :numero_identificacion, ct1_RazonSocial= :razon_social, ct1_Nombre1= :nombre1, ct1_Apellido1= :apellido1, ct1_usuario= :usuario,  ct1_id_cliente1 = :id_cliente1 WHERE ct1_IdTerceros = :id";
        
        
        $stmt = $this->con->prepare($sql);
         
  

        $stmt->bindParam(':numero_identificacion',$this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social',$this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1',$this->nombre1, PDO::PARAM_STR);
        

        $stmt->bindParam(':apellido1',$this->apellido1, PDO::PARAM_STR);
        
        $stmt->bindParam(':usuario',$this->usuario, PDO::PARAM_STR);
       
        $stmt->bindParam(':id_cliente1',$this->id_cliente1, PDO::PARAM_STR);
        $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        
        $this->PDO->closePDO();
        
        return $result;

    }
    
     
    function editar_funcionario($id,$numero_identificacion,$nombre1,$nombre2,$apellido1,$apellido2,$rol) {
        date_default_timezone_set('America/Bogota');

        $this->id = $id;
        
        $this->estado = 1;
        $this->naturaleza = "PN";
        $this->tipo_tercero = 10;
        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->razon_social = $nombre1 . " ". $apellido1;

        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = $rol;


        
        $sql = "UPDATE ct1_terceros SET ct1_Estado= :estado ,ct1_NumeroIdentificacion= :numero_identificacion, ct1_RazonSocial= :razon_social, ct1_Nombre1= :nombre1, ct1_Nombre2= :nombre2, ct1_Apellido1= :apellido1, ct1_Apellido2= :apellido2,ct1_usuario= :usuario, ct1_pass= :pass, ct1_rol= :rol WHERE ct1_IdTerceros = :id";
        
        
        $stmt = $this->con->prepare($sql);
         
  

        
        $stmt->bindParam(':estado',$this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion',$this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social',$this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1',$this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2',$this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1',$this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2',$this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario',$this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass',$this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol',$this->rol, PDO::PARAM_INT);
        $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        
        $this->PDO->closePDO();
        
        return $result;


    }
    


    function insertar_funcionario($numero_identificacion,$nombre1,$nombre2,$apellido1,$apellido2,$rol) {
        date_default_timezone_set('America/Bogota');

        $this->fecha_creacion = "".date("Y-m-d H:i:s");
        
        $this->estado = 1;
        $this->naturaleza = "PN";
        $this->tipo_tercero = 10;
        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->razon_social = $nombre1 . " ". $apellido1;

        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = $rol;


        
        
        $sql = "INSERT INTO `ct1_terceros`( `ct1_FechaCreacion`, `ct1_Estado`, `ct1_naturaleza`, `ct1_TipoTercero`, `ct1_TipoIdentificacion`, `ct1_NumeroIdentificacion`,  `ct1_RazonSocial`, `ct1_Nombre1`, `ct1_Nombre2`, `ct1_Apellido1`, `ct1_Apellido2`,  `ct1_usuario`, `ct1_pass`, `ct1_rol` ) VALUES (:fecha_creacion, :estado, :naturaleza, :tipo_tercero, :tipo_identificacion, :numero_identificacion, :razon_social ,:nombre1 , :nombre2 , :apellido1, :apellido2 ,:usuario ,:pass ,:rol )";
        $stmt = $this->con->prepare($sql);
         
  

        $stmt->bindParam(':fecha_creacion',$this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado',$this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':naturaleza',$this->naturaleza, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero',$this->tipo_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_identificacion',$this->tipo_identificacion, PDO::PARAM_STR);
        $stmt->bindParam(':numero_identificacion',$this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social',$this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1',$this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2',$this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1',$this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2',$this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario',$this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass',$this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol',$this->rol, PDO::PARAM_INT);
        //$stmt->bindParam(':estado',$this->estado, PDO::PARAM_INT);
        
        $result = $stmt->execute();
        
        
        $this->PDO->closePDO();
        
        return $result;


    }
    
    function select_funcionario_all(){
        $sql = "SELECT * FROM `ct1_terceros`  WHERE `ct1_TipoTercero` = 10 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC ";
        $stmt = $this->con->prepare($sql);
        
        $result = $stmt->execute();
        
        
        $this->PDO->closePDO();
        
        return $stmt;
        

    }

    function option_conductor_edit($id_cliente=null){
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND ct1_Estado = 1 AND ct1_rol = 25";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($id_cliente == $fila['ct1_IdTerceros']){
                $selection = "selected='true'";
            }else{
                $selection = "selected='true'";
                
            }
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" '. $selection .' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function option_cliente_edit($id_cliente){
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($id_cliente == $fila['ct1_IdTerceros']){
                $selection = "selected='true'";
            }else{
                $selection = "";
                
            }
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" '. $selection .' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    function option_cliente(){
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }




    function actualizar_cliente($id_cliente,$numero_identificacion,$razon_social){
        $this->id = $id_cliente;
        $this->estado = 1; 
        $this->numero_identificacion = $numero_identificacion;
        $this->razon_social = $razon_social;
        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = 101;

        $sql="UPDATE `ct1_terceros` SET ct1_Estado = :estado, ct1_NumeroIdentificacion = :numero_identificacion, ct1_RazonSocial = :razon_social, ct1_usuario = :usuario, ct1_pass = :pass,ct1_rol= :rol WHERE `ct1_IdTerceros` = :id_cliente";

        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':estado',$this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion',$this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social',$this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':usuario',$this->usuario, PDO::PARAM_INT);
        $stmt->bindParam(':pass',$this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol',$this->rol, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente',$this->id, PDO::PARAM_INT);

        
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $stmt;
    }

    function insertar_cliente($numero_identificacion,$razon_social){
        $this->estado = 1; 
        $this->tipo_tercero = 1;
        $this->numero_identificacion = $numero_identificacion;
        $this->razon_social = $razon_social;
        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = 101;


        $sql="INSERT INTO `ct1_terceros`( `ct1_Estado`, ct1_TipoTercero,`ct1_NumeroIdentificacion`, `ct1_RazonSocial`, `ct1_usuario`, `ct1_pass`, `ct1_rol`) VALUES (:estado,:tipo_tercero,:numero_identificacion,:razon_social,:usuario,:pass,:rol)";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':estado',                 $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_tercero',           $this->tipo_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion',  $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social',           $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':usuario',                $this->usuario, PDO::PARAM_INT);
        $stmt->bindParam(':pass',                   $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol',                    $this->rol, PDO::PARAM_INT);

        
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    function select_conductor() {
        $option = "<option> Seleccione un Conductor</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND ct1_rol = 25 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function select_clientes_3() {
        
        $sql = "SELECT ct1_IdTerceros,ct1_pass, ct1_NumeroIdentificacion, ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 1";
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

    function select_clientes() {

        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 1";
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

    function search_conductor() {

        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 2 AND ct1_rol = 25 AND ct1_Estado = 1";
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

        function search_tercero_custom_id_for_table($id) {
        $this->id = $id;

        $sql = "SELECT ct1_NumeroIdentificacion, ct1_RazonSocial  FROM ct1_terceros WHERE  ct1_IdTerceros = :id_tercero ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
    function search_tercero_custom_id($id) {
        $this->id = $id;

        $sql = "SELECT *  FROM ct1_terceros WHERE  ct1_IdTerceros = :id_tercero ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
    

}
