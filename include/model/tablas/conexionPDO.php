<?php
//require 'config.php';

class conexionPDO{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'concretolimasa';
    private $charset = 'utf8';
    
    protected $con = null;
    

    public function __construct(){

        $dns = "mysql:host=". $this->host . ";dbname=". $this->db_name.";charset=".$this->charset;
        try{
            $this->con = new PDO($dns,$this->user,$this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo 'Connection established!';

        }catch(Exception $e){
            $this->con = " Error en la Conexion en la base de datos ";
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