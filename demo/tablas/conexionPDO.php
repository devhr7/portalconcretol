<?php
//require 'config.php';
//namespace modelos;

class conexionPDO{

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'concretolimasa';
    private $charset = 'utf8';
    private $port ="3308";
    
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