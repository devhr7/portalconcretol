<?php


class t27_factura extends conexionPDO {

    public $con;
    

    private $id;
    private $numero_factura;
    private $fecha_subida;
    private $archivo;
    private $valor;
    private $nota;
    private $id_remision;
    private $id_cliente;
    private $id_obra;
    private $id_usuario;

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function editar_datos_factura($numero_factura,$valor,$id_cliente,$id_obra){
  
        $this->numero_factura = $numero_factura;
        $this->valor = $valor;
        $this->id_cliente = $id_cliente;
        $this->id_obra = $id_obra;

        $sql = "UPDATE `ct27_facturae` SET `ct27_nombre_factura`= :numero_factura,`ct27_conductor`= :id_conductor, `ct26_codigo_remi`= :codigo_remi WHERE `ct26_id_remision` = :id_remision";
        
        
        $stmt = $this->con->prepare($sql);
     
        $stmt->bindParam(':numero_factura', $this->numero_factura, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $this->valor, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    
      
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
    
    
    
    
    function buscar_factura_remi($id_factura){

        
        $this->numero_factura = $id_factura;
       
   
        $sql="SELECT  * FROM `ct28_factura_remi` WHERE `ct28_id_fact` = :id_factura";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':id_factura',$this->numero_factura, PDO::PARAM_INT);
       

         
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $stmt;
    }

    function insertar_factura_remi($id_factura,$id_remision){

        
        $this->numero_factura = $id_factura;
        $this->id_remision =$id_remision;
   
        $sql="INSERT INTO `ct28_factura_remi`(`ct28_id_fact`, `ct28_id_remision`) VALUES (:id_factura, :id_remision)";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':id_factura',                 $this->numero_factura, PDO::PARAM_INT);
        $stmt->bindParam(':id_remision',           $this->id_remision, PDO::PARAM_INT);

         
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }


    function insertar_factura($numero_factura,$fecha_subida, $archivo , $valor, $id_remision, $id_cliente, $id_obra, $id_usuario){

        
        $this->numero_factura = $numero_factura;
        $this->fecha_subida = $fecha_subida;
        $this->archivo = $archivo;
        $this->valor = $valor;
        $this->nota = "ninguna";
        $this->id_remision =$id_remision;
        $this->id_cliente =$id_cliente;
        $this->id_obra =$id_obra;
        $this->id_usuario = 1;

        $sql="INSERT INTO `ct27_facturae`( `ct27_nombre_factura`, `ct27_fecha_subda`, `ct27_archivofact`, `ct27_valorfact`, `ct27_notas`, `ct27_id_remisiones`, `ct27_id_cliente`, `ct27_id_obra`, `ct27_id_usuario`)
         VALUES (:nombre_factura, :fecha_subida, :archivo_fact, :valor, :notas, :id_remision, :id_cliente, :id_obra, :id_usuario)";
        $stmt = $this->con->prepare($sql);
        
        $stmt->bindParam(':nombre_factura',                 $this->numero_factura, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_subida',           $this->fecha_subida, PDO::PARAM_STR);
        $stmt->bindParam(':archivo_fact',  $this->archivo, PDO::PARAM_STR);
        $stmt->bindParam(':valor',           $this->valor, PDO::PARAM_INT);
        $stmt->bindParam(':notas',           $this->nota, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision',                $this->id_remision, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente',                $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra',                $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario',                $this->id_usuario, PDO::PARAM_INT);
         
        $result = $stmt->execute();


         // Devolver el ultimo Registro insertado
         $id_insert = $this->con->lastInsertId();

        //Cerrar Conexion
        $this->PDO->closePDO();

        return $id_insert;
    }


    function select_factura(){
        $sql = "SELECT * FROM `ct27_facturae`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexionid_remision
        return $stmt;

    }

    function select_factura_id($id_factura){
        $this->id =$id_factura;

        $sql = "SELECT * FROM `ct27_facturae` WHERE `ct27_id_factura` = :id_factura";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_factura', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexionid_remision
        return $stmt;

    }
    function select_factura_cliente($id_cliente){

        $this->id_cliente =$id_cliente;


        $sql = "SELECT * FROM `ct27_facturae` WHERE `ct27_id_cliente` = :id_cliente ORDER BY `ct27_facturae`.`ct27_fecha_subda` DESC ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    
    
}