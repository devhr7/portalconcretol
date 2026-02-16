<?php
   
    require_once ("../controlador/ControladorRequisiciones1.php");
    require_once("../conexionBD/Conexion.php");
    require_once("../modelo/Requisicion.php");
    require_once("../modelo/Cotizacion.php");
    require_once("../modelo/Proveedor.php");

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
        $sql=$this->mysqli->query("SELECT * FROM requisicion");
        return $sql;
        }
    public function  listarProveedores(){
        $sql=$this->mysqli->query("SELECT * FROM proveedor");
        return $sql;
        }
        public function insertarRequisicion (Requisicion $requisicion)
        {
            $idRequisicion= $requisicion->getIdRequisicion();
            $fecha= $requisicion->getFecha();
            $cantidad= $requisicion->getCantidad();
            $unidadMedida= $requisicion->getUnidadMedida();
            $item= $requisicion->getItem();
            $status= $requisicion->getStatus();
            $observacion= $requisicion->getObservacion();
            $imagen = $requisicion->getImagen();
            $rolUser = $requisicion->getRolUser();
            $lugar = $requisicion->getLugar();
            $prioridad = $requisicion->getPrioridad();

            $sentencia = $this->mysqli->prepare( "INSERT INTO requisicion (FECHA,CANTIDAD,UNIDADDEMEDIDA,ITEM,OBSERVACION,ROLUSER,IMAGEN,LUGAR,PRIORIDAD) 
            VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
            $sentencia->bind_param( "sisssssss", $fecha,$cantidad,$unidadMedida,$item,$observacion,$rolUser,$imagen,$lugar,$prioridad);
            $sentencia->execute( );
        }
        public function  listarRequisicion($id){
            $sql = $this->mysqli->query("SELECT * FROM requisicion WHERE IDREQUISICION='$id'");
            return $sql;
            }
        public function listarRequiCoti(){
                $estado = "EN COTIZACION";
                $sql=$this->mysqli->query("SELECT * FROM requisicion WHERE ESTADOREQUI = '$estado' AND ESTADO = 1");
                return $sql;
            }
    public function actualizarRequisicion($id ,Requisicion $requisicion )
        {
            
            $idRequisicion= $requisicion->getIdRequisicion();
            $fecha= $requisicion->getFecha();
            $cantidad= $requisicion->getCantidad();
            $unidadMedida= $requisicion->getUnidadMedida();
            $item= $requisicion->getItem();
            $status= $requisicion->getStatus();
            $observacion= $requisicion->getObservacion();
            $imagen = $requisicion->getImagen();
            $rolUser = $requisicion->getRolUser();
            $lugar = $requisicion->getLugar();
            $prioridad = $requisicion->getPrioridad();
            /*UPDATE `requisicion` SET `CANTIDAD` = '3', `UNIDADDEMEDIDA` = 'KILOMETRO', `ITEM` = 'TORNILLO DE PUNTA', `OBSERVACION` = 'TORNILLO PARA LA MIXER SNO 052',
             `ROLUSER` = '1', `LUGAR` = 'MIRLINDO' WHERE `requisicion`.`IDREQUISICION` = 1;*/
            $sentencia = $this->mysqli->prepare( "UPDATE requisicion SET CANTIDAD = ?, UNIDADDEMEDIDA= ?, ITEM = ?, OBSERVACION = ?, ROLUSER = ?, LUGAR = ? ,IMAGEN = ?, PRIORIDAD = ? WHERE IDREQUISICION = ? ");
            $sentencia->bind_param( "isssisssi", $cantidad, $unidadMedida,$item,$observacion,$rolUser,$lugar,$imagen,$prioridad,$id);
            $sentencia->execute( );
        }
        public function actualizarEstado($id ,Requisicion $requisicion, $estado )
        {
            
            $idRequisicion= $requisicion->getIdRequisicion();
            $fecha= $requisicion->getFecha();
            $cantidad= $requisicion->getCantidad();
            $unidadMedida= $requisicion->getUnidadMedida();
            $item= $requisicion->getItem();
            $status= $requisicion->getStatus();
            $observacion= $requisicion->getObservacion();
            $imagen = $requisicion->getImagen();
            $rolUser = $requisicion->getRolUser();
            $lugar = $requisicion->getLugar();
            $prioridad = $requisicion->getPrioridad();
            /*UPDATE `requisicion` SET `CANTIDAD` = '3', `UNIDADDEMEDIDA` = 'KILOMETRO', `ITEM` = 'TORNILLO DE PUNTA', `OBSERVACION` = 'TORNILLO PARA LA MIXER SNO 052',
             `ROLUSER` = '1', `LUGAR` = 'MIRLINDO' WHERE `requisicion`.`IDREQUISICION` = 1;*/
            $sentencia = $this->mysqli->prepare( "UPDATE requisicion SET CANTIDAD = ?, UNIDADDEMEDIDA= ?, ITEM = ?, OBSERVACION = ?, ROLUSER = ?, LUGAR = ?, ESTADOREQUI = ?, PRIORIDAD = ? WHERE IDREQUISICION = ? ");
            $sentencia->bind_param( "isssssssi", $cantidad, $unidadMedida,$item,$observacion,$rolUser,$lugar,$estado,$prioridad,$id);
            $sentencia->execute( );
        }
        public function eliminarRequisicion( $id)
        {
            $eliminar = 0;
            $sentencia = $this->mysqli->prepare( "UPDATE requisicion SET ESTADO = ? WHERE IDREQUISICION = ? ");
            $sentencia->bind_param( "ii",$eliminar,$id );
            $sentencia->execute( );
        }
        public function insertarCotizacion ($idprove,Cotizacion $cotizacion)
        {
            $fecha = $cotizacion->getFecha();
            $archivo = $cotizacion->getArchivo();
            $precio = $cotizacion->getPrecio();

            $sentencia = $this->mysqli->prepare( "INSERT INTO cotizacion (ARCHIVO,PRECIO,FECHA,IDPROVEEDOR) 
                VALUES( ?, ?, ? ,?)") ;
            $sentencia->bind_param( "sisi", $archivo,$precio,$fecha,$idprove);
            $sentencia->execute( );
        }
        public function  seleccionarultimodatoCoti(){
            $sql = $this->mysqli->query("SELECT MAX(IDCOTIZACION) AS IDCOTIZACION  FROM cotizacion");
            return $sql;
            } 
        public function  insertarCotiHasRequi($idR, $idC){
            $sql = $this->mysqli->query("INSERT INTO cotizacionhasrequisicion SET IDCOTIZACION = '$idC', IDREQUISICION ='$idR'");
            return $sql;
            }
        public function insertarPrecioRequi ($precio,$id)
        {
            $sentencia = $this->mysqli->prepare( "UPDATE requisicion SET PRECIO = ? WHERE IDREQUISICION = ? ");
            $sentencia->bind_param( "ii",$precio,$id );
            $sentencia->execute( );
        }
        public function  seleccionarCoti($id){
            /*
            SELECT `cotizacion`.`FECHA`,`cotizacion`.`ARCHIVO`,`cotizacion`.`PRECIO` FROM `cotizacion`,`requisicion`,`cotizacionhasrequisicion` WHERE`requisicion`.`IDREQUISICION`= `cotizacionhasrequisicion`.`IDREQUISICION` AND `requisicion`.`IDREQUISICION` = 
            */
            /*
            SELECT `cotizacion`.`FECHA`,`cotizacion`.`ARCHIVO`,`cotizacion`.`PRECIO` FROM `cotizacion`,`requisicion`,`cotizacionhasrequisicion` WHERE `cotizacion`.`IDCOTIZACION`= `cotizacionhasrequisicion`.`IDCOTIZACION`AND`requisicion`.`IDREQUISICION`= `cotizacionhasrequisicion`.`IDREQUISICION` AND `requisicion`.`IDREQUISICION` = 2;
            */
            $sql = $this->mysqli->query("SELECT `cotizacionhasrequisicion`.`IDCHR`, `cotizacionhasrequisicion`.`SELECCION`,`cotizacion`.`FECHA`,`proveedor`.`RAZONSOCIAL`,`cotizacion`.`ARCHIVO`,`cotizacion`.`PRECIO` FROM `cotizacionhasrequisicion`,`requisicion`,`cotizacion`,`proveedor` WHERE `cotizacion`.`IDCOTIZACION`=`cotizacionhasrequisicion`.`IDCOTIZACION` AND `proveedor`.`IDPROVE` = `cotizacion`.`IDPROVEEDOR` AND `requisicion`.`IDREQUISICION` =`cotizacionhasrequisicion`.`IDREQUISICION` AND `requisicion`.`IDREQUISICION` = '$id'");
            return $sql;
            } 
        public function  seleccionaProveedor(){
                $sql = $this->mysqli->query("SELECT *  FROM proveedor");
                return $sql;
            } 

            public function insertarProveedor(Proveedor $proveedor )
            {
                $id=$proveedor->getId();
                $razonSocial=$proveedor->getRazonSocial();
                $ubicacion=$proveedor->getUbicacion();
                /*UPDATE `requisicion` SET `CANTIDAD` = '3', `UNIDADDEMEDIDA` = 'KILOMETRO', `ITEM` = 'TORNILLO DE PUNTA', `OBSERVACION` = 'TORNILLO PARA LA MIXER SNO 052',
                 `ROLUSER` = '1', `LUGAR` = 'MIRLINDO' WHERE `requisicion`.`IDREQUISICION` = 1;*/
                $sentencia = $this->mysqli->prepare("INSERT INTO proveedor(NIT,RAZONSOCIAL,UBICACION) VALUES (?, ?, ?)");
                $sentencia->bind_param( "iss", $id,$razonSocial,$ubicacion);
                $sentencia->execute( );
            }
            public function checkCotizacion ($seleccion,$id)
            {
                $sentencia = $this->mysqli->prepare( "UPDATE cotizacionhasrequisicion SET SELECCION = ? WHERE IDCHR = ? ");
                $sentencia->bind_param( "ii",$seleccion,$id );
                $sentencia->execute( );
            }
            public function  seleccionaCHR($id){
                $sql = $this->mysqli->query("SELECT *  FROM cotizacionhasrequisicion WHERE IDCHR= '$id'");
                return $sql;
            } 
    }
?>