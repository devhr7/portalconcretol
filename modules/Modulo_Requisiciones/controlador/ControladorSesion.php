<?php
   
    require_once("../conexionBD/Conexion.php");
    require_once("../modelo/Usuario.php");
    require_once("../modelo/PerfilU.php");

    class ControladorSesion
    {
    
        private $conexion;
        private $mysqli;

        public function __construct( ) 
        {
            $this->conexion = new Conexion( );
            $this->mysqli = $this->conexion->conectar( );
        }
    public function buscarTipoDoc( ){
        $sql =  $this->mysqli->query("SELECT * FROM tipo_de_documento");
        return $sql;
    }
    public function buscarEmpresa( ){
        $sql =  $this->mysqli->query("SELECT * FROM empresa");
        return $sql;
    }
    public function buscarMunicipio( ){
        $sql =  $this->mysqli->query("SELECT * FROM municipio");
        return $sql;
    }
    public function insertar(Usuario $usuario){
            
        $idEmpresa= $usuario->getIdEmpresa();
        $idTipoDoc= $usuario->getIdTipoDoc();
        $idMunicipio= $usuario->getIdMunicipio();
        $nombre= $usuario->getNombre();
        $apellido= $usuario->getApellido();
        $edad= $usuario->getEdad();
        $genero= $usuario->getGenero();
        $correo= $usuario->getCorreo();
        $celular= $usuario->getCelular();
        $numdoc= $usuario->getNumdoc();
        $contrasena= $usuario->getContrasena();
   

            $sentencia = $this->mysqli->prepare( "INSERT INTO usuario (IDEMPRESA ,IDTIPODOC,IDMUNICIPIO,NOMBRE,	APELLIDO,EDAD,GENERO,CORREO,CELULAR,NUMDOC,CONTRASENA) 
            VALUES( ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?)" );
            $sentencia->bind_param( "iiississsis", $idEmpresa,$idTipoDoc,$idMunicipio,$nombre, $apellido,$edad,$genero,$correo,$celular,$numdoc,$contrasena);
            $sentencia->execute( );
        }
    
    public function consultaCorreo($correo){
        $sql =  $this->mysqli->query("SELECT NOMBRE,GENERO FROM usuario WHERE CORREO='$correo'");
        return $sql;
    }
    public function consultaPerfil($correo){
        $sql = $this->mysqli->query("SELECT * FROM usuario,tipo_de_documento where usuario.CORREO='$correo' and usuario.IDTIPODOC = tipo_de_documento.IDTIPODOC");
        return $sql;
    }
    public function buscar($correo){
        $sql = $this->mysqli->query("SELECT * FROM usuario where CORREO='$correo'");
        return $sql;
    }
    public function actualizar(PerfilU $perfil){
        $id = $perfil->getId();
        $nombre=$perfil->getNombre();
        $apellido=$perfil->getApellido();
        $edad=$perfil->getEdad();
        $genero=$perfil->getGenero();
        $correo=$perfil->getCorreo();
        $celular=$perfil->getCelular();
        $contrasena=$perfil->getContrasena();


        $sentencia = $this->mysqli->prepare( "UPDATE usuario  SET NOMBRE = ?, APELLIDO = ?, EDAD = ?,  GENERO = ?, CORREO= ?, CELULAR = ?, CONTRASENA = ? WHERE IDUSER= ?" );
        $sentencia->bind_param( "ssississ", $nombre, $apellido, $edad, $genero, $correo, $celular, $contrasena,$id );
        $sentencia->execute( );
    }
    }
?>