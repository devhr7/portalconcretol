<?php

use GuzzleHttp\RetryMiddleware;

class cls_laboratorio extends conexionPDO
{
    public $con; // variable de conexion a la base de datos
    protected $PDO;

    // Conexcion y a la base de datos
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }

    public function consql()
    {
        return $this->con;
    }


    function eliminar_muestra($id)
    {
        $sql = "DELETE FROM `ct68_muestras` WHERE `id` =  :id_muestra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $id, PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecuta la consulta
            return true;
        } else {
            return false;
        }
    }

    public function GetDataProgResultadoMuestasXLXS($id_muestra, $id_periodo)
    {

        $sql = "SELECT `numero_resultados` FROM `ct68_programar_muestra` WHERE `id_muestra` = :id_muestra AND id_periodo = :id_periodo LIMIT 1 ";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $id_periodo, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return intval($fila['numero_resultados']);
                }
            } else {
                return false;
                $stmt->close();
                parent::closePDO();
            }
        } else {
            return false;
        }
    }

    public function GetDataResultadoMuestasXLXS($id_muestra, $id_periodo)
    {

        $sql = "SELECT `id`, `id_muestra`, `id_programado`, `fecha_programado`, `id_periodo`, `nombre_periodo`, `fecha_muestra`, `id_tipo_fallo`, `nombre_tipo_fallo`, `sub_tipo_fallo`, `reultadokn`, `kgcm2`, `observaciones` FROM `ct68_resultados_muestra` WHERE `id_muestra` = :id_muestra AND id_periodo = :id_periodo LIMIT 4 ";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $id_periodo, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta

                return  $stmt;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function GetDataMuestaConsolidadoBDsXLXS($fecha_ini, $fecha_fin, $sede)
    {

        //  `id`, `fecha_muestra`, `hora_muestra`, `id_remision`, `cod_remi`, `id_cliente`, `cliente`, `id_obra`, `obra`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_mixer`, `placa`
        if (is_null($sede)) {
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` ";
            $sql = "SELECT ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_muestras.clente, ct68_muestras.obra,ct68_muestras.codigo_producto,ct68_muestras.descripcion_producto,ct68_muestras.descripcion_producto,ct68_muestras.metros_cubicos ,ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra where  `fecha_muestra` BETWEEN :fecha_ini AND :fecha_fin ORDER BY `ct68_muestras`.`fecha_muestra` DESC";
            $stmt = $this->con->prepare($sql);  // Prepara la consulta
            $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        } else {
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` where sede = :sede  ";
            $sql = "SELECT  ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_muestras.cliente, ct68_muestras.obra,ct68_muestras.codigo_producto,ct68_muestras.descripcion_producto,ct68_muestras.descripcion_producto,ct68_muestras.metros_cubicos ,ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra where  sede = :sede AND  `fecha_muestra` BETWEEN :fecha_ini AND :fecha_fin  ORDER BY `ct68_muestras`.`fecha_muestra` DESC ";

            $stmt = $this->con->prepare($sql);  // Prepara la consulta
            $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        }
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta

                return $stmt;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function GetDataMuestaBDsXLXS($fecha_ini, $fecha_fin, $sede,$clienteId =0)
    {

    $sede = $sede ?? '';
    $clienteId = (int)$clienteId;

    $where = ["`fecha_muestra` BETWEEN :fecha_ini AND :fecha_fin"];

    if ($sede === 'HND') {
        $where[] = "sede IN ('HND')";
    } elseif ($sede === 'RMI') {
        $where[] = "sede IN ('RMI')";
    } elseif ($sede === 'NO') {
        $where[] = "sede IS NULL";
    } else {
        // sin filtro de sede adicional
    }

    if ($clienteId > 0) {
        $where[] = "id_cliente = :cliente_id";
    }

    $sql = "SELECT * FROM `ct68_muestras` WHERE " . implode(' AND ', $where) . " ORDER BY id DESC";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
    if ($clienteId > 0) {
        $stmt->bindValue(':cliente_id', $clienteId, PDO::PARAM_INT);
    }

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        return $stmt; // compatibilidad con excel.php (fetch en el caller)
    }
    return false;
    }


    function resultado_diaXLXS($id_muestra, $id_periodo)
    {
        $sql = "SELECT `id`,`reultadokn`,`kgcm2` FROM `ct68_resultados_muestra` WHERE `id_muestra` = :id_muestra AND `id_periodo` = :id_periodo";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $id_periodo, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['reultadokn'] = $fila['reultadokn'];
                    $datos['kgcm2'] = $fila['kgcm2'];
                    $datosf[] =   $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function resultado_consolidadoXLXS($id_muestra, $id_periodo)
    {
        $sql = "SELECT `id`, `id_muestra`, `id_periodo`, `nombre_periodo`, `promediokgcm2`, `porcentaje` FROM `ct68_resultado_consolidado` WHERE `id_muestra` = :id_muestra AND id_periodo = :id_periodo";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $id_periodo, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_muestra'] = $fila['id_muestra'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['promediokgcm2'] = $fila['promediokgcm2'];
                    $datos['porcentaje'] = (doubleval($fila['porcentaje']) * 100) . " %";
                    return $datos;
                }
            } else {
                $datos['promediokgcm2'] = "";
                $datos['porcentaje'] = "";

                return $datos;
            }
        } else {
            return false;
        }
    }

    public function GetDataMuestasXLXS($fecha_muestra, $sede)
    {

        $sql = "SELECT `id`, `fecha_muestra`, `hora_muestra`, `id_responsable`, `nombre_responsable`, `id_remision`, `cod_remi`, `id_cliente`, `cliente`, `id_obra`, `obra`, `id_producto`, `codigo_producto`, `descripcion_producto`, `metros_cubicos`, `id_mixer`, `placa`, `id_nombre_cementante`, `nombre_cementante`, `cementante_kg`, `asentamiento`, `temperatura`, `aire`, `totalkg_registrocargue`, `volumen_olla`, `peso_olla`, `pesoolla_mas_concreto`, `rendvol_peso_neto`, `rendvol_masaunitaria`, `rendvol_volumenreal`, `rend_volumetrico`, `ceniza`, `resistencia`, `id_probeta`, `diametro_probeta`, `observaciones`, `consecutivo_interno` FROM `ct68_muestras` WHERE fecha_muestra = :fecha_muestra AND sede = :sede ";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':fecha_muestra', $fecha_muestra, PDO::PARAM_STR);
        $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                return  $stmt;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function get_TotalRegistroCargue($id_remision)
    {

        if ($data_remisiones = $this::get_data_remi($this->con, $id_remision)) {
            $data['id_remision'] = $id_remision;
            $data['id_planta'] = $data_remisiones['linea'];
            $data['cod_remision'] = $data_remisiones['remision'];
            $data['metros'] = doubleval($data_remisiones['metros']);
            if ($data_batch = $this::get_data_batch($this->con, $data)) {
                $datos['Agua'] = doubleval($data_batch['Agua']);
                $datos['Cemento'] = doubleval($data_batch['Cemento']);
                $datos['Ceniza'] = doubleval($data_batch['Ceniza']);
                $datos['Agregado1'] = doubleval($data_batch['Agregado1']);
                $datos['Agregado2'] = doubleval($data_batch['Agregado2']);
                $datos['Agregado3'] = doubleval($data_batch['Agregado3']);
                $datos['Agregado4'] = doubleval($data_batch['Agregado4']);
                $datos['Adictivo1'] = doubleval($data_batch['Adictivo1']);
                $datos['Adictivo2'] = doubleval($data_batch['Adictivo2']);
                $datos['Adictivo3'] = doubleval($data_batch['Adictivo3']);


                /** Operacion */
                $TotalRegistroCargue = round($datos['Agua'] + $datos['Cemento'] + $datos['Ceniza'] + $datos['Agregado1'] + $datos['Agregado2'] + $datos['Agregado3'] + $datos['Agregado4'] + $datos['Adictivo1'] + $datos['Adictivo2'] + $datos['Adictivo3'], 2);

                return $TotalRegistroCargue;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_dataCementante($id_remision)
    {

        if ($data_remisiones = $this::get_data_remi($this->con, $id_remision)) {
            $data['id_remision'] = $id_remision;
            $data['id_planta'] = $data_remisiones['linea'];
            $data['cod_remision'] = $data_remisiones['remision'];
            $data['metros'] = doubleval($data_remisiones['metros']);
            if ($data_batch = $this::get_data_batch($this->con, $data)) {
                $data['Cemento'] = doubleval($data_batch['Cemento']);
                $data['Ceniza'] = doubleval($data_batch['Ceniza']);
                $data['Agregado1'] = doubleval($data_batch['Agregado1']);
                $data['Agregado2'] = doubleval($data_batch['Agregado2']);
                $data['Agregado3'] = doubleval($data_batch['Agregado3']);
                $datos['Agregado4'] = doubleval($data_batch['Agregado4']);
                $data['Adictivo1'] = doubleval($data_batch['Adictivo1']);
                $data['Adictivo2'] = doubleval($data_batch['Adictivo2']);
                $data['Adictivo3'] = doubleval($data_batch['Adictivo3']);


                /** Validar Resultados para la operacion */
                if ($data['Cemento'] > 0 && $data['metros'] > 0) {
                    $resultado1 = ($data['Cemento'] / $data['metros']);
                } else {
                    $resultado1 = 0;
                }

                if ($data['Ceniza'] > 0 && $data['metros'] > 0) {
                    $resultado2 = ($data['Ceniza'] / $data['metros']);
                } else {
                    $resultado2 = 0;
                }

                /** Operacion */
                $cementante = round($resultado1  + $resultado2, 2);

                return $cementante;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function get_data_batch($con, $data)
    {
        $sql = "SELECT sum(`ct29_RCemento1`) as Cemento, sum(`ct29_RCemento3`) as Ceniza, sum(`ct29_RAgua`) as Agua, sum(`ct29_RAgregado1`) as Agregado1, sum(`ct29_RAgregado2`) as Agregado2, sum(`ct29_RAgregado3`) as Agregado3,sum(`ct29_RAgregado4`) as Agregado4,  sum(`ct29_RAditivo1`) as Adictivo1, sum(`ct29_RAditivo2`) as Adictivo2,sum(`ct29_RAditivo3`) as Adictivo3 FROM ct29_batch WHERE `ct29_Remision` = :cod_remision  AND `ct29_IdPlanta` = :id_planta  ";
        $stmt = $con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':cod_remision', $data['cod_remision'], PDO::PARAM_INT); // Param
        $stmt->bindParam(':id_planta', $data['id_planta'], PDO::PARAM_STR); // Param
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['Cemento'] = $fila['Cemento'];
                    $datos['Agua'] = $fila['Agua'];
                    $datos['Ceniza'] = $fila['Ceniza'];
                    $datos['Agregado1'] = $fila['Agregado1'];
                    $datos['Agregado2'] = $fila['Agregado2'];
                    $datos['Agregado3'] = $fila['Agregado3'];
                    $datos['Agregado4'] = $fila['Agregado4'];
                    $datos['Adictivo1'] = $fila['Adictivo1'];
                    $datos['Adictivo2'] = $fila['Adictivo2'];
                    $datos['Adictivo3'] = $fila['Adictivo3'];
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function delete_programacion_por_muestra($id)
    {

        $sql = "DELETE FROM `ct68_programar_muestra` WHERE `id_muestra` = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            return true;
        } else {
            return false;
        }
    }

    function crear_param_muestra($datos_post)
    {
        $sql = "INSERT INTO `ct68_param_productos`(`id_producto`, `codigo_producto`, `descripcion_producto`, `id_periodo`, `nombre_periodo`, `num_fallos`) VALUES (:id_producto , :codigo_producto, :descripcion_producto, :id_periodo , :nombre_periodo, :num_fallos )";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_producto', $datos_post['id_producto'], PDO::PARAM_INT);
        $stmt->bindParam(':codigo_producto', $datos_post['codigo_producto'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion_producto', $datos_post['descripcion_producto'], PDO::PARAM_STR);
        $stmt->bindParam(':id_periodo', $datos_post['id_periodo'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre_periodo', $datos_post['nombre_periodo'], PDO::PARAM_STR);
        $stmt->bindParam(':num_fallos', $datos_post['num_fallos'], PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }

    function validar_param_muestra($datos_post)
    {
        $sql = "SELECT `id` FROM `ct68_param_productos` WHERE `id_producto` = :id_producto AND `id_periodo` = :id_periodo ";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_producto', $datos_post['id_producto'], PDO::PARAM_INT); // Param
        $stmt->bindParam(':id_periodo', $datos_post['periodo_fallo'], PDO::PARAM_INT); // Param
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function datatable_muestras_realizadas($sede = null)
    {
        if (is_null($sede)) {
            $sql = "SELECT ct68_programar_muestra.id,ct68_muestras.id as id_muestra, ct68_muestras.cod_remi, ct68_programar_muestra.fecha_programada, ct68_programar_muestra.id_periodo, ct68_programar_muestra.nombre_periodo, ct68_programar_muestra.numero_resultados, count(ct68_resultados_muestra.id) as muestras_ejecutadas , consecutivo_interno FROM `ct68_muestras`  LEFT  JOIN ct68_programar_muestra ON ct68_muestras.id = ct68_programar_muestra.id_muestra LEFT JOIN ct68_resultados_muestra ON ct68_muestras.id = ct68_resultados_muestra.id_muestra AND ct68_programar_muestra.id_periodo = ct68_resultados_muestra.id_periodo where  YEAR(ct68_muestras.fecha_muestra) = 2024 AND YEAR(ct68_muestras.fecha_muestra) = 2025  GROUP BY ct68_programar_muestra.id ";
            $stmt = $this->con->prepare($sql);  // Prepara la consulta

        } else {
            $sql = "SELECT ct68_programar_muestra.id,ct68_muestras.id as id_muestra, ct68_muestras.cod_remi, ct68_programar_muestra.fecha_programada, ct68_programar_muestra.id_periodo, ct68_programar_muestra.nombre_periodo, ct68_programar_muestra.numero_resultados, count(ct68_resultados_muestra.id) as muestras_ejecutadas , consecutivo_interno FROM `ct68_muestras`  LEFT  JOIN ct68_programar_muestra ON ct68_muestras.id = ct68_programar_muestra.id_muestra LEFT JOIN ct68_resultados_muestra ON ct68_muestras.id = ct68_resultados_muestra.id_muestra AND ct68_programar_muestra.id_periodo = ct68_resultados_muestra.id_periodo where YEAR(ct68_muestras.fecha_muestra) = 2024 AND YEAR(ct68_muestras.fecha_muestra) = 2025 AND ct68_muestras.sede = :sede GROUP BY ct68_programar_muestra.id   ";
            $stmt = $this->con->prepare($sql);  // Prepara la consulta
            $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
        }

        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['consecutivo_interno'] = $fila['consecutivo_interno'];
                    $datos['id_muestra'] = $fila['id_muestra'];
                    $datos['remision'] = $fila['cod_remi'];
                    $datos['fecha_programada'] = $fila['fecha_programada'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['muestras_programadas'] = $fila['numero_resultados'];
                    $datos['muestras_ejecutadas'] = $fila['muestras_ejecutadas'];
                    if ($datos['muestras_ejecutadas'] >=  $datos['muestras_programadas']) {
                        $datos['estatus'] = "COMPLETADO";
                        $datos['estatus'] = "<small class='badge badge-success'>COMPLETADO</small>";
                    } else {
                        $datos['estatus'] = "PENDIENTE";
                        $datos['estatus'] = "<small class='badge badge-warning'>PENDIENTE</small>";
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


    function validar_prog_muestra($datos_post)
    {
        $sql = "SELECT `id` FROM `ct68_programar_muestra` WHERE `id_muestra` = :id_muestra  AND `id_periodo` = :id_periodo";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT); // Param
        $stmt->bindParam(':id_periodo', $datos_post['nombre_periodo'], PDO::PARAM_INT); // Param
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function calcular_rendimientovolumetrico($datos_post)
    {
        //$datos_post['id_muestra'] = $datos_post['id_muestra'];
        $datos_post['peso_olla'] = doubleval($datos_post['peso_olla']);
        $datos_post['volumen_olla'] = doubleval($datos_post['volumen_olla']);

        if (!empty($datos_post['totalkg_registrocargue']) || $datos_post['totalkg_registrocargue'] > 0 || !empty($datos_post['pesoolla_mas_concreto']) || $datos_post['pesoolla_mas_concreto'] > 0) {
            $datos_post['totalkg_registrocargue'] = doubleval($datos_post['totalkg_registrocargue']);
            $datos_post['pesoolla_mas_concreto'] = doubleval($datos_post['pesoolla_mas_concreto']);
            $datos_post['rendvol_peso_neto'] = round(doubleval($datos_post['pesoolla_mas_concreto'] - $datos_post['peso_olla']), 3);
            $datos_post['rendvol_masaunitaria'] = round(doubleval($datos_post['rendvol_peso_neto'] / $datos_post['volumen_olla'] / 1000), 3);
            $datos_post['rendvol_volumenreal'] = round(doubleval($datos_post['totalkg_registrocargue'] / $datos_post['rendvol_masaunitaria']), 3);
            $datos_post['rend_volumetrico'] = round(doubleval($datos_post['rendvol_volumenreal'] / doubleval($datos_post['metroscubicos'])), 2);
        } else {
            $datos_post['totalkg_registrocargue'] = doubleval($datos_post['totalkg_registrocargue']);
            $datos_post['pesoolla_mas_concreto'] = doubleval($datos_post['pesoolla_mas_concreto']);
            $datos_post['rendvol_peso_neto'] = 0;
            $datos_post['rendvol_masaunitaria'] = 0;
            $datos_post['rendvol_volumenreal'] = 0;
            $datos_post['rend_volumetrico'] = 0;
        }

        return $datos_post;
    }

    function registrar_rend_volumetrico($datos_post)
    {
        $sql = "UPDATE `ct68_muestras` SET totalkg_registrocargue = :totalkg_registrocargue , pesoolla_mas_concreto = :pesoolla_mas_concreto ,rendvol_peso_neto  = :rendvol_peso_neto , rendvol_masaunitaria = :rendvol_masaunitaria , rendvol_volumenreal = :rendvol_volumenreal , rend_volumetrico = :rend_volumetrico  WHERE id = :id_muestra";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':totalkg_registrocargue', $datos_post['totalkg_registrocargue'], PDO::PARAM_STR);
        $stmt->bindParam(':pesoolla_mas_concreto', $datos_post['pesoolla_mas_concreto'], PDO::PARAM_STR);
        $stmt->bindParam(':rendvol_peso_neto', $datos_post['rendvol_peso_neto'], PDO::PARAM_STR);
        $stmt->bindParam(':rendvol_masaunitaria', $datos_post['rendvol_masaunitaria'], PDO::PARAM_STR);
        $stmt->bindParam(':rendvol_volumenreal', $datos_post['rendvol_volumenreal'], PDO::PARAM_STR);
        $stmt->bindParam(':rend_volumetrico', $datos_post['rend_volumetrico'], PDO::PARAM_STR);
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);

        if ($result = $stmt->execute()) {


            return true;
        } else {
            return false;
        }
    }

    function eliminar_manejeabilidad($id)
    {
        $sql = "DELETE FROM `ct68_manejeabilidad` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function datatable_manejeabilidad($id_muestra)
    {
        $sql = "SELECT `id`, `id_muestra`, `hora`, `asentamiento`, `temperatura` FROM `ct68_manejeabilidad` WHERE `id_muestra` = :id_muestra";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['hora'] = $fila['hora'];
                    $datos['asentamiento'] = $fila['asentamiento'];
                    $datos['temperatura'] = $fila['temperatura'];
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

    function registrar_manejeabilidad($datos_post)
    {
        $sql = "INSERT INTO `ct68_manejeabilidad`( `id_muestra`, `hora`, `asentamiento`, `temperatura`) VALUES (:id_muestra, :hora, :asentamiento, :temperatura)";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':hora', $datos_post['hora'], PDO::PARAM_STR);
        $stmt->bindParam(':asentamiento', $datos_post['asentamiento'], PDO::PARAM_STR);
        $stmt->bindParam(':temperatura', $datos_post['temperatura'], PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }

    function get_nombre_responsable($id)
    {
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $fila['ct1_RazonSocial'];
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado

    }

    function option_responsablemuestra($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Colaborado</option>";
        $option = "<option  value='externo' > Externo </option>";
        $sql = "SELECT * FROM ct1_terceros WHERE `ct1_rol` IN (10,11,9) AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['ct1_IdTerceros']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" ' . $selection . ' >' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    public function crear_muestra_ext($datos_post)
    {
        $sql = "INSERT INTO `ct68_muestras`(`fecha_muestra`, `hora_muestra`) VALUES (:fecha_muestra, :hora_muestra)";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':fecha_muestra', $datos_post['fecha_muestra'], PDO::PARAM_STR);
        $stmt->bindParam(':hora_muestra', $datos_post['hora_muestra'], PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }

    function alert_resultado_consolidado($id_muestra)
    {
        $sql = "SELECT `id`, `id_muestra`, `id_periodo`, `nombre_periodo`, `promediokgcm2`, `porcentaje` FROM `ct68_resultado_consolidado` WHERE `id_muestra` = :id_muestra AND `id_periodo` = 28";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $datos['porcentaje'] = (doubleval($fila['porcentaje']) * 100);
                    if ($datos['porcentaje'] <= 105) {
                        return "<H3 class='badge badge-danger' style='font-size:2em'> DEJAR TESTIGO A 56 DIAS </H3>";
                    } else {
                        return "";
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    function datatable_resultado_consolidado($id_muestra)
    {
        $sql = "SELECT `id`, `id_muestra`, `id_periodo`, `nombre_periodo`, `promediokgcm2`, `porcentaje` FROM `ct68_resultado_consolidado` WHERE `id_muestra` = :id_muestra ";

        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_muestra'] = $fila['id_muestra'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['promediokgcm2'] = $fila['promediokgcm2'];
                    $datos['porcentaje'] = (doubleval($fila['porcentaje']) * 100);
                    if ($datos['porcentaje'] <= 105) {
                        $datos['porcentaje'] = "<small class='badge badge-danger'> " . $datos['porcentaje'] . " % </small>";
                    } else {
                        $datos['porcentaje'] = "<small class='badge badge-success'> " . $datos['porcentaje'] . " % </small>";
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

    function crear_consolidado_resultados($datos_post)
    {
        if ($datos_post['promediokgcm2'] == null || $datos_post['porcentaje'] == 0) {
            $sql = "DELETE FROM `ct68_resultado_consolidado` WHERE `id_muestra` = :id_muestra AND `id_periodo` = :id_periodo";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);
            $stmt->bindParam(':id_periodo', $datos_post['id_periodo'], PDO::PARAM_INT);
            if ($stmt->execute()) { // Ejecuta la consulta
                return true;
            } else {
                return false;
            }
        }
        $sql = "INSERT INTO `ct68_resultado_consolidado`( `id_muestra`, `id_periodo`, `nombre_periodo`, `promediokgcm2`, `porcentaje`) VALUES (:id_muestra, :id_periodo, :nombre_periodo, :promediokgcm2, :porcentaje)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $datos_post['id_periodo'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre_periodo', $datos_post['nombre_peridofallo'], PDO::PARAM_STR);
        $stmt->bindParam(':promediokgcm2', $datos_post['promediokgcm2'], PDO::PARAM_STR);
        $stmt->bindParam(':porcentaje', $datos_post['porcentaje'], PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecuta la consulta
            return true;
        } else {
            return false;
        }
    }

    function eliminar_consolidado_resultados($datos_post)
    {
        $sql = "DELETE FROM `ct68_resultado_consolidado` WHERE `id_muestra` = :id_muestra and `id_periodo` =  :id_periodo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $datos_post['id_periodo'], PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecuta la consulta
            return true;
        } else {
            return false;
        }
    }




    function porcentaje_por_edad($promedio_kgcm2, $resistencia)
    {
        return doubleval($promedio_kgcm2) / doubleval($resistencia);
    }


    function promedio_kg_sobre_cm2($datos_post)
    {
        $sql = "SELECT AVG(`kgcm2`) as promedio_kgcm2 FROM `ct68_resultados_muestra` WHERE `id_muestra` = :id_muestra AND `id_periodo` = :id_periodo ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $datos_post['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $datos_post['id_periodo'], PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['promedio_kgcm2'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function get_resistencia_for_muestra($id_muestra)
    {
        $sql = "SELECT `resistencia` FROM `ct68_muestras` WHERE `id` = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id_muestra, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $fila['resistencia'];
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado

    }

    function get_diametro_probeta_for_muestra($id = null)
    {
        $sql = "SELECT diametro_probeta FROM `ct68_muestras` WHERE id = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $fila['diametro_probeta'];
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado

    }

    function kg_sobre_cm2_flexion($lecturakn)
    {
        $var = 101.971;
        $lecturakn = doubleval($lecturakn);

        $l = 45;
        $b = 15;
        $h  = 15.2;

        if ($lecturakn > 0) {
            $rst = ($lecturakn * $var * $l) / ($b * $h * $h);
            if ($rst) {
                return $rst;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function kg_sobre_cm2($lecturakn, $diametro_probeta)
    {
        $var = 101.971;
        $lecturakn = doubleval($lecturakn);
        $diametro_probeta = doubleval($diametro_probeta);

        if ($lecturakn > 0 && $diametro_probeta > 0) {
            $rst = ($lecturakn * $var) / ((pi() * ($diametro_probeta * $diametro_probeta)) / 4);
            if ($rst) {
                return $rst;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_diametro_probeta($id = null)
    {
        $sql = "SELECT * FROM `ct68_probeta` WHERE id = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $fila['diametro'];
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado

    }


    function option_probeta($id = null)
    {
        $option = "<option  selected='true' value=''> Seleccione un Probetas</option>";
        $sql = "SELECT * FROM `ct68_probeta` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    function datatable_resultado_muestra($id_muestra)
    {

        $sql = "SELECT `id`, `id_muestra`, `id_programado`, `fecha_programado`, `id_periodo`, `nombre_periodo`, `fecha_muestra`, `id_tipo_fallo`, `nombre_tipo_fallo`, `reultadokn`, `observaciones` FROM `ct68_resultados_muestra` WHERE `id_muestra` = :id_muestra";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_programado'] = $fila['id_programado'];
                    $datos['fecha_programado'] = $fila['fecha_programado'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['fecha_muestra'] = $fila['fecha_muestra'];
                    $datos['id_tipo_fallo'] = $fila['id_tipo_fallo'];
                    $datos['nombre_tipo_fallo'] = $fila['nombre_tipo_fallo'];
                    $datos['reultadokn'] = $fila['reultadokn'];
                    $datos['observaciones'] = $fila['observaciones'];

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


    function delete_resultado_muestra($id)
    {

        $sql = "DELETE FROM `ct68_resultados_muestra` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            return true;
        } else {
            return false;
        }
    }



    function delete_param_muestra($id)
    {

        $sql = "DELETE FROM `ct68_param_productos` WHERE `id`  = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            return true;
        } else {
            return false;
        }
    }
    function delete_programacion($id)
    {

        $sql = "DELETE FROM `ct68_programar_muestra` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            return true;
        } else {
            return false;
        }
    }


    function option_producto_edit_buscador($id_producto = null)
    {
        $id = $id_producto;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $option = "<option  value='0'>TODOS</option>";
        $sql = "SELECT ct4_Id_productos , ct4_CodigoSyscafe , ct4_Descripcion FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['ct4_Id_productos']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' . $selection . ' >' . $fila['ct4_CodigoSyscafe']  . ' - ' . $fila['ct4_Descripcion']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H2" . $num_reg . "</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H1</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }


    function datatable_param_productos($id_producto)
    {

        if (intval($id_producto) > 0) {
            $sql = "SELECT `id`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_periodo`, `nombre_periodo`, `num_fallos` FROM `ct68_param_productos` WHERE `id_producto` = $id_producto";
        } else {
            $sql = "SELECT `id`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_periodo`, `nombre_periodo`, `num_fallos` FROM `ct68_param_productos`";
        }
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_producto'] = $fila['id_producto'];
                    $datos['codigo_producto'] = $fila['codigo_producto'];
                    $datos['descripcion_producto'] = $fila['descripcion_producto'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['num_fallos'] = $fila['num_fallos'];
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


    function cargar_datos_param_producto($id_producto)
    {

        $sql = "SELECT `id`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_periodo`, `nombre_periodo`, `num_fallos` FROM `ct68_param_productos` WHERE `id_producto` = :id_producto";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_producto'] = $fila['id_producto'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['num_fallos'] = $fila['num_fallos'];



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

    function datatable_programacion($id_muestra)
    {

        $sql = "SELECT `id`, `id_muestra`, `id_producto`, `id_periodo`, `nombre_periodo`, `fecha_programada`, `numero_resultados` FROM `ct68_programar_muestra` WHERE `id_muestra` = :id_muestra";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_producto'] = $fila['id_producto'];
                    $datos['id_periodo'] = $fila['id_periodo'];
                    $datos['nombre_periodo'] = $fila['nombre_periodo'];
                    $datos['fecha_programada'] = $fila['fecha_programada'];
                    $datos['numerocilindros'] = $fila['numero_resultados'];


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


    function datatable_resumen_prog($id_muestra)
    {

        $sql = "SELECT id, fecha_programada, SUM(CASE WHEN `id_periodo` = '1'  THEN `numero_resultados` ELSE 0 END) as 'dia1', SUM(CASE WHEN `id_periodo` = '3'  THEN `numero_resultados` ELSE 0 END) as 'dia3', SUM(CASE WHEN `id_periodo` = '7'  THEN `numero_resultados` ELSE 0 END) as 'dia7', SUM(CASE WHEN `id_periodo` = '14'  THEN `numero_resultados` ELSE 0 END) as 'dia14', SUM(CASE WHEN `id_periodo` = '28'  THEN `numero_resultados` ELSE 0 END) as 'dia28', SUM(CASE WHEN `id_periodo` = '56'  THEN `numero_resultados` ELSE 0 END) as 'dia56' FROM `ct68_programar_muestra` WHERE `id_muestra` = :id_muestra GROUP by `id_periodo`,fecha_programada  ORDER BY `ct68_programar_muestra`.`fecha_programada` DESC";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha_programada'] = $fila['fecha_programada'];
                    if ($fila['dia1'] > 0) {
                        $datos['dia1'] = "<h1 class='badge badge-primary' style='font-size:1em' >" . $fila['dia1'] . "</h1>";
                    } else {
                        $datos['dia1'] = $fila['dia1'];
                    }

                    if ($fila['dia3'] > 0) {
                        $datos['dia3'] = "<h2 class='badge badge-primary' style='font-size:1em' >" . $fila['dia3'] . "</h2>";
                    } else {
                        $datos['dia3'] = $fila['dia3'];
                    }

                    if ($fila['dia7'] > 0) {
                        $datos['dia7'] = "<small class='badge badge-primary' style='font-size:1em' >" . $fila['dia7'] . "</small>";
                    } else {
                        $datos['dia7'] = $fila['dia7'];
                    }

                    if ($fila['dia14'] > 0) {
                        $datos['dia14'] = "<small class='badge badge-primary' style='font-size:1em' >" . $fila['dia14'] . "</small>";
                    } else {
                        $datos['dia14'] = $fila['dia14'];
                    }

                    if ($fila['dia28'] > 0) {
                        $datos['dia28'] = "<small class='badge badge-primary' style='font-size:1em' >" . $fila['dia28'] . "</small>";
                    } else {
                        $datos['dia28'] = $fila['dia28'];
                    }

                    if ($fila['dia56'] > 0) {
                        $datos['dia56'] = "<small class='badge badge-primary' style='font-size:1em' >" . $fila['dia56'] . "</small>";
                    } else {
                        $datos['dia56'] = $fila['dia56'];
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

    function get_data_muestra1($id)
    {

        $sql = "SELECT `id_producto`,`fecha_muestra` FROM `ct68_muestras` WHERE  id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos['id_producto'] =  $fila['id_producto'];
                $datos['fecha_muestra'] =  $fila['fecha_muestra'];
            }
            return $datos;
        } else {
            return false;
        }
    }

    function get_nombre_periodo_fallo($id)
    {

        $sql = "SELECT `id`, `descripcion` FROM `ct68_periodo_fallos` WHERE id = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                return $fila['descripcion'];
            }
        } else {
            return false;
        }
    }

    function registrar_resultados_muestras($datos)
    {
        $sql = "INSERT INTO `ct68_resultados_muestra`(`id_muestra`, `id_programado`, `fecha_programado`, `id_periodo`, `nombre_periodo`, `fecha_muestra`, `id_tipo_fallo`, `nombre_tipo_fallo`,sub_tipo_fallo, `reultadokn`, kgcm2 ,`observaciones`, `porcentaje_indv` ) VALUES (:id_muestra, :id_programado, :fecha_programado, :id_periodo, :nombre_periodo, :fecha_muestra, :id_tipo_fallo, :nombre_tipo_fallo, :sub_tipo_fallo, :reultadokn, :kgcm2, :observaciones, :porcentaje_indv)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $datos['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':id_programado', $datos['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_programado', $datos['fecha_resultado'], PDO::PARAM_STR);
        $stmt->bindParam(':id_periodo', $datos['id_periodo'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre_periodo', $datos['nombre_peridofallo'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_muestra', $datos['fecha_resultado'], PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_fallo', $datos['id_tipo_fallo'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_fallo', $datos['id_tipo_fallo'], PDO::PARAM_STR);
        $stmt->bindParam(':sub_tipo_fallo', $datos['subtipo_fallo'], PDO::PARAM_INT);
        $stmt->bindParam(':reultadokn', $datos['resultadokn'], PDO::PARAM_STR);
        $stmt->bindParam(':kgcm2', $datos['kgcm2'], PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $datos['observacion'], PDO::PARAM_STR);
        $stmt->bindParam(':porcentaje_indv', $datos['porcentaje_indv'], PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }


    function registrar_programacion_resultados_muestras($datos_programacion)
    {
        $sql = "INSERT INTO `ct68_programar_muestra`(`id_muestra`, id_producto, `id_periodo`, `nombre_periodo`, `fecha_programada`, `numero_resultados`) VALUES (:id_muestra,:id_producto, :id_periodo, :nombre_periodo, :fecha_programada, :numero_resultados)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $datos_programacion['id_muestra'], PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $datos_programacion['id_producto'], PDO::PARAM_INT);
        $stmt->bindParam(':id_periodo', $datos_programacion['periodo_fallo'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre_periodo', $datos_programacion['nombre_peridofallo'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_programada', $datos_programacion['fecha_programada'], PDO::PARAM_STR);
        $stmt->bindParam(':numero_resultados', $datos_programacion['num_cilindros'], PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }

    function option_tipo_fallo($id = null)
    {
        $option = "<option  selected='true' value=''> Seleccione un fallo</option>";
        $sql = "SELECT `id`,sigla_tipo_fallo, `descripcion` FROM `ct68_tipo_fallo`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
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


    function option_periodos($id = null)
    {
        $option = "<option  selected='true' value=''> Seleccione un periodo</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct68_periodo_fallos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
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

    function option_sede($sede = null)
    {
        $option = "<option  selected='true' value=''> Seleccione</option>";


        $option .= '<option value="RMI">MIROLINDO </option>';
        $option .= '<option value="RMT">TORREON </option>';
        $option .= '<option value="HND">HONDA </option>';

        if (!is_null($sede)) {
            switch ($sede) {
                case 'RMI':
                    $nombre_sede = "MIROLINDO";
                    break;
                case 'RMT':
                    $nombre_sede = "TORREON";
                    break;

                case 'HND':
                    $nombre_sede = "HONDA";
                    break;

                default:
                    # code...
                    break;
            }
            $option .= '<option value="' . $sede . '" selected="true"  >' . $nombre_sede . ' </option>';
        }

        return $option;
    }

    function option_cementantes($id = null)
    {
        $option = "<option  selected='true' value=''> Seleccione</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct68_cementantes`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
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

    public function actualizar_muestra_for_producto($id_muestra, $array_datos)
    {
        $sql = "UPDATE `ct68_muestras` SET id_producto = :id_producto ,codigo_producto = :codigo_producto, descripcion_producto = :descripcion_producto  WHERE `id` = :id ";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta

        $stmt->bindParam(':id_producto', $array_datos['id_producto'], PDO::PARAM_STR);
        $stmt->bindParam(':codigo_producto', $array_datos['codigo_producto'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion_producto', $array_datos['descripcion_producto'], PDO::PARAM_STR);

        $stmt->bindParam(':id', $id_muestra, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function actualizar_muestra2($id, $array_datos)
    {
        $sql = "UPDATE `ct68_muestras` SET fecha_muestra = :fecha_muestra ,hora_muestra = :hora_muestra, asentamiento = :asentamiento, temperatura = :temperatura, consecutivo_interno = :consecutivo_interno, sede = :sede   WHERE `id` = :id ";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta

        $stmt->bindParam(':fecha_muestra', $array_datos['fecha_muestra'], PDO::PARAM_STR);
        $stmt->bindParam(':hora_muestra', $array_datos['hora_muestra'], PDO::PARAM_STR);
        $stmt->bindParam(':asentamiento', $array_datos['asentamiento'], PDO::PARAM_STR);
        $stmt->bindParam(':temperatura', $array_datos['temperatura'], PDO::PARAM_STR);
        $stmt->bindParam(
            ':consecutivo_interno',
            $array_datos['consecutivo_interno'],
            PDO::PARAM_STR
        );
        $stmt->bindParam(':sede', $array_datos['sede'], PDO::PARAM_STR);



        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar_muestra($id, $array_datos)
    {
        $sql = "UPDATE `ct68_muestras` SET `id_nombre_cementante`= :id_nombre_cementante,`nombre_cementante`= :nombre_cementante,`cementante_kg`= :cementante_kg,`aire`= :aire, ceniza = :ceniza, resistencia = :resistencia, id_probeta = :id_probeta,  diametro_probeta = :diametro_probeta ,id_responsable = :id_responsable, nombre_responsable = :nombre_responsable , observaciones = :observaciones, consecutivo_interno = :consecutivo_interno  WHERE `id` = :id ";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id_nombre_cementante', $array_datos['tipocementante'], PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cementante', $array_datos['cementante'], PDO::PARAM_STR);
        $stmt->bindParam(':cementante_kg', $array_datos['cementante'], PDO::PARAM_STR);
        //$stmt->bindParam(':asentamiento', $array_datos['asentamiento'], PDO::PARAM_STR);
        //$stmt->bindParam(':temperatura', $array_datos['temperatura'], PDO::PARAM_STR);
        $stmt->bindParam(':aire', $array_datos['aire'], PDO::PARAM_STR);
        //$stmt->bindParam(':rend_volumetrico', $array_datos['rendvolumetrico'], PDO::PARAM_STR);
        $stmt->bindParam(':ceniza', $array_datos['ceniza'], PDO::PARAM_STR);
        $stmt->bindParam(':resistencia', $array_datos['resistencia'], PDO::PARAM_STR);
        $stmt->bindParam(':id_probeta', $array_datos['id_probeta'], PDO::PARAM_STR);
        $stmt->bindParam(':diametro_probeta', $array_datos['diametro_probeta'], PDO::PARAM_STR);
        $stmt->bindParam(':id_responsable', $array_datos['id_responsable'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre_responsable', $array_datos['nombre_responsable'], PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $array_datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(':consecutivo_interno', $array_datos['consecutivo_interno'], PDO::PARAM_STR);

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function datatable_reg_muestras($sede = null)
{
    $whereClause = "";
    $params = [];
    
    

    if (!is_null($sede)) {
        $whereClause = " AND ct68_muestras.sede = :sede";
        $params[':sede'] = $sede;
    }

    // Corrección importante: agrupar OR con paréntesis para evitar lógica incorrecta
    $sql = "
        SELECT 
            ct68_muestras.fecha_muestra,
            ct68_muestras.id,
            ct68_muestras.consecutivo_interno,
            ct68_muestras.cod_remi,
            ct68_resultado_consolidado.nombre_periodo,
            ct68_resultado_consolidado.promediokgcm2,
            ct68_resultado_consolidado.porcentaje
        FROM ct68_muestras
        LEFT JOIN ct68_resultado_consolidado 
            ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra
        
        WHERE ct68_muestras.fecha_muestra >= DATE_SUB(CURDATE(), INTERVAL 90 DAY)
        $whereClause
        ORDER BY ct68_muestras.fecha_muestra DESC
        LIMIT 2500
    ";

    $stmt = $this->con->prepare($sql);

    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value, PDO::PARAM_STR);
    }

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            $datosf = [];

            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $porcentaje = doubleval($fila['porcentaje']) * 100;
                $badge = $porcentaje <= 105 
                    ? "<small class='badge badge-danger'>{$porcentaje} %</small>" 
                    : "<small class='badge badge-success'>{$porcentaje} %</small>";

                $datosf[] = [
                    'id' => $fila['id'],
                    'fecha_muestra' => $fila['fecha_muestra'],
                    'consecutivo_interno' => $fila['consecutivo_interno'],
                    'cod_remi' => $fila['cod_remi'],
                    'periodo' => $fila['nombre_periodo'],
                    'promediokgcm2' => $fila['promediokgcm2'],
                    'porcentaje' => $badge,
                ];
            }

            return $datosf;
        }
    }

    return false;
}


    public function datatable_reg_muestras2($sede = null)
    {
        //  `id`, `fecha_muestra`, `hora_muestra`, `id_remision`, `cod_remi`, `id_cliente`, `cliente`, `id_obra`, `obra`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_mixer`, `placa`
        if (is_null($sede)) {
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` ";
            $sql = "SELECT ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra where YEAR(ct68_muestras.fecha_muestra) = 2024 OR YEAR(ct68_muestras.fecha_muestra) = 2025  ORDER BY `ct68_muestras`.`fecha_muestra` DESC LIMIT 2500";
            $stmt = $this->con->prepare($sql);  // Prepara la consulta

        } else if ($sede == "RMI"){
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` where sede = :sede  ";
            $sql = "SELECT ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra WHERE sede = 'RMI' AND YEAR(ct68_muestras.fecha_muestra) = 2024 OR YEAR(ct68_muestras.fecha_muestra) = 2025 ORDER BY `ct68_muestras`.`fecha_muestra` DESC LIMIT 2500";

            $stmt = $this->con->prepare($sql);  // Prepara la consulta
           // $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
           
           
        }
        else if ($sede == "HND"){
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` where sede = :sede  ";
            $sql = "SELECT ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra WHERE sede = 'HND' AND YEAR(ct68_muestras.fecha_muestra) = 2024 OR YEAR(ct68_muestras.fecha_muestra) = 2025 ORDER BY `ct68_muestras`.`fecha_muestra` DESC LIMIT 2500";

            $stmt = $this->con->prepare($sql);  // Prepara la consulta
           // $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
          
        }
        else if ($sede == "RMT"){
            //$sql = "SELECT ct68_muestras.*, (SELECT ct68_resultado_consolidado.nombre_periodo as peridodo FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as id_periodo, (SELECT ct68_resultado_consolidado.promediokgcm2 as promediokgcm2 FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as promediokgcm2,(SELECT ct68_resultado_consolidado.porcentaje as porcentaje FROM ct68_resultado_consolidado WHERE ct68_resultado_consolidado.id_muestra = ct68_muestras.id ORDER BY `ct68_resultado_consolidado`.`id_periodo` DESC LIMIT 1) as porcentaje FROM `ct68_muestras` where sede = :sede  ";
            $sql = "SELECT ct68_muestras.fecha_muestra,ct68_muestras.id, ct68_muestras.consecutivo_interno,ct68_muestras.cod_remi, ct68_resultado_consolidado.nombre_periodo,ct68_resultado_consolidado.promediokgcm2, ct68_resultado_consolidado.porcentaje FROM `ct68_muestras` LEFT  JOIN ct68_resultado_consolidado ON ct68_muestras.id = ct68_resultado_consolidado.id_muestra WHERE sede = 'RMT' AND YEAR(ct68_muestras.fecha_muestra) = 2024 OR YEAR(ct68_muestras.fecha_muestra) = 2025 ORDER BY `ct68_muestras`.`fecha_muestra` DESC LIMIT 2500";

            $stmt = $this->con->prepare($sql);  // Prepara la consulta
           // $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
           
        }
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha_muestra'] = $fila['fecha_muestra'];
                    $datos['consecutivo_interno'] = $fila['consecutivo_interno'];
                    $datos['cod_remi'] = $fila['cod_remi'];
                    $datos['periodo'] = $fila['nombre_periodo'];
                    $datos['promediokgcm2'] = $fila['promediokgcm2'];

                    $datos['porcentaje'] = (doubleval($fila['porcentaje']) * 100);
                    if ($datos['porcentaje'] <= 105) {
                        $datos['porcentaje'] = "<small class='badge badge-danger'> " . $datos['porcentaje'] . " % </small>";
                    } else {
                        $datos['porcentaje'] = "<small class='badge badge-success'> " . $datos['porcentaje'] . " % </small>";
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

    public function get_data_muestras_for_id($id)
    {
        //  `id`, `fecha_muestra`, `hora_muestra`, `id_remision`, `cod_remi`, `id_cliente`, `cliente`, `id_obra`, `obra`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_mixer`, `placa`
        $sql = "SELECT * FROM `ct68_muestras` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha_muestra'] = $fila['fecha_muestra'];
                    $datos['hora_muestra'] = $fila['hora_muestra'];
                    $datos['id_remision'] = $fila['id_remision'];
                    $datos['cod_remi'] = $fila['cod_remi'];
                    $datos['id_cliente'] = $fila['id_cliente'];
                    $datos['cliente'] = $fila['cliente'];
                    $datos['id_obra'] = $fila['id_obra'];
                    $datos['obra'] = $fila['obra'];
                    $datos['id_producto'] = $fila['id_producto'];
                    $datos['codigo_producto'] = $fila['codigo_producto'];
                    $datos['descripcion_producto'] = $fila['descripcion_producto'];
                    $datos['metros_cubicos'] = $fila['metros_cubicos'];
                    $datos['id_mixer'] = $fila['id_mixer'];
                    $datos['placa'] = $fila['placa'];
                    $datos['id_nombre_cementante'] = $fila['id_nombre_cementante'];
                    $datos['nombre_cementante'] = $fila['nombre_cementante'];
                    $datos['cementante_kg'] = $fila['cementante_kg'];
                    $datos['asentamiento'] = $fila['asentamiento'];
                    $datos['temperatura'] = $fila['temperatura'];
                    $datos['aire'] = $fila['aire'];
                    $datos['rend_volumetrico'] = $fila['rend_volumetrico'];
                    $datos['diametro_probeta'] = $fila['diametro_probeta'];
                    $datos['id_probeta'] = $fila['id_probeta'];
                    $datos['resistencia'] = $fila['resistencia'];
                    $datos['ceniza'] = $fila['ceniza'];
                    $datos['id_responsable'] = $fila['id_responsable'];
                    $datos['nombre_responsable'] = $fila['nombre_responsable'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datos['consecutivo_interno'] = $fila['consecutivo_interno'];
                    $datos['sede'] = $fila['sede'];
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function crear_muestra($fecha_muestra, $hora_muestra, $id_remision, $cod_remi, $id_cliente, $cliente, $id_obra, $obra, $id_producto, $codigo_producto, $descripcion_producto, $id_mixer, $placa, $metros, $asentamiento, $temperatura, $sede)
    {
        $sql = "INSERT INTO `ct68_muestras`(`fecha_muestra`, `hora_muestra`, `id_remision`, `cod_remi`, `id_cliente`, `cliente`, `id_obra`, `obra`, `id_producto`, `codigo_producto`, `descripcion_producto`, `id_mixer`, `placa`, metros_cubicos,asentamiento, temperatura,sede) VALUES (:fecha_muestra, :hora_muestra, :id_remision, :cod_remi, :id_cliente,:cliente, :id_obra, :obra, :id_producto, :codigo_producto, :descripcion_producto, :id_mixer, :placa, :metros_cubicos, :asentamiento ,:temperatura, :sede)";
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':fecha_muestra', $fecha_muestra, PDO::PARAM_STR);
        $stmt->bindParam(':hora_muestra', $hora_muestra, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);
        $stmt->bindParam(':cod_remi', $cod_remi, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':cliente', $cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':obra', $obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion_producto', $descripcion_producto, PDO::PARAM_STR);
        $stmt->bindParam(':id_mixer', $id_mixer, PDO::PARAM_INT);
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
        $stmt->bindParam(':metros_cubicos', $metros, PDO::PARAM_STR);
        $stmt->bindParam(':asentamiento', $asentamiento, PDO::PARAM_STR);
        $stmt->bindParam(':temperatura', $temperatura, PDO::PARAM_STR);
        $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {


            $id =  $this->con->lastInsertId(); // Devuelve el Id
            return $id;
        } else {
            return false;
        }
    }


    public static function validar_muestra($con, $id_muestra)
    {
        $sql = "SELECT `id` FROM `ct68_muestras` WHERE `id_remision` = :id";
        $stmt = $con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id_muestra, PDO::PARAM_INT); // Param
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }


    public  function get_data_producto($id_producto)
    {
        $sql = "SELECT `ct4_Id_productos`, `ct4_FechaCreacion`, `ct4_EstadoProducto`, `ct4_CodigoSyscafe`, `ct4_TipoConcreto`, `ct4_Resistencia`, `ct4_TamanoMAgregado`, `ct4_CaracteristicaConcreto`, `ct4_Color`, `ct4_Nombre`, `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id"; // SQL
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id_producto, PDO::PARAM_INT); // Param
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_producto'] = $fila['ct4_Id_productos'];
                    $datos['codigo_producto'] = $fila['ct4_Nombre'];
                    $datos['descripcion_producto'] = $fila['ct4_Descripcion'];
                    return $datos;
                }
            } else {
                return false;
            }
        }
    }


    public static function get_data_remi($con, $id_remi)
    {
        $sql = "SELECT `ct26_id_remision`,`ct26_estado`,`ct26_idplanta`,`ct26_codigo_remi`,`ct26_hora_remi`,`ct26_imagen_remi`,`ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`,`ct26_metros`,`ct26_id_producto`,`ct26_codigo_producto`,`ct26_descripcion_producto`,`ct26_fecha_remi`,`ct26_id_vehiculo`,`ct26_vehiculo` FROM `ct26_remisiones` WHERE ct26_id_remision = :id"; // SQL
        $stmt = $con->prepare($sql);  // Prepara la consulta
        $stmt->bindParam(':id', $id_remi, PDO::PARAM_INT); // Param
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            //$id =  $con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct26_id_remision'];
                    $datos['fecha'] = $fila['ct26_fecha_remi'];
                    $datos['linea'] = $fila['ct26_idplanta'];
                    $datos['hora_cargue'] = $fila['ct26_hora_remi'];
                    $datos['remision'] = $fila['ct26_codigo_remi'];
                    $datos['id_cliente'] = $fila['ct26_idcliente'];
                    $datos['cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['obra'] = $fila['ct26_nombre_obra'];
                    $datos['mixer'] = $fila['ct26_vehiculo'];
                    $datos['id_producto'] = $fila['ct26_id_producto'];
                    $datos['cod_producto'] = $fila['ct26_codigo_producto'];
                    $datos['descripcion_producto'] = $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros'];
                    $datos['id_vehiculo'] = $fila['ct26_id_vehiculo'];
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function tabla_remisiones($fecha = null, $remision = null, $planta = null)
    {
        $sql = "SELECT `ct26_id_remision`,`ct26_estado`,`ct26_idplanta`,`ct26_codigo_remi`,`ct26_hora_remi`,`ct26_imagen_remi`,`ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`,`ct26_metros`,`ct26_id_producto`,`ct26_codigo_producto`,`ct26_descripcion_producto`,`ct26_fecha_remi`,`ct26_id_vehiculo`,`ct26_vehiculo` FROM `ct26_remisiones` WHERE `ct26_fecha_remi` LIKE '%" . $fecha . "%' AND `ct26_codigo_remi` LIKE '%" . $remision . "%' AND `ct26_idplanta` LIKE '%" . $planta . "%'  ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC LIMIT 100"; // SQL
        $stmt = $this->con->prepare($sql);  // Prepara la consulta
        //$stmt->bindParam(':id', $id, PDO::PARAM_INT); // Param
        // Ejecutar 
        if ($stmt->execute()) { // Ejecuta la consulta
            $id =  $this->con->lastInsertId(); // Devuelve el Id
            if (($stmt->rowCount()) > 0) { // numero de registros de la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct26_id_remision'];
                    $datos['fecha'] = $fila['ct26_fecha_remi'];
                    $datos['linea'] = $fila['ct26_idplanta'];
                    $datos['hora_cargue'] = $fila['ct26_hora_remi'];
                    $datos['remision'] = $fila['ct26_codigo_remi'];
                    $datos['cliente'] = $fila['ct26_razon_social'];
                    $datos['obra'] = $fila['ct26_nombre_obra'];
                    $datos['mixer'] = $fila['ct26_vehiculo'];
                    $datos['producto'] = $fila['ct26_codigo_producto'] . " - " . $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros'];
                    $datos['fecha_actual'] = date("Y-m-d");
                    $datos['hora_actual'] = date("H:i");
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
}
