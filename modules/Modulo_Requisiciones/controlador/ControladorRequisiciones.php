<?php
   
    require_once ("./conexionBD/Conexion.php");
    require_once("./modelo/Requisicion.php");

    class ControladorRequisiciones
    {
    
        private $conexion;
        private $mysqli;

        public function __construct( ) 
        {
            $this->conexion = new Conexion( );
            $this->mysqli = $this->conexion->conectar( );
        }

    public function  listarRequisiciones(){
        $sql=$this->mysqli->query("SELECT * FROM requisicion WHERE ESTADO = 1");
        return $sql;
        }
        public function  listarRequisicioness(){
            $sql=$this->mysqli->query("SELECT * FROM requisicion WHERE ESTADO = 1 LIMIT 0,3");
            return $sql;
            }
    public function listarRequi($rol){
        $sql=$this->mysqli->query("SELECT * FROM requisicion WHERE ROLUSER='$rol' AND ESTADO = 1");
        return $sql;
    }
    public function listarRequiCoti($rol){
        $estado = "EN COTIZACION";
        $sql=$this->mysqli->query("SELECT * FROM requisicion WHERE ROLUSER='$rol' AND ESTADOREQUI ='$estado' AND ESTADO = 1");
        return $sql;
    }
    public function  listarProveedores(){
        $sql=$this->mysqli->query("SELECT * FROM proveedor");
        return $sql;
        }

    }
?>