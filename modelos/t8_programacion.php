<?php

class t8_programacion extends conexionPDO
{
    protected $con;
    protected $PDO;


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }


    function get_data_table_prog()
    {
        $sql="SELECT * FROM `ct8_programacion`";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function get_vehiculo($id_vehiculo)
    {
        $id_vehiculo = intval($id_vehiculo);
        $sql = "SELECT `ct10_Placa` FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` = :id_vehiculo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_vehiculo', $id_vehiculo, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos = $fila['ct10_Placa'];
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_producto($id_producto)
    {
        $id_producto = intval($id_producto);
        $sql = "SELECT `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id_producto";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos = $fila['ct4_Descripcion'];
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_obra($id_obra)
    {
        $id_obra = intval($id_obra);
        $sql = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos = $fila['ct5_NombreObra'];
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function get_cliente($id_cliente)
    {
        $id_cliente = intval($id_cliente);
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos = $fila['ct1_RazonSocial'];
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    function tabla_detalle_prog($id_programacion)
    {
        $this->id_programacion = intval($id_programacion);
        #`ct9_IdDetalleProgramacion`, `ct9_FechaCreacion`, `ct9_estado`, `ct9_IdProgramacion`, `ct9_HoraCargue`, `ct9_HoraMixerObra`, `ct9_IdCliente`, `ct9_IdObra`, `ct9_IdProducto`, `ct9_Cantidad`, `ct9_TotalDespachado`, `ct9_IdBomba`, `ct9_IdVehiculo`, `ct9_idConductor`, `ct9_TipoObservacion`, `ct9_Observaciones`
        $sql = "SELECT * FROM `ct9_detalleprogramacion` WHERE `ct9_IdProgramacion` = :id_programacion";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_programacion', $this->id_programacion, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }


    function crear_porg($fecha_prog, $linea_despacho)
    {
        $fecha_create = new DateTime();
        $fecha_create->format('Y-m-d H:i:s');
        $this->fecha_create = $fecha_create->format('Y-m-d H:i:s');
        $this->estado = 1;
        $this->linea_despacho = $linea_despacho;
        #$fecha_prog = new DateTime($fecha_prog);
        #$fecha_prog->format('Y-m-d');
        $this->fecha_prog = $fecha_prog;

        $sql = "INSERT INTO `ct8_programacion`( `ct8_FechaCreacion`, `ct8_Estado`, `ct8_LineaDespacho`, `ct8_FechaProgramacion`) VALUES (:fecha_create,:estado,:lineadespacho,:fecha_prog)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':lineadespacho', $this->linea_despacho, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_prog', $this->fecha_prog, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                $id_insert = $this->con->lastInsertId();
                return intval($id_insert);
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }


    function detallevariableprog($hora_cargue,$hora_mixer,$id_vehiculo,$id_conductor, $observacion, $id_detalle_prog)
    {

        $this->hora_cargue =  $hora_cargue;
        $this->hora_mixer = $hora_mixer;
        $this->id_vehiculo = $id_vehiculo;
        $this->id_conductor = $id_conductor;
        $this->observacion = $observacion;
        $this->id_detalle_prog = intval($id_detalle_prog);

        $placa = self::get_vehiculo($id_vehiculo); //ct9_placa_mixer
        $nombre_conductor = self::get_cliente($id_conductor); //ct9_nombre_conductor


        $sql = "UPDATE `ct9_detalleprogramacion` SET `ct9_HoraCargue`=:hora_cargue,`ct9_HoraMixerObra`=:hora_mixer,`ct9_IdVehiculo`=:id_vehiculo,ct9_placa_mixer = :placa_mixer,`ct9_idConductor`=:id_conductor,ct9_nombre_conductor =:nombre_conductor,`ct9_Observaciones`=:observacion WHERE `ct9_IdDetalleProgramacion` = :id_detalle_prog";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':hora_cargue',$this->hora_cargue, PDO::PARAM_STR);
        $stmt->bindParam(':hora_mixer',$this->hora_mixer, PDO::PARAM_STR);
        $stmt->bindParam(':id_vehiculo',$this->id_vehiculo, PDO::PARAM_STR);
        $stmt->bindParam(':placa_mixer',$placa, PDO::PARAM_STR);
        $stmt->bindParam(':id_conductor',$this->id_conductor, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_conductor',$nombre_conductor, PDO::PARAM_STR);
        $stmt->bindParam(':observacion',$this->observacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_detalle_prog', $this->id_detalle_prog, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function crear_detalle_porg($id_programacion, $hora_cargue, $hora_mixer, $id_cliente, $id_obra, $producto, $cantidad, $total_despachado)
    {


        $fecha_create = new DateTime();
        $fecha_create = $fecha_create->format('Y-m-d H:i:s');
        $this->fecha_create =  strval($fecha_create);
        $this->estado = 1;
        $this->id_programacion = $id_programacion;
        $this->hora_cargue = $hora_cargue;
        $this->hora_mixer = $hora_mixer;
        $this->id_cliente = $id_cliente;
        $this->id_obra = $id_obra;
        $this->id_producto = $producto;
        $this->cantidad = doubleval($cantidad);
        $this->total_despachado = $total_despachado;
        $nombre_cliente = self::get_cliente($this->id_cliente);
        $nombre_obra = self::get_obra($this->id_obra);
        $nombre_producto = self::get_producto($this->id_producto);
        
    

        

        $sql = "INSERT INTO `ct9_detalleprogramacion`(`ct9_FechaCreacion`, `ct9_estado`, `ct9_IdProgramacion`, `ct9_HoraCargue`, `ct9_HoraMixerObra`, `ct9_IdCliente`,ct9_nombre_cliente ,`ct9_IdObra`,ct9_nombre_obra , `ct9_IdProducto`,ct9_nombre_producto, `ct9_Cantidad`, `ct9_TotalDespachado`) VALUES (:fecha_create,:estado,:id_programacion,:hora_cargue,:hora_mixer,:id_cliente,:nombre_cliente,:id_obra,:nombre_obra,:producto, :nombre_producto,:cantidad,:total_despachado)";
        $stmt = $this->con->prepare($sql);
        # ct9_nombre_obra , ct9_nombre_producto 
        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':id_programacion', $this->id_programacion, PDO::PARAM_STR);
        $stmt->bindParam(':hora_cargue', $this->hora_cargue, PDO::PARAM_STR);
        $stmt->bindParam(':hora_mixer', $this->hora_mixer, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':producto', $this->id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':total_despachado', $this->total_despachado, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                $id_insert = $this->con->lastInsertId();
                return intval($id_insert);
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function link_prog()
    {
        $sql = "SELECT `ct8_IdProgramacion` FROM `ct8_programacion` ORDER BY `ct8_programacion`.`ct8_IdProgramacion` DESC  LIMIT 1";
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $last_id = $fila['ct8_IdProgramacion'];
                }
                return $last_id + 1;
            } else {
                return 1;
            }
        } else {
            return false;
        }
    }

    function generar_link_prog($linea, $fecha_prog)
    {
        $this->fecha_creacion = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->linea = $linea;
        $this->fecha_prog = $fecha_prog;


        $sql = "INSERT INTO `ct8_programacion`( `ct8_FechaCreacion`, `ct8_Estado`, `ct8_LineaDespacho`, `ct8_FechaProgramacion`) VALUES (:fecha_creacion, :estado, :linea, :fecha_porg)";

        //prepare SQL
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':linea', $this->linea, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_porg', $this->fecha_prog, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $id_insert = $this->con->lastInsertId();
            return intval($id_insert);
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function generar_code_prog()
    {
        $sql = "SELECT `ct8_IdProgramacion` FROM ct8_programacion ORDER BY `ct8_IdProgramacion` DESC LIMIT 1";

        //prepare SQL
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_programacion =  intval($fila['ct8_IdProgramacion']);
                }
                return $id_programacion + 1;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
}
