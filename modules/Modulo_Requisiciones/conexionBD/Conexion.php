<?php
    class Conexion 
    {
        // ----------------------------------------------------
        // Atributos
        // ----------------------------------------------------

        private $host;
        private $usuario;
        private $password;
        private $baseDatos;
        private $conexion = null;
        
        // ----------------------------------------------------
        // Constructor
        public function __construct( )
        {
            $this->host = "162.241.61.153";
            $this->usuario = "concr_adminconcretol";
            $this->password = "Nirvana1310";
            $this->baseDatos = "concr_bdportalconcretol";
        }


        // ----------------------------------------------------
        // Metodos
        // ----------------------------------------------------

        public function conectar( ) {
            $mysqli = new mysqli( $this->host, $this->usuario, $this->password, $this->baseDatos );

            if( $mysqli->connect_errno ) {
                echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
        
            return $mysqli;
        }

        

    
    }
?>