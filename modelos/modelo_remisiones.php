<?php

class modelo_remisiones extends conexionPDO
{
    protected $con;

    private $id;

    protected $PDO;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    


    

    public function remisiones_clientes($id_cliente, $id_obra)
    {
        $sql = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idcliente` IN($id_cliente) AND `ct26_idObra` IN($id_obra)  ORDER BY `ct26_id_remision` DESC LIMIT 10000";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos['id'] = $fila['ct26_id_remision'];
                    $datos['checkbox'] = "<div class='form-group clearfix'><div class='icheck-primary d-inline'><input type='checkbox' name='id_remi[]' value='" . $fila['ct26_id_remision'] . "'></div></div>";
                    $date = new DateTime($fila['ct26_fecha_remi']);
                    $datos['fecha_remision'] = $date->format("d-m-Y");
                    $datos['id_cliente'] = $fila['ct26_idcliente'];
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['numero_remision'] = $fila['ct26_codigo_remi'];

                    switch ($fila['ct26_estado']) {
                        case 1:
                            $datos['estado'] = '<small class="badge badge-success"> Facturada </small>';
                            break;
                        case 2:
                            $datos['estado'] = '<small class="badge badge-success"> Firmada </small>';
                            break;

                        case 3:
                            $datos['estado'] = '<small class="badge badge-warning"> Faltan Firma cliente </small>';
                            break;

                        case 4:
                            $datos['estado'] = '<small class="badge badge-warning"> Falta Sincronizacion de datos </small>';
                            break;

                        default:
                            $datos['estado'] = '<small class="badge badge-info">  </small>';
                            break;
                    }
                    $datos['boton_ver'] = "<a href='detalle_remision.php?id=" . $fila['ct26_id_remision'] . "&ob=" . $fila['ct26_nombre_obra'] . "' class='btn btn-block bg-gradient-info'> <i class='fas fa-edit'></i> Ver </a>";
                    if (empty($fila['ct26_imagen_remi'])) {

                        $datos['boton_editar'] = "<a href='ver_remision/remision.php?id=" . $fila['ct26_id_remision'] . "'><i class='fas fa-eye fa-2x' style=''></i></a> ";
                    } else {
                        $datos['boton_editar'] = "<a href='" . $fila['ct26_imagen_remi'] . "'><i class='fas fa-eye fa-2x' style=''></i></a> ";

                    }
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
    public function get_clientes_obras($id)
    {
        $sql = "SELECT `id_cliente`, `id_obra` FROM ct1_gestion_acceso WHERE `id_residente` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['cliente'] = $fila['id_cliente'];
                    $datos['obra'] = $fila['id_obra'];
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
    
    public function datatable_remisiones_cliente($id_cliente, $id_obra)
    {
        $this->id_cliente = intval($id_cliente);

        if (is_null($id_obra)) {
            $sql = "SELECT `ct26_id_remision`,`ct26_estado`,ct26_fecha_remi, `ct26_codigo_remi`,`ct26_imagen_remi`,`ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra` FROM `ct26_remisiones` WHERE `ct26_idcliente` =  :id_cliente  ORDER BY `ct26_remisiones`.`ct26_fecha_remi` DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        } else {
            $this->id_obra = intval($id_obra);
            $sql = "SELECT `ct26_id_remision`,`ct26_estado`,ct26_fecha_remi,`ct26_codigo_remi`,`ct26_imagen_remi`,`ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra` FROM `ct26_remisiones` WHERE `ct26_idcliente` =  :id_cliente AND `ct26_idObra` =  :id_obra  ORDER BY `ct26_remisiones`.`ct26_fecha_remi` DESC";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct26_id_remision'];
                    $datos['check'] = "<input type='checkbox' value='" . $fila['ct26_id_remision'] . "' name='check_id_remi[]'  >";
                    $date = new DateTime($fila['ct26_fecha_remi']);
                    $datos['fecha_remi'] = $date->format("d-m-Y");
                    switch (intval($fila['ct26_estado'])) {
                        case 1:
                            $datos['estado'] = '<small class="badge badge-success"> Facturada </small>';
                            break;
                        case 2:
                            $datos['estado'] = '<small class="badge badge-info"> Pendiente de Facturacion </small>';
                            break;

                        case 3:
                            $datos['estado'] = '<small class="badge badge-warning"> Faltan Firma cliente </small>';
                            break;

                        case 4:
                            $datos['estado'] = '<small class="badge badge-warning"> Falta Sincronizacion de datos </small>';
                            break;

                        default:
                            $datos['estado'] = '<small class="badge badge-info">  </small>';
                            break;
                    }
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['file_remiweb'] = $fila['ct26_imagen_remi'];
                    $datos['botones'] = '<a href="detalle_remision.php?id=' . $fila['ct26_id_remision'] . '&ob=' . $fila['ct26_nombre_obra'] . '" class="btn btn-block bg-gradient-info">Ver Remi </a>
                                                    <a href="ver_remision/remision.php?id=' . $fila['ct26_id_remision'] . '"><i class="fas fa-eye fa-2x" style=""></i></a>';
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

    function data_muestras_for_id($id_muestra)
    {
        $this->id = intval($id_muestra);
        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, ct62_tipomuestra.ct62_descripcion, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, ct10_vehiculo.ct10_Placa, `ct57_id_cliente`, `ct57_nombre_cliente`, `ct57_id_obra`, `ct57_nombre_obra`, `ct57_codremision`, `ct57_id_producto`, `ct57_cod_producto`, `ct57_nombre_producto`, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_m3_muestra`, `ct57_asentamiento`, `ct57_temperatura`, `ct57_cementante`, `ct57_aire`, `ct57_rend_volumetrico` FROM `ct57_muestra` INNER JOIN ct10_vehiculo ON ct57_muestra.ct57_id_mixer = ct10_vehiculo.ct10_IdVehiculo INNER JOIN ct62_tipomuestra ON ct57_muestra.ct57_tipo_muestra = ct62_tipomuestra.ct62_id WHERE `ct57_id_muestra` = :id_muestra";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $this->id, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct57_id_muestra'];
                    $datos['tipo_muestra'] = $fila['ct57_tipo_muestra'];
                    $datos['descripcion'] = $fila['ct62_descripcion'];
                    $datos['fecha'] = $fila['ct57_fecha'];
                    $datos['hora'] = $fila['ct57_hora'];
                    $datos['cantidad'] = $fila['ct57_cantidad'];
                    $datos['remision'] = $fila['ct57_id_remision'];
                    $datos['id_mixer'] = $fila['ct57_id_mixer'];
                    $datos['placa'] = $fila['ct10_Placa'];
                    $datos['id_cliente'] = $fila['ct57_id_cliente'];
                    $datos['nombre_cliente'] = $fila['ct57_nombre_cliente'];
                    $datos['id_obra'] = $fila['ct57_id_obra'];
                    $datos['nombre_obra'] = $fila['ct57_nombre_obra'];
                    $datos['codigo_remision'] = $fila['ct57_codremision'];
                    $datos['id_producto'] = $fila['ct57_id_producto'];
                    $datos['cod_producto'] = $fila['ct57_cod_producto'];
                    $datos['nombre_producto'] = $fila['ct57_nombre_producto'];
                    $datos['id_tipo_producto'] = $fila['ct57_id_tipo_producto'];
                    $datos['cantidad_muestra'] = $fila['ct57_cantidad_muestra'];
                    $datos['muestra'] = $fila['ct57_m3_muestra'];
                    $datos['asentamiento'] = $fila['ct57_asentamiento'];
                    $datos['temperatura'] = $fila['ct57_temperatura'];
                    $datos['cementante'] = $fila['ct57_cementante'];
                    $datos['aire'] = $fila['ct57_aire'];
                    $datos['rend_volumetrico'] = $fila['ct57_rend_volumetrico'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    function data_productos_for_id($id_producto)
    {
        $this->id_producto = intval($id_producto);
        $sql = "SELECT `ct4_Id_productos`, `ct4_FechaCreacion`, `ct4_EstadoProducto`, `ct4_CodigoSyscafe`, `ct4_TipoConcreto`, `ct4_Resistencia`, `ct4_TamanoMAgregado`, `ct4_CaracteristicaConcreto`, `ct4_Color`, `ct4_Nombre`, `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id_producto";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_producto'] = $fila['ct4_Id_productos'];
                    $datos['fecha_creacion'] = $fila['ct4_FechaCreacion'];
                    $datos['estado_producto'] = $fila['ct4_EstadoProducto'];
                    $datos['codproducto'] = $fila['ct4_CodigoSyscafe'];
                    $datos['tipo_concreto'] = $fila['ct4_TipoConcreto'];
                    $datos['resistencia'] = $fila['ct4_Resistencia'];
                    $datos['tamano_agregado'] = $fila['ct4_TamanoMAgregado'];
                    $datos['caracteristica_concreto'] = $fila['ct4_CaracteristicaConcreto'];
                    $datos['color'] = $fila['ct4_Color'];
                    $datos['nombre'] = $fila['ct4_Nombre'];
                    $datos['descripcion'] = $fila['ct4_Descripcion'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }




    function data_remision_for_id($id_remision)
    {
        $this->id_remision = intval($id_remision);
        $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi,ct26_idcliente, ct26_razon_social , ct26_idObra,ct26_nombre_obra ,ct26_id_vehiculo, ct26_vehiculo, ct26_fecha_remi,ct26_id_producto,ct26_descripcion_producto,ct26_codigo_producto, ct26_metros FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL

        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_remision'] = $fila['ct26_id_remision']; // id Remision
                    $datos['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['id_cliente'] = $fila['ct26_idcliente']; // Id cliente
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['img'] = $fila['ct26_imagen_remi'];
                    $datos['id_mixer'] = $fila['ct26_id_vehiculo']; // id_vehiculo
                    $datos['placa'] = $fila['ct26_vehiculo'];
                    $datos['id_producto'] = $fila['ct26_id_producto']; // id Producto
                    $datos['codproducto'] = $fila['ct26_codigo_producto'];
                    $datos['producto'] = $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros']; // metros

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public static function data_table_remision($con)
    {
        $year = date('Y');
        $mes = date('m');
        $dia = date('d');

        $fecha = $year . '-' . --$mes . '-' . $dia;

        $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi,ct26_idcliente, ct26_razon_social , ct26_idObra,ct26_nombre_obra ,ct26_id_vehiculo, ct26_vehiculo, ct26_fecha_remi,ct26_id_producto,ct26_descripcion_producto,ct26_codigo_producto, ct26_metros FROM `ct26_remisiones` WHERE `ct26_fecha_remi` >= :fecha_remi ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_remi', $fecha, PDO::PARAM_STR);
        //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_remision'] = $fila['ct26_id_remision']; // id Remision
                    $datos['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['id_cliente'] = $fila['ct26_idcliente']; // Id cliente
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['img'] = $fila['ct26_imagen_remi'];
                    $datos['id_mixer'] = $fila['ct26_id_vehiculo']; // id_vehiculo
                    $datos['placa'] = $fila['ct26_vehiculo'];
                    $datos['id_producto'] = $fila['ct26_id_producto']; // id Producto
                    $datos['codproducto'] = $fila['ct26_codigo_producto'];
                    $datos['producto'] = $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros']; // metros

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion

    }


    public static function actualizar_estado_remi()
    {
        $sql = "SELECT * FROM `ct26_remisiones`  ";
    }

    public static function actualizar_estado_remi_id()
    {
        $sql = "SELECT * FROM `ct26_remisiones` ";
    }


    public static function get_name_tercero($con, $id_tercero)
    {

        $sql = "SELECT ct1_terceros.ct1_RazonSocial FROM ct1_terceros WHERE ct1_terceros.ct1_IdTerceros = :id_tercero";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_tercero', $id_tercero, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $nombre_tercero = $fila['ct1_RazonSocial'];
                }
                return $nombre_tercero;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_name_bomba($con, $id_bomba)
    {
        $sql = "SELECT `ct53_nombre_bomba` FROM `ct53_bomba` WHERE `ct53_id_bomba` = :id_bomba";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_bomba', $id_bomba, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $nombre_bomba = $fila['ct53_nombre_bomba'];
                }
                return $nombre_bomba;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function update_bombeo($id_remi, $id_bomba, $id_op_bomba, $id_aux_bomba)
    {
        $this->id_remi = intval($id_remi);
        $this->id_bomba = intval($id_bomba);
        if ($this->id_bomba <= 1) {
            $this->nombre_bomba = NULL;
            $this->nombre_op_bomba = NULL;
            $this->nombre_aux_bomba = NULL;
        } else {
            $this->nombre_bomba = SELF::get_name_bomba($this->con, $this->id_bomba);
            $this->id_op_bomba = intval($id_op_bomba);
            $this->nombre_op_bomba = SELF::get_name_tercero($this->con, $this->id_op_bomba);
            $this->id_aux_bomba = intval($id_aux_bomba);
            $this->nombre_aux_bomba = SELF::get_name_tercero($this->con, $this->id_aux_bomba);
        }

        $sql = "UPDATE `ct26_remisiones` SET `ct26_bomba` = :bomba,`ct26_id_op_bomba`= :id_op_bomba,`ct26_op_bomba`= :nombre_op_bomba,`ct26_id_aux_bomba`= :id_aux_bomba,`ct26_aux_bomba`= :nombre_aux_bomba WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':bomba', $this->nombre_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_op_bomba', $this->nombre_op_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_aux_bomba', $this->id_aux_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_aux_bomba', $this->nombre_aux_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->id_remi, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function data_remisiones_cli($id_obra)
    {

        $this->id_obra = intval($id_obra);
        $sql_obra = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC "; //Select Cliente
        $stmt_obra = $this->con->prepare($sql_obra);
        $stmt_obra->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if ($stmt_obra->execute()) {
            $num_reg =  $stmt_obra->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt_obra->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_factura_remi_cli($id_factura)
    {
        $sql = "SELECT ct26_remisiones.ct26_id_remision, ct26_remisiones.ct26_codigo_remi, ct26_remisiones.ct26_imagen_remi FROM `ct28_factura_remi` INNER JOIN ct26_remisiones ON ct28_factura_remi.ct28_id_remision = ct26_remisiones.ct26_id_remision WHERE `ct28_id_fact` = :id_factura";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_remision'] = $fila['ct26_id_remision'];
                    $datos_array['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos_array['img_remi'] = $fila['ct26_imagen_remi'];
                    $datos[] = $datos_array;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_remisiones($id_usuario)
    {
        $this->id_usuario = intval($id_usuario);
        $array_permisios = SELF::get_cli_obra_for_usuario($this->con, $this->id_usuario);

        foreach ($array_permisios as $key) {
            $array_remisiones = SELF::datatable_remi_cli($this->con, $key['id_obra']);

            foreach ($array_remisiones as $key['']) {
                # code...
            }
        }
    }

    public static function get_cli_obra_for_usuario($con, $id_usuario)
    {
        $sql = "SELECT `id_user_roles`, `id_user`, `id_roles`, `id_cliente`, `id_obra` FROM `usuarios_roles` WHERE `id_user` = :id_usuario";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_rol'] = $fila['id_roles'];
                    $datos_array['id_cliente'] = $fila['id_cliente'];
                    $datos_array['id_obra'] = $fila['id_obra'];
                    $datos[] = $datos_array;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function datatable_remi_cli($con, $id_obra)
    {
        $sql = "SELECT `ct26_id_remision`,`ct26_estado`,`ct26_fecha_remi`,`ct26_idcliente`,`ct26_nitcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra` FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_remision'] = $fila['ct26_id_remision'];
                    $datos_array['estado'] = $fila['ct26_estado'];
                    $datos_array['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos_array['id_cliente'] = $fila['ct26_idcliente'];
                    $datos_array['num_identificacion'] = $fila['ct26_nitcliente'];
                    $datos_array['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos_array['id_obra'] = $fila['ct26_idObra'];
                    $datos_array['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos[] = $datos_array;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
