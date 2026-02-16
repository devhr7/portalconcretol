<?php //namespace librerias\conexionPDO;
require 'config.php';




class conexionPDO{

    private $host = DB_HOST;
    private $user = DB_USUARIO;
    private $pass = DB_CONTRA;
    private $dbname = DB_NOMBRE;
    private $charset = DB_CHARSET;
    private $port =DB_PORT;
    
    protected $con = null;
    

    public function __construct(){

        $dns = "mysql:host=". $this->host . ";port=".$this->port.";dbname=". $this->dbname.";charset=".$this->charset;
        try{
            $this->con = new PDO($dns,$this->user,$this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo 'Connection Establecida!';

        }catch(Exception $e){
            $this->con = " Error en la Conexion en la base de datos ";
            echo $this->con. "\n";
            echo $dns . "\n";
            echo "ERROR : ".$e->getMessage();
        }

        
    }

    public function connect(){
        return $this->con;
    }
    
    public function closePDO(){
        $this->con = null;
    }


}



?>