<?php


class tiempo_remi extends conexionPDO
{
    protected $PDO;
    public $con;
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }

    public static function insertar_identificacion_conductor($con,$id_remision,$numero_identificacion)
    {
        $sql ="UPDATE `ct26_remisiones` SET `ct26_identificacion_conductor`= :num_identificacion WHERE `ct26_id_remision` = :id_remision";
        $stmt = $con->prepare($sql); // Preparar la conexion
        // Insertar Parametros
        $stmt->bindParam(':num_identificacion', $numero_identificacion, PDO::PARAM_INT); 
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT); 
        if ($stmt->execute()) // Ejecutar
        {
            return true;
        }else{
            return false;
        }
    }

    public static function buscar_conductor($con,$id_conductor)
    {
        $id_conductor = intval($id_conductor);
        $sql = "SELECT `ct1_NumeroIdentificacion` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_conductor";
        $stmt = $con->prepare($sql); // Preparar la conexion
        // Insertar Parametros
        $stmt->bindParam(':id_conductor', $id_conductor, PDO::PARAM_INT); 
        if ($stmt->execute()) // Ejecutar
        {
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros  
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return   intval($fila['ct1_NumeroIdentificacion']);
            }
        }else{
            return false;
        }
    }


    public function actualizar_conductor($fecha_ini,$fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT ct26_id_remision,ct26_conductor FROM `ct26_remisiones` WHERE `ct26_fecha_remi` BETWEEN :fecha_ini AND :fecha_fin ";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        if ($stmt->execute()) // Ejecutar el SQL
        {
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros  
            if ($num_reg > 0) { // Validamos Si hay Mas de 1 Registro

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $id_remision = intval($fila['ct26_id_remision']); // Id de la remision
                    $id_conductor = intval($fila['ct26_conductor']); // Id del Conductor

                    $numero_identificacion = SELF::buscar_conductor($this->con,$id_conductor);
                    if($numero_identificacion){
                        $resultado[] = SELF::insertar_identificacion_conductor($this->con,$id_remision,$numero_identificacion);
                    }

                    
                }
                return $resultado;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function get_horas_remi($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT `ct26_id_remision`,`ct26_codigo_remi`,`ct26_idObra`,ct26_hora_remi,`ct26_hora_salida_planta`,`ct26_hora_llegada_obra`,`ct26_hora_inicio_descargue`,`ct26_hora_terminada_descargue`,`ct26_hora_llegada_planta`, `tiempo_pedido`, `tiempo_planta`, `tiempo_ida`, `tiempo_vuelta`, `tiempo_transporte`, `tiempo_obra`, `tiempo_espera_obra`, `tiempo_descargue_obra` FROM `ct26_remisiones` WHERE `ct26_fecha_remi` BETWEEN :fecha_ini AND :fecha_fin  ";

        $stmt = $this->con->prepare($sql); // Preparar la conexion

        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);


        if ($stmt->execute()) // Ejecutar
        {
            $num_reg_remi =  $stmt->rowCount(); // Get Numero de Registros  
            if ($num_reg_remi > 0) {
                //inicio del ciclo
                while ($fila_remi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos_remi['id_remision'] = intval($fila_remi['ct26_id_remision']);
                    $datos_remi['id_obra'] = intval($fila_remi['ct26_idObra']);
                    $datos_remi['hora_cargue'] = $fila_remi['ct26_hora_remi'];
                    $datos_remi['hora_salida_planta'] = $fila_remi['ct26_hora_salida_planta'];
                    $datos_remi['hora_llegada_obra'] = $fila_remi['ct26_hora_llegada_obra'];
                    $datos_remi['hora_inicio_descargue'] = $fila_remi['ct26_hora_inicio_descargue'];
                    $datos_remi['hora_terminada_descargue'] = $fila_remi['ct26_hora_terminada_descargue'];
                    $datos_remi['hora_llegada_planta'] = $fila_remi['ct26_hora_llegada_planta'];
                    $datos_remi['tiempo_pedido_remi'] = $fila_remi['tiempo_pedido'];
                    $datos_remi['tiempo_planta_remi'] = $fila_remi['tiempo_planta'];
                    $datos_remi['tiempo_ida'] = $fila_remi['tiempo_ida'];
                    $datos_remi['tiempo_vuelta'] = $fila_remi['tiempo_vuelta'];
                    $datos_remi['tiempo_transporte'] = $fila_remi['tiempo_transporte'];
                    $datos_remi['tiempo_espera_obra'] = $fila_remi['tiempo_espera_obra'];
                    $datos_remi['tiempo_descargue_obra'] = $fila_remi['tiempo_descargue_obra'];

                    $datos[] = $datos_remi;
                }
                //Fin del Ciclo
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_tiempo_obra($id_obra)
    {

        $sql_obra = "SELECT tiempo_promedio_pedido,tiempo_promedio_planta, tiempo_promedio_ida,tiempo_promedio_vuelta,tiempo_promedio_transporte, tiempo_promedio_obra, tiempo_promedio_espera_obra , tiempo_promedio_descargue_obra  FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        $stmt_obra = $this->con->prepare($sql_obra); // Preparar la conexion
        $stmt_obra->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
        if ($stmt_obra->execute()) {
            $num_reg_obra =  $stmt_obra->rowCount(); // Get Numero de Registros  
            if ($num_reg_obra > 0) {

                while ($fila_obra = $stmt_obra->fetch(PDO::FETCH_ASSOC)) {
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_pedido'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_planta'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_ida'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_vuelta'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_transporte'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_obra'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_espera_obra'];
                    $tiempo_promedio[] = $fila_obra['tiempo_promedio_descargue_obra'];
                }
                return $tiempo_promedio;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actualizar_horas_remi($datos_remi)
    {
        foreach ($datos_remi as $key) {

            $array_horas = NULL;
            $tiempo_vuelta = NULL;
            $tiempo_ida = NULL;

            // Tiempo de pedido
            if (!is_null($key['hora_cargue']) && !is_null($key['hora_llegada_planta'])) {
                $hora_pedido = SELF::diferencia_horas($key['hora_llegada_planta'], $key['hora_cargue']);
            } else {
                $hora_pedido = NULL;
            }

            // Tiempo en Planta
            if (!is_null($key['hora_salida_planta']) && !is_null($key['hora_cargue'])) {
                $tiempo_planta = SELF::diferencia_horas($key['hora_salida_planta'], $key['hora_cargue']);
            } else {
                $tiempo_planta = NULL;
            }

            // Tiempo ida
            if (!is_null($key['hora_llegada_obra']) && !is_null($key['hora_salida_planta'])) {
                $tiempo_ida =  SELF::diferencia_horas($key['hora_llegada_obra'], $key['hora_salida_planta']);
            } else {
                $tiempo_ida = NULL;
            }

            // Tiempo Vuelta
            if (!is_null($key['hora_llegada_planta']) && !is_null($key['hora_terminada_descargue'])) {
                $tiempo_vuelta = SELF::diferencia_horas($key['hora_llegada_planta'], $key['hora_terminada_descargue']);
            } else {
                $tiempo_vuelta = NULL;
            }

            // Tiempo Transporte
            if (!is_null($tiempo_vuelta) && !is_null($tiempo_ida)) {
                $array_horas = array($tiempo_ida, $tiempo_vuelta);
                $tiempo_transporte = SELF::suma_horas($array_horas);
            } else {
                $tiempo_transporte = NULL;
            }

            // Tiempo en Obra
            if (!is_null($key['hora_terminada_descargue']) && !is_null($key['hora_inicio_descargue'])) {
                $tiempo_obra =  SELF::diferencia_horas($key['hora_terminada_descargue'], $key['hora_inicio_descargue']);
            } else {
                $tiempo_obra = NULL;
            }
            // Tiempo de Espera en Obra
            if (!is_null($key['hora_llegada_obra']) && !is_null($key['hora_inicio_descargue'])) {
                $tiempo_espera_obra =  SELF::diferencia_horas($key['hora_llegada_obra'], $key['hora_inicio_descargue']);
            } else {
                $tiempo_espera_obra = NULL;
            }
            // tiempo de Descargue en Obra
            if (!is_null($key['hora_inicio_descargue']) && !is_null($key['hora_terminada_descargue'])) {
                $tiempo_descargue_obra = SELF::diferencia_horas($key['hora_terminada_descargue'], $key['hora_inicio_descargue']);
            } else {
                $tiempo_descargue_obra = NULL;
            }
            // 

            $sql = "UPDATE `ct26_remisiones` SET tiempo_pedido = :tiempo_pedido, tiempo_planta = :tiempo_planta, tiempo_ida = :tiempo_ida , tiempo_vuelta = :tiempo_vuelta, tiempo_transporte = :tiempo_transporte, tiempo_obra = :tiempo_obra, tiempo_espera_obra = :tiempo_espera_obra, tiempo_descargue_obra = :tiempo_descargue_obra WHERE ct26_id_remision = :id_remision ";
            $stmt = $this->con->prepare($sql); // Preparar la conexion

            $stmt->bindParam(':tiempo_pedido', $hora_pedido, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_planta', $tiempo_planta, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_ida', $tiempo_ida, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_vuelta', $tiempo_vuelta, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_transporte', $tiempo_transporte, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_obra', $tiempo_obra, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_espera_obra', $tiempo_espera_obra, PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_descargue_obra', $tiempo_descargue_obra, PDO::PARAM_STR);
            $stmt->bindParam(':id_remision', $key['id_remision'], PDO::PARAM_STR);

            if ($stmt->execute()) // Ejecutar
            {
                $resultado[] = true;
            } else {
                $resultado[] = false;
            }
        }
        return $resultado;
    }

    // Diferencia de Horas
    public static function diferencia_horas($hora_mayor, $hora_menor)
    {
        $hora_mayor = strval($hora_mayor);
        $hora_mayor = date('H:i', strtotime($hora_mayor));
        $h_mayor =  idate('H', strtotime($hora_mayor));
        $h_mayor = $h_mayor * 60;
        $m_mayor =  idate('i', strtotime($hora_mayor));
        $total_minutos_mayor = $h_mayor + $m_mayor;

        $hora_menor = strval($hora_menor);
        $hora_menor = date('H:i', strtotime($hora_menor));
        $h_menor =  idate('H', strtotime($hora_menor));
        $h_menor = $h_menor * 60;
        $m_menor =  idate('i', strtotime($hora_menor));

        $total_minutos_menor = $m_menor + $h_menor;

        if ($total_minutos_mayor >= $total_minutos_menor) {
            $total_minutos = $total_minutos_mayor - $total_minutos_menor;
        } else {
            $total_minutos = $total_minutos_menor - $total_minutos_mayor;
        }

        $total_horas = ($total_minutos) / 60;

        $new_hora = intval($total_horas);
        $new_minuto = $total_horas - intval($total_horas);
        $new_minuto = $new_minuto * 60;

        if (!is_integer($new_minuto)) {
            $new_minuto = round($new_minuto);
        }

        // Adicionamos el cero antes del minuto
        if ($new_minuto <= 9 && $new_minuto >= 0) {
            $new_minuto = "0" . $new_minuto;
        }

        // Adicionamos el cero antes del hora
        if ($new_hora <= 9 && $new_hora >= 0) {
            $new_hora = "0" . $new_hora;
        }


        $new_hora_final = $new_hora . ":" . $new_minuto;

        return $new_hora_final;
    }

    // Suma de Horas
    public static function suma_horas($array_horas)
    {
        if (is_array($array_horas)) {
            $suma_min_horas = 0;
            $suma_min_minutos = 0;
            $suma_minutos = 0;
            $cantidad = count($array_horas); // cantidad de horas
            foreach ($array_horas as $key) {
                $new_hora = date('H:i', strtotime($key));
                $horas =  idate('H', strtotime($new_hora));
                $minutos =  idate('i', strtotime($new_hora));
                $new_minutos = $horas * 60; // convertir horas a minutos
                $suma_min_horas += $new_minutos; // sumar acumulado de horas-> que ahora es minutos
                $suma_min_minutos +=  $minutos; // sumar acumulado de minutos
            }
        }
        $suma_minutos = $suma_min_horas + $suma_min_minutos; // Suma todo los minutos

        $suma_minutos = $suma_minutos / 60; // se convierte a horas
        $new_hour = intval($suma_minutos); // limpia las horas sin decimales
        $new_minuto1 =  $suma_minutos - intval($suma_minutos); // el sacamos el valor decimal
        $new_minute = $new_minuto1 * 60; // se convierte el decimal en minutos

        if (!is_integer($new_minute)) {
            $new_minute = round($new_minute);
        }
        // Adicionamos el cero antes del minuto
        if ($new_minute <= 9 && $new_minute >= 0) {
            $new_minute = "0" . $new_minute;
        }

        // Adicionamos el cero antes del hora
        if ($new_hour <= 9 && $new_hour >= 0) {
            $new_hour = "0" . $new_hour;
        }

        $new_horas = $new_hour . ':' . $new_minute . ":" . "00";

        return $new_horas;
    }

    // Promedio de Horas
    public function promedio_horas($array_horas)
    {
        if (is_array($array_horas)) {
            $suma_min_horas = 0;
            $suma_min_minutos = 0;
            $suma_minutos = 0;
            $cantidad = count($array_horas); // cantidad de horas
            foreach ($array_horas as $key) {
                $new_hora = date('H:i', strtotime($key));
                $horas =  idate('H', strtotime($new_hora));
                $minutos =  idate('i', strtotime($new_hora));
                $new_minutos = $horas * 60; // convertir horas a minutos
                $suma_min_horas += $new_minutos; // sumar acumulado de horas-> que ahora es minutos
                $suma_min_minutos +=  $minutos; // sumar acumulado de minutos
            }

            $suma_minutos = $suma_min_horas + $suma_min_minutos; // Suma todo los minutos

            $promedio =  intval($suma_minutos) / intval($cantidad); // Promedio
            $new_rst = $promedio / 60; // se convierte a horas
            $new_hour = intval($new_rst); // limpia las horas sin decimales
            $new_minuto1 =  $new_rst - intval($new_rst); // el sacamos el valor decimal
            $new_minute = $new_minuto1 * 60; // se convierte el decimal en minutos

            if (!is_integer($new_minute)) {
                $new_minute = round($new_minute);
            }
            // Adicionamos el cero antes del minuto
            if ($new_minute <= 9 && $new_minute >= 0) {
                $new_minute = "0" . $new_minute;
            }

            // Adicionamos el cero antes del hora
            if ($new_hour <= 9 && $new_hour >= 0) {
                $new_hour = "0" . $new_hour;
            }

            $new_horas = $new_hour . ':' . $new_minute . ":" . "00";

            return $new_horas;
        } else {
            return false;
        }
    }
}
