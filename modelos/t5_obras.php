<?php
class t5_obras extends conexionPDO

{
    protected $con;
    private $id;
    private $estado;
    private $fecha_creacion;
    private $id_cliente;
    private $nombre_obra;
    private $direccion_obra;
    protected $PDO;
    public $id_obra;
    // Iniciar Conexion

    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function select_segmentacion($id = null)
    {
        $option = "<option  selected = 'true' value='NULL' disabled='true'> Seleccione... </option>";
        $sql = "SELECT * FROM `segmento`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id_segmento']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['id_segmento'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function data_table_obra_for_cliente($id_cliente)
    {
        $this->id_cliente = intval($id_cliente);
        $sql = "SELECT ct5_IdObras , ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos_obra['id_obra'] = $fila['ct5_IdObras'];
                    $datos_obra['nombre_obra'] =  $fila['ct5_NombreObra'];
                    $datos[] = $datos_obra;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function estado2_obra($id_obra)
    {
        $this->id_obra = (int)$id_obra;
        $sql = "SELECT `ct5_estado2` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $estado_obra2 =  $fila['ct5_estado2'];
                }
                return $estado_obra2;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function option_obras($id_cliente, $id_obra = null)
    {
        $this->id_obra = $id_obra;
        $this->id_cliente = intval($id_cliente);
        $selection = "";
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT ct5_IdObras , ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_obra == $fila['ct5_IdObras']) {
                        $selection = "selected='true'";
                    } else {
                        $selection  = "";
                    }
                    $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
                }
            } else {
                $option .= "<option  selected='true' disabled='disabled'> No hay Obras </option>";
            }
        } else {
            $option .= "<option  selected='true' disabled='disabled'> Error al cargar Obras </option>";
        }
        //resultado
        return $option;
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function sincro_obra_nombre($id_cliente, $nombre_obra)
    {
        $this->nombre_obra = $nombre_obra;
        $this->id_cliente = $id_cliente;
        $sql = "SELECT `ct5_IdObras` FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente AND `ct5_NombreObra` = :nombre_obra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_obra =  $fila['ct5_IdObras'];
                }
                return $id_obra;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function buscar_obra_nombre($nombre_obra)
    {
        $this->nombre_obra = $nombre_obra;
        $sql = "SELECT `ct5_IdObras` FROM `ct5_obras` WHERE `ct5_NombreObra` = :nombre_obra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_obra =  $fila['ct5_IdObras'];
                }
                return $id_obra;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function Select_Obra($id_cliente)
    {
        $this->id_cliente = $id_cliente;
        $error =  '<option value="0">Error al cargar Obras</option>';
        $datos = "";
        $rowsArray_obra = "";
        $sql = "SELECT `ct5_IdObras`, `ct5_EstadoObra`,`ct5_NombreObra` FROM `ct5_obras` WHERE ct5_obras.ct5_IdTerceros = :id_cliente AND `ct5_EstadoObra` = 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        // $stmt->bind_param("i", $id_cliente);
        if ($stmt->execute()) {
            $rowsArray_obra .= '<option value="0">Seleccionar Obras</option>';
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rowsArray_obra .= '<option  value="' . $fila['ct5_IdObras'] . '">' . $fila['ct5_NombreObra'] . '</option>';
            }
            return $rowsArray_obra;
        } else {
            return false;
        }
    }

    function option_obra_edit2($id_obra)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_obra == $fila['ct5_IdObras']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }

    function option_obra($id_cliente, $id_obra = null)
    {
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente  AND `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_obra == $fila['ct5_IdObras']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }

    function eliminar_obra($id)
    {
        $this->id = $id;
        $sql = "UPDATE `ct5_obras` SET `ct5_EstadoObra`= 2 WHERE  `ct5_IdObras` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $result;
    }

    function option_obra_edit($id_cliente, $id_obra)
    {
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente AND `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_obra == $fila['ct5_IdObras']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }

    function select_obras_id_for_table($id_obra)
    {
        $this->id = $id_obra;
        $sql = "SELECT ct5_NombreObra, ct5_IdTerceros FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra  AND `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
    }

    function select_obras_id($id_obra)
    {
        $this->id = $id_obra;
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra  AND `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $stmt;
    }

    function select_obras()
    {
        $sql = "SELECT * FROM ct5_obras WHERE `ct5_EstadoObra` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $stmt;
    }

    function insertar_obra($id_cliente, $nombre_obra, $direccion_obra = null, $fecha_creacion = null)
    {
        $this->estado = 1;
        $this->fecha_creacion = $fecha_creacion;
        $this->id_cliente = $id_cliente;
        $this->nombre_obra = $nombre_obra;
        $this->direccion_obra = $direccion_obra;
        $sql = "INSERT INTO `ct5_obras`(`ct5_EstadoObra`, `ct5_FechaCreacion`, `ct5_IdTerceros`, `ct5_NombreObra`, `ct5_DireccionObra`) VALUES (:estado, :fecha_creacion, :id_cliente, :nombre_obra, :direccion_obra)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $this->direccion_obra, PDO::PARAM_STR);
        $result = $stmt->execute();
        return $result;
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function editar_obra($id_obra, $id_cliente, $nombre_obra, $id_departamento, $nombre_departamento, $id_ciudad, $nombre_ciudad, $id_comuna, $nombre_comuna, $barrio, $segmento, $direccion_obra)
    {
        $this->id_cliente = $id_cliente;
        $this->nombre_obra = $nombre_obra;
        $this->direccion_obra = $direccion_obra;
        $this->id = $id_obra;
        $this->segmento = $segmento;
        $this->departamento = $id_departamento;
        $this->nombre_departamento = $nombre_departamento;
        $this->ciudad = $id_ciudad;
        $this->nombre_municipio = $nombre_ciudad;
        $this->comuna = $id_comuna;
        $this->nombre_comuna = $nombre_comuna;
        $this->barrio = $barrio;
        $sql = "UPDATE `ct5_obras` SET `ct5_IdTerceros` = :id_cliente, `ct5_NombreObra` = :nombre_obra, `ct5_segmento` = :segmento, `ct5_DireccionObra` = :direccion_obra,`ct5_id_departamento` = :departamento, `ct5_nombre_departamento` = :nombre_departamento, `ct5_id_ciudad` = :ciudad, `ct5_nombre_ciudad` = :nombre_municipio, `ct5_id_comuna` = :comuna,`ct5_nombre_comuna` = :nombre_comuna,`ct5_barrio` = :barrio WHERE `ct5_IdObras` =  :id_obra";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_obra',  $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente',  $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $this->direccion_obra, PDO::PARAM_STR);
        $stmt->bindParam(':segmento', $this->segmento, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $this->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_departamento', $this->nombre_departamento, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $this->ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_municipio', $this->nombre_municipio, PDO::PARAM_STR);
        $stmt->bindParam(':comuna', $this->comuna, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_comuna', $this->nombre_comuna, PDO::PARAM_STR);
        $stmt->bindParam(':barrio', $this->barrio, PDO::PARAM_STR);


        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    public function informe_excel($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT segmento.id_segmento, segmento.descripcion, SUM(ct26_remisiones.ct26_metros) as metros FROM `ct26_remisiones` INNER JOIN ct5_obras ON ct26_idObra = ct5_obras.ct5_IdObras INNER JOIN segmento ON ct5_obras.ct5_segmento = segmento.id_segmento WHERE ct26_fecha_remi BETWEEN :fecha_ini AND :fecha_fin AND (ct26_remisiones.ct26_estado != 5 AND ct26_remisiones.ct26_estado != 10) GROUP by segmento.descripcion ORDER BY segmento.id_segmento ASC";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['descripcion'] = $fila['descripcion'];
                    $data_array['metros'] = $fila['metros'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
}
