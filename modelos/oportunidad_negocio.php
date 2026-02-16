<?php
class oportunidad_negocio extends conexionPDO
{
    protected $con;
    protected $PDO;
    /**
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'LEIDY ACERO' WHERE `ct1_IdTerceros` = 728;
     * 
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'ANGIE MONDRAGON' WHERE `ct1_IdTerceros` = 543;
     * 
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'CLAUDIA RODRIGUEZ' WHERE `ct1_IdTerceros` = 1133;
     * 
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'PAULA GOMEZ' WHERE `ct1_IdTerceros` = 508;
     * 
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'YURY POVEDA' WHERE `ct1_IdTerceros` = 779;
     * 
     * UPDATE `ct1_terceros` SET `ct1_RazonSocial` = 'SIRLEY ACEVEDO' WHERE `ct1_IdTerceros` = 510;
     */

    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }



    public function delete_oportunidad($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct63_oportuniodad_negocio` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function traer_id_plan($plan_maestro)
    {
        $this->plan_maestro = $plan_maestro;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_plan_maestro` WHERE `descripcion` = :descripcion";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':descripcion', $this->plan_maestro, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['id'];
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

    public static function traer_plan($con, $id)
    {
        $sql = "SELECT `id`, `descripcion` FROM `tipo_plan_maestro` WHERE `id` = :id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = SELF::traer_id_plan($fila['descripcion']);
                    $data_array['descripcion'] = $fila['descripcion'];
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

    public function datatable_oportunidad_negocio($cod, $cliente)
    {
        $sql = "SELECT `id`, `fecha_contacto`, `nidentificacion`, `razon_social`, `resultado` FROM `ct63_oportuniodad_negocio` WHERE `id` LIKE '%$cod%' AND `razon_social` LIKE '%$cliente%'";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $new_row['id'] = $row['id'];
                    $new_row['fecha_contacto'] = $row['fecha_contacto'];
                    $new_row['nidentificacion'] = $row['nidentificacion'];
                    $new_row['razon_social'] = $row['razon_social'];
                    $new_row['resultado'] = $row['resultado'];
                    $datos[] = $new_row;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Obtener el tipo de plan maestro
    public function get_nombre_tipo_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT descripcion FROM `tipo_plan_maestro` WHERE `id` = :id";
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
                return "NO APLICA";
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    //Obtener el nombre del tipo del cliente
    public function get_nombre_tipo_del_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `tipo_cliente` WHERE `id_tipo_cliente` = :id";
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
                return "NO APLICA";
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public static function nombre_tercero($con, $id)
    {
        $sql = "SELECT ct1_RazonSocial FROM ct1_terceros WHERE ct1_IdTerceros = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function nombre_tipo_cliente($con, $id)
    {
        $sql = "SELECT TipoCliente FROM ct14_tipocliente where ct14_IdTipoCliente  = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['TipoCliente'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function nombre_departamento($con, $id)
    {
        $sql = "SELECT departamento FROM departamentos where id_departamento = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['departamento'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }


    public static function nombre_municipio($con, $id)
    {
        $sql = "SELECT municipio FROM municipios where id_municipio = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['municipio'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function nombre_comuna($con, $id)
    {
        $sql = "SELECT nombre_comuna FROM comunas where id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['TipoCliente'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function nombre_resultado($con, $id)
    {
        $sql = "SELECT descripcion FROM status_op WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public static function nombre_contacto_cliente($con, $id)
    {
        $sql = "SELECT descripcion FROM contacto_cliente WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

    public function informe_excel($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT * FROM ct63_oportuniodad_negocio WHERE fecha_contacto BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha_contacto` DESC;";
        //$sql = "SELECT ct63_oportuniodad_negocio.id, ct1_terceros.ct1_RazonSocial as asesora_comercial, `fecha_contacto`,ct63_oportuniodad_negocio.nombre_sede, ct14_tipocliente.TipoCliente as tipo_cliente, `tipo_plan_maestro`, departamentos.departamento, municipios.municipio, comunas.nombre_comuna , `barrio`, `nidentificacion`, `razon_social`, `nombrescompletos`, `apellidoscompletos`, `nombre_obra`, `direccion_obra`, `telefono_cliente`, `nombre_maestro`, `celular_maestro`, `m3_potenciales`, `fecha_posible_fundida`,status_op.descripcion as resultado , contacto_cliente.descripcion as contacto, `observacion` FROM `ct63_oportuniodad_negocio` INNER JOIN ct1_terceros ON ct63_oportuniodad_negocio.asesora_comercial = ct1_terceros.ct1_IdTerceros INNER JOIN ct14_tipocliente ON ct63_oportuniodad_negocio.tipo_cliente = ct14_tipocliente.ct14_IdTipoCliente INNER JOIN departamentos ON ct63_oportuniodad_negocio.departamento = departamentos.id_departamento INNER JOIN municipios ON ct63_oportuniodad_negocio.municipio = municipios.id_municipio INNER JOIN comunas ON ct63_oportuniodad_negocio.comuna = comunas.id INNER JOIN status_op ON ct63_oportuniodad_negocio.estado = status_op.id INNER JOIN contacto_cliente ON ct63_oportuniodad_negocio.contacto_cliente = contacto_cliente.id WHERE fecha_contacto BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha_contacto` DESC;";

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
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha_contacto'] = $fila['fecha_contacto'];
                    $data_array['asesora_comercial'] = SELF::nombre_tercero($this->con, $fila['asesora_comercial']);
                    //$data_array['asesora_comercial'] = $fila['asesora_comercial'];
                    $data_array['nombre_sede'] = $fila['nombre_sede'];
                    $data_array['tipo_cliente'] = SELF::nombre_tipo_cliente($this->con, $fila['tipo_cliente']);
                    $data_array['tipo_plan_maestro'] = SELF::get_nombre_tipo_cliente($fila['tipo_plan_maestro']);
                    $data_array['departamento'] = SELF::nombre_departamento($this->con, $fila['departamento']);
                    $data_array['municipio'] = SELF::nombre_municipio($this->con, $fila['municipio']);
                    $data_array['nombre_comuna'] = SELF::nombre_comuna($this->con, $fila['nombre_comuna']);
                    $data_array['barrio'] = $fila['barrio'];
                    $data_array['nidentificacion'] = $fila['nidentificacion'];
                    $data_array['razon_social'] = $fila['razon_social'];
                    $data_array['nombrescompletos'] = $fila['nombrescompletos'];
                    $data_array['apellidoscompletos'] = $fila['apellidoscompletos'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['direccion_obra'] = $fila['direccion_obra'];
                    $data_array['telefono_cliente'] = $fila['telefono_cliente'];
                    $data_array['nombre_maestro'] = $fila['nombre_maestro'];
                    $data_array['celular_maestro'] = $fila['celular_maestro'];
                    $data_array['m3_potenciales'] = $fila['m3_potenciales'];
                    $data_array['fecha_posible_fundida'] = $fila['fecha_posible_fundida'];
                    $data_array['resultado'] = SELF::nombre_resultado($this->con, $fila['estado']);
                    $data_array['contacto_cliente'] = SELF::nombre_contacto_cliente($this->con, $fila['contacto_cliente']);
                    $data_array['observacion'] = $fila['observacion'];
                    $data_array['cantidad'] = SELF::get_cantidad_visitas($fila['id']);
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

    public function get_nombre_asesora($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` =  :id";
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

    public function get_cantidad_visitas($id)
    {
        $this->id = $id;
        $sql = "SELECT COUNT(id) as cantidad_visitas FROM `cliente_has_visitas` WHERE `id_oportunidad` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['cantidad_visitas'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function informe_excel_visitas_clientes($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT `id`, `fecha`, `objetivo_visita`, `nombre_cliente`, `nombre_obra`, `observaciones` FROM `visitas_clientes` WHERE fecha BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha` DESC;";

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
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['tipo_visita'] = $fila['tipo_visita'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['observaciones'] = $fila['observaciones'];
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


    public static function nombre_resltado_visita($con, $id)
    {
        $sql = "SELECT descripcion FROM resultado_vista where id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
    }


    public function informe_excel_visitas($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT cliente_has_visitas.id_oportunidad,  cliente_has_visitas.fecha,ct63_oportuniodad_negocio.asesora_comercial, ct63_oportuniodad_negocio.nidentificacion, cliente_has_visitas.resultado, ct63_oportuniodad_negocio.razon_social,ct63_oportuniodad_negocio.telefono_cliente,`nombre_motivo`, `obs` FROM `cliente_has_visitas`  INNER JOIN ct63_oportuniodad_negocio ON cliente_has_visitas.id_oportunidad = ct63_oportuniodad_negocio.id WHERE cliente_has_visitas.fecha BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha` DESC;";

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
                    $data_array['id_oportunidad'] = $fila['id_oportunidad'];
                    $data_array['asesora_comercial'] = SELF::get_nombre_asesora($fila['asesora_comercial']);
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['nidentificacion'] = $fila['nidentificacion'];
                    $data_array['razon_social'] = $fila['razon_social'];
                    $data_array['telefono_cliente'] = $fila['telefono_cliente'];
                    $data_array['resultado'] = SELF::nombre_resltado_visita($this->con, $fila['resultado']);
                    $data_array['nombre_motivo'] = $fila['nombre_motivo'];
                    $data_array['obs'] = $fila['obs'];
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

    function get_datos_cliente_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `asesora_comercial`, `id_sede`, `tipo_cliente`, `tipo_plan_maestro`, `nidentificacion`, `nombrescompletos`, `apellidoscompletos`, `telefono_cliente` FROM `ct63_oportuniodad_negocio` WHERE `id` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
    }

    public function log_registro_oportunidad_negocio($accion, $descripcion, $id_oportunidad, $id_usuario)
    {
        $fecha_creacion = "" . date("Y-m-d H:i:s");
        $sql = "INSERT INTO `log_registro_oportunidad_negocio`( `fecha_create`, `accion`, `descripcion`, `id_oportunidad`, `id_usuario`) VALUES (:fecha_creacion, :accion, :descripcion , :id_oportunidad, :id_usuario)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_creacion', $fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':accion', $accion, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_oportunidad', $id_oportunidad, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_asesora_comercial($asesora_comercial, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET asesora_comercial = :asesora_comercial WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':asesora_comercial', $asesora_comercial, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_fecha_contacto($fecha_contacto, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET fecha_contacto = :fecha_contacto WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_contacto', $fecha_contacto, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_tipo_cliente($tipo_cliente, $tipo_plan_maestro, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET tipo_cliente = :tipo_cliente, tipo_plan_maestro = :tipo_plan_maestro WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':tipo_cliente', $tipo_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_plan_maestro', $tipo_plan_maestro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_sede($sede, $nombre, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET id_sede = :id_sede, nombre_sede = :nombre_sede  WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_sede', $sede, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_sede', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_dep_municipio($departamento, $municipio, $comuna, $barrio, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET departamento = :departamento, municipio = :municipio, comuna = :comuna, barrio = :barrio WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':departamento', $departamento, PDO::PARAM_STR);
        $stmt->bindParam(':municipio', $municipio, PDO::PARAM_STR);
        $stmt->bindParam(':comuna', $comuna, PDO::PARAM_STR);
        $stmt->bindParam(':barrio', $barrio, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_cliente($nidentificacion, $nombrescompletos, $apellidoscompletos, $telefono_cliente, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET nidentificacion = :nidentificacion, nombrescompletos = :nombrescompletos, apellidoscompletos = :apellidoscompletos, telefono_cliente = :telefono_cliente WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nidentificacion', $nidentificacion, PDO::PARAM_STR);
        $stmt->bindParam(':nombrescompletos', $nombrescompletos, PDO::PARAM_STR);
        $stmt->bindParam(':apellidoscompletos', $apellidoscompletos, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_obra($nombre_obra, $direccion_obra, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET nombre_obra = :nombre_obra, direccion_obra = :direccion_obra WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $direccion_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function actualizar_datos_maestro($nombre_maestro, $celular_maestro, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET nombre_maestro = :nombre_maestro, celular_maestro = :celular_maestro WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre_maestro', $nombre_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':celular_maestro', $celular_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_potencia($m3_potenciales, $fecha_posible_fundida, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET m3_potenciales = :m3_potenciales, fecha_posible_fundida = :fecha_posible_fundida WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':m3_potenciales', $m3_potenciales, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_posible_fundida', $fecha_posible_fundida, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_resultado($resultado, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET estado = :resultado WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_status($status_op, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET status_op = :status_op WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':status_op', $status_op, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_observaciones($observaciones, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET observacion = :observacion WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':observacion', $observaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_datos_contacto($contacto_cliente, $id)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET contacto_cliente = :contacto_cliente WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':contacto_cliente', $contacto_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function actualizar_nombre_completo($nombre, $apellido, $id)
    {
        $razon_social = $nombre . " " . $apellido;
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET razon_social = :nombre_completo WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre_completo', $razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function select_comercial($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione Comercial</option>";

        $sql = "SELECT  `ct1_IdTerceros`, `ct1_NumeroIdentificacion`, `ct1_RazonSocial`  FROM `ct1_terceros` WHERE `ct1_rol` = 12  OR `ct1_rol` = 13 OR  `ct1_rol` = 8 ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['ct1_IdTerceros']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" ' . $selection . ' >' . $fila['ct1_RazonSocial'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_sede($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione la sede</option>";

        $sql = "SELECT `id`, `descripcion` FROM `listado_sedes`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_tipo_cliente($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione tipo de cliente</option>";

        $sql = "SELECT `id_tipo_cliente`, `descripcion` FROM `tipo_cliente`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);



        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id_tipo_cliente']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id_tipo_cliente'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_tipo_plan_maestro($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione tipo de plan maestro</option>";

        $sql = "SELECT `id`, `descripcion` FROM `tipo_plan_maestro`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }
    public function select_comuna($id_municipio, $id_comuna = null)
    {
        $this->id_municipio = intval($id_municipio);
        $this->id_comuna = intval($id_comuna);

        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione</option>";

        if ($id_municipio == 427 || $id_municipio == 428) {
            $sql = "SELECT `id`, `nombre_comuna` FROM `comunas` WHERE `id_municipio` = :id_municipio";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_INT);
        } else {
            $sql = "SELECT `id`, `nombre_comuna` FROM `comunas` WHERE `id_municipio` = 0";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
        }


        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_comuna == $fila['id']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre_comuna'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    public function select_municipio($id_departamento, $id_municipio = null)
    {
        $this->id_departamento = intval($id_departamento);
        $this->id_municipio = intval($id_municipio);

        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione</option>";
        $sql = "SELECT `id_municipio`, `municipio`  FROM `municipios` WHERE  departamento_id = :id_departamento";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_departamento', $id_departamento, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_municipio == $fila['id_municipio']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id_municipio'] . '" ' . $selection . ' >' . $fila['municipio'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    public function select_departamento($id_departamento = null)
    {
        $this->id_departamento = intval($id_departamento);

        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione</option>";
        $sql = "SELECT `id_departamento`, `departamento` FROM `departamentos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_departamento == $fila['id_departamento']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id_departamento'] . '" ' . $selection . ' >' . $fila['departamento'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    public function select_resultado($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione resultado</option>";

        $sql = "SELECT `id`, `descripcion` FROM `resultado_op`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_resultado_visita($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione resultado</option>";

        $sql = "SELECT `id`, `descripcion` FROM `resultado_vista`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_motivo($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione motivo</option>";

        $sql = "SELECT `id`, `descripcion` FROM `motivo_perdida`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_resultados_visita($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione resultado</option>";

        $sql = "SELECT `id`, `resultado`, resultado_vista.descripcion FROM `cliente_has_visitas` INNER JOIN resultado_vista ON cliente_has_visitas.resultado = resultado_vista.id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_contacto($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione forma de contacto</option>";

        $sql = "SELECT `id`, `descripcion` FROM `contacto_cliente`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_status_op($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione resultado</option>";

        $sql = "SELECT `id`, `descripcion` FROM `status_op`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }
    public function editar_oportunidad($id, $num_ident, $nombre_completos, $apellidos_completos, $result)
    {
        $razon_social = $nombre_completos . " " . $apellidos_completos;
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET `nidentificacion`=:num_ident ,`razon_social`= :razon_social ,`nombrescompletos`= :nombre_completos,`apellidoscompletos`= :apellidos_completos,`resultado`= :resultado WHERE `id` = :id";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':estatus', $status, PDO::PARAM_STR);
        $stmt->bindParam(':resultado', $result, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos_completos', $apellidos_completos, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_completos', $nombre_completos, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':num_ident', $num_ident, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Error en la sentencia sql
        }
    }


    public function actualizar_resultado_op($id, $resultado)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET `status_op`= :resultado WHERE `id` = :id";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function actualizar_resultado($id, $resultado)
    {
        $sql = "UPDATE `ct63_oportuniodad_negocio` SET `estado`= :resultado WHERE `id` = :id";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function get_id_status($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM `ct63_oportuniodad_negocio` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['status_op'];
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

    public function select_resultado_op($id_select = null)
    {

        $option = "<option  selected='true' value='0'> Seleccione </option>";
        $sql = "SELECT `id`, `descripcion` FROM `resultado_op`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_select == $fila['id']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    public function edit_visita($id, $fecha, $resultado, $id_motivo, $nombre_motivo, $observacion)
    {
        $sql = "UPDATE `cliente_has_visitas` SET `fecha`= :fecha,`resultado`=:resultado, `id_motivo_perdida` = :motivo_perdida, `nombre_motivo` = :nombre_motivo, `obs`=:observacion WHERE `id` = :id";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_INT);
        $stmt->bindParam(':motivo_perdida', $id_motivo, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_motivo', $nombre_motivo, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return true;
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function getdate_for_id($id_oportunidad)
    {
        $sql = "SELECT id, `fecha` FROM `cliente_has_visitas`  WHERE id_oportunidad = :id_oportunidad ORDER BY `cliente_has_visitas`.`fecha` DESC  LIMIT 1";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_oportunidad', $id_oportunidad, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha'] = $fila['fecha'];
                    $datosf[] = $data_array;
                }
                return $datosf;
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function getdata_oportunidad_negocio_for_id($id)
    {
        $sql = "SELECT * FROM `ct63_oportuniodad_negocio` WHERE `id` = :id";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['id_sede'] = $fila['id_sede'];
                    $data_array['asesora_comercial'] = $fila['asesora_comercial'];
                    $data_array['fecha_contacto'] = $fila['fecha_contacto'];
                    $data_array['tipo_cliente'] = $fila['tipo_cliente'];
                    $data_array['tipo_plan_maestro'] = $fila['tipo_plan_maestro'];
                    $data_array['departamento'] = $fila['departamento'];
                    $data_array['municipio'] = $fila['municipio'];
                    $data_array['comuna'] = $fila['comuna'];
                    $data_array['barrio'] = $fila['barrio'];
                    $data_array['nidentificacion'] = $fila['nidentificacion'];
                    $data_array['razon_social'] = $fila['razon_social'];
                    $data_array['nombrescompletos'] = $fila['nombrescompletos'];
                    $data_array['apellidoscompletos'] = $fila['apellidoscompletos'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['direccion_obra'] = $fila['direccion_obra'];
                    $data_array['telefono_cliente'] = $fila['telefono_cliente'];
                    $data_array['nombre_maestro'] = $fila['nombre_maestro'];
                    $data_array['celular_maestro'] = $fila['celular_maestro'];
                    $data_array['m3_potenciales'] = $fila['m3_potenciales'];
                    $data_array['fecha_posible_fundida'] = $fila['fecha_posible_fundida'];
                    $data_array['resultado'] = $fila['estado'];
                    $data_array['contacto_cliente'] = $fila['contacto_cliente'];
                    $data_array['observacion'] = $fila['observacion'];
                    $data_array['status_op'] = $fila['status_op'];

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

    public function get_data_visitas_id($id)
    {
        $sql = "SELECT `id`, `resultado` FROM `cliente_has_visitas` WHERE `id` = :id;";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['resultado'] = $fila['resultado'];
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

    public function datatable_visita($id_oportunidad)
    {
        $sql = "SELECT cliente_has_visitas.id, `id_oportunidad`, `fecha`, `resultado`, resultado_vista.descripcion as resultado_visita, `obs` FROM `cliente_has_visitas` INNER JOIN resultado_vista ON cliente_has_visitas.resultado = resultado_vista.id  WHERE id_oportunidad = :id_oportunidad";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_oportunidad', $id_oportunidad, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['id_oportunidad'] = $fila['id_oportunidad'];
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['resultado'] = $fila['resultado_visita'];
                    $data_array['obs'] = $fila['obs'];
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

    public function crear_visita($id_oportunidad, $fecha, $resultado, $id_motivo, $nombre, $observacion)
    {
        $sql = "INSERT INTO `cliente_has_visitas`(`id_oportunidad`, `fecha`, `resultado`, `id_motivo_perdida`, `nombre_motivo`, `obs`) VALUES (:id_oportunidad, :fecha, :resultado, :id_motivo_perdida, :nombre_motivo, :observacion)";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':id_oportunidad', $id_oportunidad, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_INT);
        $stmt->bindParam(':id_motivo_perdida', $id_motivo, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_motivo', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return $this->con->lastInsertId();
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function crear_oportunidad_negocio($asesora_comercial, $sede, $nombre_sede, $fecha_contacto, $tipo_cliente, $tipo_plan_maestro, $departamento, $municipio, $comuna, $barrio, $nit, $nombre_completo, $ap_completo, $nombre_obra, $direccion_obra, $telefono_cliente, $nombre_maestro, $celular_maestro, $m3_potenciales, $fecha_posible_fundida, $resultado, $contacto_cliente, $observacion)
    {
        $razon_social = $nombre_completo . " " . $ap_completo;
        $sql = "INSERT INTO `ct63_oportuniodad_negocio`(`asesora_comercial`, `fecha_contacto`, `id_sede`, nombre_sede, tipo_cliente, tipo_plan_maestro, `departamento`, `municipio`, `comuna`, `barrio`, `nidentificacion`, `razon_social`, `nombrescompletos`, `apellidoscompletos`, `nombre_obra`, `direccion_obra`,telefono_cliente, `nombre_maestro`, `celular_maestro`, `m3_potenciales`, `fecha_posible_fundida`, `estado`, `contacto_cliente`, `observacion`) VALUES (:asesora_comercial, :fecha_contacto, :id_sede, :nombre_sede, :tipo_cliente, :tipo_plan_maestro,:departamento, :municipio, :comuna, :barrio, :nit, :razon_social ,:nombre_completo, :ap_completo, :nombre_obra, :direccion_obra,:telefono_cliente,  :nombre_maestro ,:celular_maestro, :m3_potenciales, :fecha_posible_fundida, :resultado , :contacto_cliente, :observacion)";
        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        // Marcadores
        $stmt->bindParam(':asesora_comercial', $asesora_comercial, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_contacto', $fecha_contacto, PDO::PARAM_STR);
        $stmt->bindParam(':id_sede', $sede, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_sede', $nombre_sede, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_cliente', $tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_plan_maestro', $tipo_plan_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $departamento, PDO::PARAM_STR);
        $stmt->bindParam(':municipio', $municipio, PDO::PARAM_STR);
        $stmt->bindParam(':comuna', $comuna, PDO::PARAM_STR);
        $stmt->bindParam(':barrio', $barrio, PDO::PARAM_STR);
        $stmt->bindParam(':nit', $nit, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_completo', $nombre_completo, PDO::PARAM_STR);
        $stmt->bindParam(':ap_completo', $ap_completo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $direccion_obra, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_maestro', $nombre_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':celular_maestro', $celular_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':m3_potenciales', $m3_potenciales, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_posible_fundida', $fecha_posible_fundida, PDO::PARAM_STR);
        $stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
        $stmt->bindParam(':contacto_cliente', $contacto_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $observacion, PDO::PARAM_STR);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            return $this->con->lastInsertId();
        } else {
            return false; // Error en la sentencia sql
        }
    }


    public function dt_oportunidad_negocio_por_id($asesora_comercial, $cod)
    {
        $sql = "SELECT ct63_oportuniodad_negocio.id , `fecha_contacto`, `nidentificacion`,razon_social, `nombrescompletos`, `apellidoscompletos`, `estado`, `observacion`, `status_op`, resultado_op.descripcion as estado_op FROM `ct63_oportuniodad_negocio`  INNER JOIN resultado_op ON ct63_oportuniodad_negocio.estado = resultado_op.id WHERE `asesora_comercial` = :asesora_comercial AND ct63_oportuniodad_negocio.id LIKE '%$cod%'";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':asesora_comercial', $asesora_comercial, PDO::PARAM_STR);

        //  $stmt-> (':id_cliente', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_contacto'];
                    $datos['nidentificacion'] = $fila['nidentificacion'];
                    $datos['razon_social'] = $fila['razon_social'];
                    $datos['status_op'] = $fila['estado_op'];
                    $datos['observacion'] = $fila['observacion'];
                    $datos['resultado'] = $fila['estado'];
                    $datos['editar'] = "<button type='button' class='btn_editar btn btn-warning btn-sm' href='editar/editar.php?id=" . $fila['id'] . "'> <i class='fas fa-eye'></i> </button> <button type='button' class='btn_eliminar btn btn-danger btn-sm' ><i class='fas fa-trash-alt'></i>/button>";

                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function dt_oportunidad_negocio($cod)
    {
        $sql = "SELECT ct63_oportuniodad_negocio.id , `fecha_contacto`, `nidentificacion`,razon_social, `nombrescompletos`, `apellidoscompletos`, `estado`, `observacion`, `status_op`, resultado_op.descripcion as estado_op FROM `ct63_oportuniodad_negocio`  INNER JOIN resultado_op ON ct63_oportuniodad_negocio.estado = resultado_op.id WHERE ct63_oportuniodad_negocio.id LIKE '%$cod%'";
        $stmt = $this->con->prepare($sql);
        //  $stmt-> (':id_cliente', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_contacto'];
                    $datos['nidentificacion'] = $fila['nidentificacion'];
                    $datos['razon_social'] = $fila['razon_social'];
                    $datos['status_op'] = $fila['estado_op'];
                    $datos['observacion'] = $fila['observacion'];
                    $datos['resultado'] = $fila['estado'];
                    $datos['editar'] = "<button type='button' class='btn_editar btn btn-warning btn-sm' href='editar/editar.php?id=" . $fila['id'] . "'> <i class='fas fa-eye'></i> </button> <button type='button' class='btn_eliminar btn btn-danger btn-sm' > <i class='fas fa-trash-alt'></i></button>";


                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_sede($id)
    {
        $this->id = $id;
        $sql = "SELECT descripcion FROM `listado_sedes` WHERE `id` = :id";
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

    public function get_nombre_motivo_perdida($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM `motivo_perdida` WHERE `id` = :id";
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
}
