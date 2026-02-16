<?php

class novedades_despacho extends conexionPDO
{
    protected $con;
    protected $PDO;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    //
    function select_novedades_cli_obra($id_novedad, $id_cliente, $id_obra)
    {
        $sql = "SELECT novedades_por_remision.id, novedades_por_remision.id_novedad,novedades_por_remision.id_remision, novedades_por_remision.cod_remision,  novedades_por_remision.id_tipo_novedad,novedades_por_remision.tipo_novedad, novedades_por_remision.area_afectada, novedades_por_remision.novedad,novedades_por_remision.observacion FROM `novedades_por_remision` INNER JOIN ct26_remisiones ON novedades_por_remision.id_remision = ct26_remisiones.ct26_id_remision WHERE novedades_por_remision.id_novedad  = :id_novedad AND ct26_remisiones.ct26_idcliente = :id_cliente AND ct26_remisiones.ct26_idObra = :id_obra ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_remision'] = $fila['id_remision'];
                    $datos['cod_remision'] = $fila['cod_remision'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['observacion'] = $fila['observacion'];

                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //
    function select_novedad_remisiones($id_remisiones)
    {
        $sql = "SELECT `id`, `id_novedad`, `id_remision`, `cod_remision`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion` FROM `novedades_por_remision` WHERE `id_remision` = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_remisiones, PDO::PARAM_STR);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_tipo_novedad'] = $fila['id_tipo_novedad'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['id_area_afectada'] = $fila['id_area_afectada'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['id_listado_novedad'] = $fila['id_listado_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['observacion'] = $fila['observacion'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //
    function insert_novedad_remisiones($id_novedad, $id_remision, $cod_remision, $id_tipo_novedad, $tipo_novedad, $id_area_afectada, $area_afectada, $id_listado_novedad, $novedad, $observacion)
    {
        $this->id_novedad = $id_novedad;
        $this->id_remision = $id_remision;
        $this->cod_remision = $cod_remision;
        $this->id_tipo_novedad = $id_tipo_novedad;
        $this->tipo_novedad = $tipo_novedad;
        $this->id_area_afectada = $id_area_afectada;
        $this->area_afectada = $area_afectada;
        $this->id_listado_novedad = $id_listado_novedad;
        $this->novedad = $novedad;
        $this->observacion = $observacion;
        $sql = "INSERT INTO `novedades_por_remision`( `id_novedad`, `id_remision`, `cod_remision`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion`) VALUES (:id_novedad,:id_remision,:cod_remision,:id_tipo_novedad,:tipo_novedad,:id_area_afectada,:area_afectada, :id_listado_novedad, :novedad, :observacion )  ";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        $stmt->bindParam(':cod_remision', $this->cod_remision, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_novedad', $this->id_tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_novedad', $this->tipo_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_area_afectada', $this->id_area_afectada, PDO::PARAM_INT);
        $stmt->bindParam(':area_afectada', $this->area_afectada, PDO::PARAM_STR);
        $stmt->bindParam(':id_listado_novedad', $this->id_listado_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':novedad', $this->novedad, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $this->observacion, PDO::PARAM_STR);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //
    function select_novedad_generales($id_novedad)
    {
        $sql = "SELECT `id`, `id_novedad`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion` FROM `novedades_generales` WHERE `id_novedad` = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_novedad, PDO::PARAM_STR);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_tipo_novedad'] = $fila['id_tipo_novedad'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['id_area_afectada'] = $fila['id_area_afectada'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['id_listado_novedad'] = $fila['id_listado_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['observacion'] = $fila['observacion'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Guardar las novedades generales
    public function guardar_novedades_generales($id_novedad, $id_tipo_novedad, $tipo_novedad, $id_area_afectada, $area_afectada, $id_listado_novedad, $novedad, $observacion)
    {
        $this->id_novedad = $id_novedad;
        $this->id_tipo_novedad = $id_tipo_novedad;
        $this->tipo_novedad = $tipo_novedad;
        $this->id_area_afectada = $id_area_afectada;
        $this->area_afectada = $area_afectada;
        $this->id_listado_novedad = $id_listado_novedad;
        $this->novedad = $novedad;
        $this->observacion = $observacion;


        $sql = "INSERT INTO `novedades_generales`( `id_novedad`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion`) VALUES (:id_novedad,:id_tipo_novedad,:tipo_novedad,:id_area_afectada,:area_afectada, :id_listado_novedad, :novedad, :observacion )";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_novedad', $this->id_tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_novedad', $this->tipo_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_area_afectada', $this->id_area_afectada, PDO::PARAM_INT);
        $stmt->bindParam(':area_afectada', $this->area_afectada, PDO::PARAM_STR);
        $stmt->bindParam(':id_listado_novedad', $this->id_listado_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':novedad', $this->novedad, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $this->observacion, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //Obtener el listado de las novedades mediante el id
    public function get_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `listado_novedades`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Obtener el nombre del area de las novedades mediante el id.
    public function get_area_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `areas_afectadas_novedades`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Obtener el codigo de la remision mediante el id.
    public function get_cod_remision($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct26_codigo_remi` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct26_codigo_remi'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Obtener el tipo de novedad mediante el id.
    public function get_tipo_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_novedad`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //
    function option_novedades($tipo_novedad, $subtipo_novedad, $id_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `listado_novedades` WHERE id_tipo_novedad = :id_tipo_novedad AND id_subtipo_novedad  = :id_subtipo_novedad ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tipo_novedad', $tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_subtipo_novedad', $subtipo_novedad, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    //
    function option_tipo_novedades($id_tipo_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `tipo_novedad`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_tipo_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    //
    function option_areas_novedades($id_tipo_novedad, $id_subtipo_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `areas_afectadas_novedades` WHERE id_tipo_novedad = :id_tipo_novedad";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tipo_novedad', $id_tipo_novedad, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_subtipo_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    //Obtener el nombre del cliente mediante el id
    public function get_nombre_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct1_IdTerceros`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Obtener el nombre de la obra mediante el id
    public function get_nombre_obra($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct5_IdObras`, `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct5_NombreObra'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //
    function insertar_novedad_despacho($fecha)
    {
        $this->fecha = $fecha;
        $sql = "INSERT INTO `novedades_despacho`(`fecha_novedad`) VALUES (:fecha_novedad)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_novedad', $this->fecha, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return $id_insert = $this->con->lastInsertId();
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //
    function select_novedad_despacho_for_id($id)
    {
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho` WHERE id = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //
    function select_novedad_despacho_index()
    {
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho`  ";
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //
    function select_novedad_despacho($fecha)
    {
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho` WHERE fecha_novedad = :fecha_novedad  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_novedad', $fecha, PDO::PARAM_STR);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //
    function insert_datos_cliente($id_novedad, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra)
    {
        $this->id_novedad = $id_novedad;
        $this->id_cliente = $id_cliente;
        $this->nombre_cliente = $nombre_cliente;
        $this->id_obra = $id_obra;
        $this->nombre_obra = $nombre_obra;
        $sql = "INSERT INTO `novedades_has_clientes`(`id_novedad`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`) VALUES (:id_novedad, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $this->nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    //
    function select_datos_cliente($id_novedad)
    {
        $this->id_novedad = $id_novedad;
        $sql = "SELECT `id`, `id_novedad`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra` FROM `novedades_has_clientes` WHERE id_novedad = :id_novedad";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['cant_novedades'] = SELF::contar_novedades_despacho_for_cli_obra($this->con, $id_novedad, $fila['id_cliente'], $fila['id_obra']);
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_cliente'] = $fila['id_cliente'];
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
                    $datos['id_obra'] = $fila['id_obra'];
                    $datos['nombre_obra'] = $fila['nombre_obra'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Eliminar las novedades de las remisiones.
    function delete_novedades_remi($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `novedades_por_remision` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Elimina las novedades generales mediante el id.
    function delete_novedades_generales($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `novedades_generales` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //Elimina las novedades en los clientes.
    function delete_datos_clientes($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `novedades_has_clientes` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    //
    public static function contar_novedades_despacho_for_cli_obra($con, $id_novedad, $id_cliente, $id_obra)
    {
        $sql = "SELECT  count(novedades_por_remision.id) as cantidad_novedades FROM `novedades_por_remision` INNER JOIN ct26_remisiones ON novedades_por_remision.id_remision = ct26_remisiones.ct26_id_remision WHERE novedades_por_remision.id_novedad  = :id_novedad AND ct26_remisiones.ct26_idcliente = :id_cliente AND ct26_remisiones.ct26_idObra = :id_obra ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_novedad', $id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    return $fila['cantidad_novedades'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    //
    public static function contar_novedades_despacho_for_remi($con, $id_remision)
    {
        $sql = "SELECT COUNT(id) as numero_novedades FROM `novedades_por_remision` WHERE id_remision = :id_remision ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['numero_novedades'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    function select_datos_remisiones($fecha_remi, $id_clientes, $id_obras)
    {
        $sql = "SELECT ct26_id_remision, `ct26_codigo_remi`, `ct26_razon_social`, `ct26_nombre_obra`,  `ct26_vehiculo`, `ct26_hora_remi` ,ct26_codigo_producto, ct26_descripcion_producto FROM `ct26_remisiones`  WHERE  `ct26_fecha_remi` = :fecha_remi AND `ct26_idcliente` IN ($id_clientes)  AND `ct26_idObra` IN ($id_obras) ORDER BY `ct26_id_remision` DESC ";


        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_remi', $fecha_remi, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct26_id_remision'];
                    $datos['num_novedades'] = SELF::contar_novedades_despacho_for_remi($this->con, $fila['ct26_id_remision']);
                    $datos['ckeck'] = "<input type='checkbox' value='" . $fila['ct26_id_remision'] . "' name='check_id_remi[]'  >";
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['razon_social'] = $fila['ct26_razon_social'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['vehiculo'] = $fila['ct26_vehiculo'];
                    $datos['hora_remi'] = $fila['ct26_hora_remi'];
                    $datos['cod_producto'] = $fila['ct26_codigo_producto'];
                    $datos['nombre_producto'] = $fila['ct26_descripcion_producto'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Informe de novedades por remision
    public function informe_novedades_remisiones_excel($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT novedades_por_remision.id_novedad, ct26_remisiones.ct26_fecha_remi, ct26_remisiones.ct26_codigo_remi, novedades_por_remision.tipo_novedad, novedades_por_remision.area_afectada, novedades_por_remision.novedad, novedades_por_remision.observacion, ct26_remisiones.ct26_estado, ct26_remisiones.ct26_fisica, ct26_remisiones.ct26_idplanta, ct26_remisiones.ct26_nitcliente, ct26_remisiones.ct26_razon_social, ct26_remisiones.ct26_nombre_obra, ct26_remisiones.ct26_vehiculo, ct26_remisiones.ct26_identificacion_conductor, ct26_remisiones.ct26_nombre_conductor, ct26_remisiones.ct26_sello, ct26_remisiones.ct26_codigo_producto, ct26_remisiones.ct26_descripcion_producto, ct26_remisiones.ct26_metros, ct26_remisiones.ct26_asentamiento, ct26_remisiones.ct26_hora_remi, ct26_remisiones.ct26_hora_salida_planta, ct26_remisiones.ct26_hora_llegada_obra, ct26_remisiones.ct26_hora_inicio_descargue, ct26_remisiones.ct26_hora_terminada_descargue, ct26_remisiones.ct26_hora_llegada_planta, ct26_remisiones.ct26_despachador, ct26_remisiones.ct26_recibido, ct26_remisiones.ct26_fechaRecibido, ct26_remisiones.ct26_bomba, ct26_remisiones.ct26_op_bomba, ct26_remisiones.ct26_aux_bomba, ct26_remisiones.ct26_observaciones 

        FROM `novedades_por_remision` 
        INNER JOIN `ct26_remisiones` ON novedades_por_remision.id_remision = ct26_remisiones.ct26_id_remision WHERE ct26_remisiones.ct26_fecha_remi BETWEEN :fecha_ini AND :fecha_fin ORDER BY ct26_remisiones.ct26_fecha_remi DESC";

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
                    $data_array['id_novedad'] = $fila['id_novedad'];
                    $data_array['ct26_fecha_remi'] = $fila['ct26_fecha_remi'];
                    $data_array['ct26_codigo_remi'] = $fila['ct26_codigo_remi'];
                    $data_array['tipo_novedad'] = $fila['tipo_novedad'];
                    $data_array['area_afectada'] = $fila['area_afectada'];
                    $data_array['novedad'] = $fila['novedad'];
                    $data_array['observacion'] = $fila['observacion'];
                    $data_array['ct26_estado'] = $fila['ct26_estado'];
                    $data_array['ct26_fisica'] = $fila['ct26_fisica'];
                    $data_array['ct26_idplanta'] = $fila['ct26_idplanta'];
                    $data_array['ct26_nitcliente'] = $fila['ct26_nitcliente'];
                    $data_array['ct26_razon_social'] = $fila['ct26_razon_social'];
                    $data_array['ct26_nombre_obra'] = $fila['ct26_nombre_obra'];
                    $data_array['ct26_vehiculo'] = $fila['ct26_vehiculo'];
                    $data_array['ct26_identificacion_conductor'] = $fila['ct26_identificacion_conductor'];
                    $data_array['ct26_nombre_conductor'] = $fila['ct26_nombre_conductor'];
                    $data_array['ct26_sello'] = $fila['ct26_sello'];
                    $data_array['ct26_codigo_producto'] = $fila['ct26_codigo_producto'];
                    $data_array['ct26_descripcion_producto'] = $fila['ct26_descripcion_producto'];
                    $data_array['ct26_metros'] = $fila['ct26_metros'];
                    $data_array['ct26_asentamiento'] = $fila['ct26_asentamiento'];
                    $data_array['ct26_hora_remi'] = $fila['ct26_hora_remi'];
                    $data_array['ct26_hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
                    $data_array['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
                    $data_array['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
                    $data_array['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
                    $data_array['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
                    $data_array['ct26_despachador'] = $fila['ct26_despachador'];
                    $data_array['ct26_recibido'] = $fila['ct26_recibido'];
                    $data_array['ct26_fechaRecibido'] = $fila['ct26_fechaRecibido'];
                    $data_array['ct26_bomba'] = $fila['ct26_bomba'];
                    $data_array['ct26_op_bomba'] = $fila['ct26_op_bomba'];
                    $data_array['ct26_aux_bomba'] = $fila['ct26_aux_bomba'];
                    $data_array['ct26_observaciones'] = $fila['ct26_observaciones'];
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
    // Informe de novedades generales
    public function informe_novedades_generales_excel($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT novedades_generales.id_novedad, novedades_despacho.fecha_novedad, novedades_generales.tipo_novedad, novedades_generales.area_afectada, novedades_generales.novedad, novedades_generales.observacion,  novedades_has_clientes.nombre_cliente, novedades_has_clientes.nombre_obra

        FROM `novedades_generales` 
        INNER JOIN `novedades_despacho` ON novedades_generales.id_novedad = novedades_despacho.id
        INNER JOIN `novedades_has_clientes` ON novedades_generales.id_novedad = novedades_has_clientes.id_novedad
        WHERE novedades_despacho.fecha_novedad BETWEEN :fecha_ini AND :fecha_fin ORDER BY novedades_despacho.id DESC";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id_novedad'] = $fila['id_novedad'];
                    $data_array['fecha_novedad'] = $fila['fecha_novedad'];
                    $data_array['tipo_novedad'] = $fila['tipo_novedad'];
                    $data_array['area_afectada'] = $fila['area_afectada'];
                    $data_array['novedad'] = $fila['novedad'];
                    $data_array['observacion'] = $fila['observacion'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
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
