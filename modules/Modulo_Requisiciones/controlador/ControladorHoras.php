<?php
   
    require_once("../conexionBD/Conexion.php");
    require_once("../modelo/PerfilU.php");
    require_once("../modelo/Usuario.php");

    class ControladorUsuariosAdmin
    {
    
        private $conexion;
        private $mysqli;

        public function __construct( ) 
        {
            $this->conexion = new Conexion( );
            $this->mysqli = $this->conexion->conectar( );
        }

        public function listar( ) 
        {
            $resultado = $this->mysqli->query( "SELECT * FROM ct26_remisiones" );
            return $resultado;
        }
    }