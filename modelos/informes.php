<?php

class informes extends conexionPDO

{

    public $con;
    protected $PDO;

    private $table_remisiones = 'ct26_remisiones';





    public function __construct()

    {

        $this->PDO = new conexionPDO();

        $this->con = $this->PDO->connect();

        date_default_timezone_set('America/Bogota');
    }


    function get_nombre_producto($id)
    {
        $sql = "SELECT `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registro
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct4_Descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function informe_segmentacionDane2($fecha_ini, $fecha_fin)
    {

        $this->fecha_ini = $fecha_ini;

        $this->fecha_fin = $fecha_fin;



        $sql = "SELECT sum(ct26_metros) as metros, ct5_obras.ct5_segmento as idsegmento FROM `ct26_remisiones` INNER JOIN ct5_obras on ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE `ct26_date_create` BETWEEN :fecha_ini AND :fecha_fin  GROUP BY ct5_obras.ct5_segmento ORDER BY `ct26_id_remision` DESC";

        $stmt = $this->con->prepare($sql);



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);





        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    function segmentacion_info($id_segmentacion)

    {

        $sql = "SELECT descripcion FROM `segmento` WHERE `id_segmento` = :id_segmentacion";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_segmentacion', $id_segmentacion, PDO::PARAM_INT);



        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if ($num_reg == 1) { // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $descripcion = $fila['descripcion'];
                }

                return $descripcion;
            } else {

                return null;
            }
        } else {

            return false;
        }
    }

    function novedades_remi($id_remision)
    {
        $this->id_remision = (int)$id_remision;
        $sql = "SELECT `ct44_novedades` FROM `ct44_novedades_remi` WHERE `ct44_id_remi` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg >= 1) { // Validar el numero de Registros
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
    }

    function novedades_dasa($id)
    {
        $this->id = (int)$id;
        $sql = "SELECT `ct44_novedades` FROM `ct44_novedades_remi` WHERE `ct44_id_remi` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg >= 1) { // Validar el numero de Registros
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
    }
    function informe_fact($fecha_ini, $fecha_fin)
    {



        $this->fecha_ini = $fecha_ini . " 00:00:00.000000";

        $this->fecha_fin = $fecha_fin . ' 23:59:59.000000';



        $sql = "SELECT ct27_facturae.ct27_fecha_subda, ct27_facturae.ct27_nombre_factura, ct26_remisiones.ct26_codigo_remi FROM `ct28_factura_remi` INNER JOIN ct27_facturae ON ct28_factura_remi.ct28_id_fact = ct27_facturae.ct27_id_factura  INNER JOIN ct26_remisiones ON ct28_factura_remi.ct28_id_remision = ct26_remisiones.ct26_id_remision WHERE `ct27_fecha_subda`  BETWEEN :fecha_ini AND :fecha_fin";



        $stmt = $this->con->prepare($sql);



        //Formato fecha  AAAA-MM-DD



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);



        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    function informe_segmentacionDane($fecha_ini, $fecha_fin)
    {

        $this->fecha_ini = $fecha_ini;

        $this->fecha_fin = $fecha_fin;



        $sql = "SELECT ct26_idObra as id_obra , ct5_obras.ct5_NombreObra as nombre_obra, sum(ct26_metros) as metros, ct5_obras.ct5_segmento as segmento FROM `ct26_remisiones` INNER JOIN ct5_obras on ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE `ct26_date_create` BETWEEN :fecha_ini AND :fecha_fin GROUP BY ct26_idcliente, ct26_idObra ORDER BY `ct26_id_remision` DESC";

        $stmt = $this->con->prepare($sql);



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);





        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    public static function select_nombre_conductor($con, $numero_identificacion)

    {

        static $cache_nombres = array();

        $numero_identificacion = intval($numero_identificacion);
        if ($numero_identificacion <= 0) {
            return false;
        }

        if (array_key_exists($numero_identificacion, $cache_nombres)) {
            return $cache_nombres[$numero_identificacion];
        }

        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :num_identificacion LIMIT 1";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':num_identificacion', $numero_identificacion, PDO::PARAM_INT);

        if (!$stmt->execute()) { // Ejecutar
            $cache_nombres[$numero_identificacion] = false;
            return false;
        }

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if ($fila && isset($fila['ct1_RazonSocial'])) {
            $cache_nombres[$numero_identificacion] = $fila['ct1_RazonSocial'];
            return $cache_nombres[$numero_identificacion];
        }

        $cache_nombres[$numero_identificacion] = false;
        return false;
    }



    function informe_remi($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT r.*, 
                       cli.ct1_RazonSocial AS nombre_cliente_lookup,
                       con.ct1_RazonSocial AS nombre_conductor_lookup
                FROM `ct26_remisiones` r
                LEFT JOIN `ct1_terceros` cli ON cli.`ct1_NumeroIdentificacion` = r.`ct26_nitcliente`
                LEFT JOIN `ct1_terceros` con ON con.`ct1_NumeroIdentificacion` = r.`ct26_identificacion_conductor`
                WHERE r.`ct26_fecha_remi` BETWEEN :fecha_ini AND :fecha_fin
                ORDER BY r.`ct26_id_remision` DESC";
        $stmt = $this->con->prepare($sql);
        //Formato fecha  AAAA-MM-DD
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $datos = array();
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $fila['nombre_cliente'] = !empty($fila['nombre_cliente_lookup']) ? $fila['nombre_cliente_lookup'] : $fila['ct26_razon_social'];
                $fila['nombre_conductor'] = !empty($fila['nombre_conductor_lookup']) ? $fila['nombre_conductor_lookup'] : $fila['ct26_nombre_conductor'];
                unset($fila['nombre_cliente_lookup'], $fila['nombre_conductor_lookup']);
                $datos[] = $fila;
            }
            $stmt->closeCursor();

            if (!empty($datos)) {
                return $datos;
            }

            return false;
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }

    public function get_datos_clientes($id)
    {
        $this->id_cliente = $id;
        $sql = "SELECT `ct1_nombre_asesora`,`ct1_nombre_sede`,`ct1_nombre_tipo_cliente`,`ct1_tipo_plan_maestro`,`ct1_TipoIdentificacion`,`ct1_NumeroIdentificacion` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $data_array['ct1_nombre_asesora'] = $fila['ct1_nombre_asesora'];
                    $data_array['ct1_nombre_sede'] = $fila['ct1_nombre_sede'];
                    $data_array['ct1_nombre_tipo_cliente'] = $fila['ct1_nombre_tipo_cliente'];
                    $data_array['ct1_tipo_plan_maestro'] = $fila['ct1_tipo_plan_maestro'];
                    $data_array['ct1_TipoIdentificacion'] = $fila['ct1_TipoIdentificacion'];
                    $data_array['ct1_NumeroIdentificacion'] = $fila['ct1_NumeroIdentificacion'];
                    $datosf[] = $data_array;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }

    public function get_datos_obras($id)
    {
        $this->id_obra = $id;
        $sql = "SELECT `ct5_NombreObra`,`ct5_nombre_departamento`,`ct5_nombre_ciudad`,`ct5_nombre_comuna`,`ct5_barrio`,`ct5_segmento`,`ct5_DireccionObra`,`longitud`, `latitud`, `distanciaRMI`, `distanciaRZO`, `distanciaRMT`, `distanciaHND` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $data_array['ct5_NombreObra'] = $fila['ct5_NombreObra'];
                    $data_array['ct5_nombre_departamento'] = $fila['ct5_nombre_departamento'];
                    $data_array['ct5_nombre_ciudad'] = $fila['ct5_nombre_ciudad'];
                    $data_array['ct5_nombre_comuna'] = $fila['ct5_nombre_comuna'];
                    $data_array['ct5_barrio'] = $fila['ct5_barrio'];
                    $data_array['ct5_segmento'] = $fila['ct5_segmento'];
                    $data_array['ct5_DireccionObra'] = $fila['ct5_DireccionObra'];
                    $data_array['longitud'] = $fila['longitud'];
                    $data_array['latitud'] = $fila['latitud'];
                    $data_array['distanciaRMI'] = $fila['distanciaRMI'];
                    $data_array['distanciaRZO'] = $fila['distanciaRZO'];
                    $data_array['distanciaRMT'] = $fila['distanciaRMT'];
                    $data_array['distanciaHND'] = $fila['distanciaHND'];
                    $datosf[] = $data_array;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }

    public function get_nombre_segmento($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `segmento` WHERE `id_segmento` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    public function get_nombre_tipo_plan_maestro($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `tipo_plan_maestro` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function informe_dasa($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT `fecha_hora`, `placa`, `producto`, `cantidad`, `ppu`, `iva`, `total_producto`, `total_documento`, gps.UnitName1, gps.MilesDriven, gps.Textbox3, gps.Textbox6, gps.Textbox11 FROM `dasa` INNER JOIN gps ON dasa.placa = gps.UnitName1 WHERE `fecha` BETWEEN :fecha_ini AND :fecha_fin";
        $stmt = $this->con->prepare($sql);
        //Formato fecha  AAAA-MM-DD
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $data_array['fecha_hora'] = $fila['fecha_hora'];
                    $data_array['placa'] = $fila['placa'];
                    $data_array['producto'] = $fila['producto'];
                    $data_array['cantidad'] = $fila['cantidad'];
                    $data_array['ppu'] = $fila['ppu'];
                    $data_array['total_producto'] = $fila['total_producto'];
                    $data_array['total_documento'] = $fila['total_documento'];
                    $data_array['UnitName1'] = $fila['UnitName1'];
                    $data_array['MilesDriven'] = $fila['MilesDriven'];
                    $data_array['Textbox3'] = $fila['Textbox3'];
                    $data_array['Textbox6'] = $fila['Textbox6'];
                    $data_array['Textbox11'] = $fila['Textbox11'];
                    $datosf[] = $data_array;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }
}
