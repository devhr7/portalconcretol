<?php


require 'librerias/autoload.php';
require 'modelos/autoload.php';
require 'vendor/autoload.php';


class customHR extends conexionPDO
{

    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function actualizar_tiempo_pedido_obra($tiempo_promedio_pedido, $id_obra)
    {
        $sql = "UPDATE `ct5_obras` SET `tiempo_promedio_pedido`= :tiempo_promedio_pedido WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':tiempo_promedio_pedido', $tiempo_promedio_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
        if ($stmt->execute()) // Ejecutar
        {
            return true;
        } else {
            return false;
        }
    }

    // ALTER TABLE `ct5_obras`  ADD `tiempo_promedio_pedido` TIME NULL DEFAULT NULL  AFTER `ct5_DireccionObra`,  ADD `tiempo_promedio_planta` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_pedido`,  ADD `tiempo_promedio_ida` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_planta`,  ADD `tiempo_promedio_vuelta` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_ida`,  ADD `tiempo_promedio_transporte` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_vuelta`,  ADD `tiempo_promedio_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_transporte`,  ADD `tiempo_promedio_espera_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_obra`,  ADD `tiempo_promedio_descargue_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_promedio_espera_obra`;
    function actualizar_promedio_horas()
    {
        $sql = "SELECT `ct26_id_remision`,`ct26_codigo_remi`,`ct26_idObra`, `tiempo_pedido`, `tiempo_planta`, `tiempo_ida`, `tiempo_vuelta`, `tiempo_transporte`, `tiempo_obra`, `tiempo_espera_obra`, `tiempo_descargue_obra` FROM `ct26_remisiones` WHERE `ct26_date_create` BETWEEN '2021-05-01 00:00:00.000000' AND '2021-06-10 23:59:46.000000' ";
        $stmt = $this->con->prepare($sql); // Preparar la conexion

        if ($stmt->execute()) // Ejecutar
        {
            $num_reg_remi =  $stmt->rowCount(); // Get Numero de Registros  
            if ($num_reg_remi > 0) {
                while ($fila_remi = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_obra = intval($fila_remi['ct26_idObra']); //id_obra
                    $tiempo_pedido_remi = $fila_remi['tiempo_pedido'];
                    $tiempo_planta_remi = $fila_remi['tiempo_planta'];
                    $tiempo_ida = $fila_remi['tiempo_ida'];
                    $tiempo_vuelta = $fila_remi['tiempo_vuelta'];
                    $tiempo_transporte = $fila_remi['tiempo_transporte'];
                    $tiempo_obra = $fila_remi['tiempo_obra'];
                    $tiempo_espera_obra = $fila_remi['tiempo_espera_obra'];
                    $tiempo_descargue_obra = $fila_remi['tiempo_descargue_obra'];

                    if (!is_null($id_obra)) {
                        $sql_obra = "SELECT tiempo_promedio_pedido,tiempo_promedio_planta, tiempo_promedio_ida,tiempo_promedio_vuelta,tiempo_promedio_transporte, tiempo_promedio_obra, tiempo_promedio_espera_obra , tiempo_promedio_descargue_obra  FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
                        $stmt_obra = $this->con->prepare($sql_obra); // Preparar la conexion
                        $stmt_obra->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                        if ($stmt_obra->execute()) {
                            $num_reg_obra =  $stmt_obra->rowCount(); // Get Numero de Registros  
                            if ($num_reg_obra > 0) {
                                while ($fila_obra = $stmt_obra->fetch(PDO::FETCH_ASSOC)) {
                                    $tiempo_promedio_pedido = $fila_obra['tiempo_promedio_pedido'];
                                    $tiempo_promedio_planta = $fila_obra['tiempo_promedio_planta'];
                                    $tiempo_promedio_ida = $fila_obra['tiempo_promedio_ida'];
                                    $tiempo_promedio_vuelta = $fila_obra['tiempo_promedio_vuelta'];
                                    $tiempo_promedio_transporte = $fila_obra['tiempo_promedio_transporte'];
                                    $tiempo_promedio_obra = $fila_obra['tiempo_promedio_obra'];
                                    $tiempo_promedio_espera_obra = $fila_obra['tiempo_promedio_espera_obra'];
                                    $tiempo_promedio_descargue_obra = $fila_obra['tiempo_promedio_descargue_obra'];

                                    // 
                                    if (!is_null($tiempo_promedio_pedido) && !is_null($tiempo_pedido_remi)) {
                                        $promedio_horas = array($tiempo_promedio_pedido, $tiempo_pedido_remi);
                                        $tiempo_promedio_pedido_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_pedido_final = $tiempo_pedido_remi;
                                    }

                                    //
                                    if (!is_null($tiempo_promedio_planta) && !is_null($tiempo_planta_remi)) {
                                        $promedio_horas = array($tiempo_promedio_planta, $tiempo_planta_remi);
                                        $tiempo_promedio_planta_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_planta_final = $tiempo_planta_remi;
                                    }

                                    if (!is_null($tiempo_promedio_ida) && !is_null($tiempo_ida)) {
                                        $promedio_horas = array($tiempo_promedio_ida, $tiempo_ida);
                                        $tiempo_promedio_ida_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_ida_final = $tiempo_ida;
                                    }

                                    if (!is_null($tiempo_vuelta) && !is_null($tiempo_promedio_vuelta)) {
                                        $promedio_horas = array($tiempo_vuelta, $tiempo_promedio_vuelta);
                                        $tiempo_promedio_vuelta_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_vuelta_final = $tiempo_vuelta;
                                    }

                                    if (!is_null($tiempo_promedio_transporte) && !is_null($tiempo_transporte)) {
                                        $promedio_horas = array($tiempo_promedio_transporte, $tiempo_transporte);
                                        $tiempo_promedio_transporte_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_transporte_final = $tiempo_transporte;
                                    }

                                    //
                                    if (!is_null($tiempo_promedio_obra) && !is_null($tiempo_obra)) {
                                        $promedio_horas = array($tiempo_obra, $tiempo_promedio_obra);
                                        $tiempo_promedio_obra_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_obra_final = $tiempo_obra;
                                    }

                                    if (!is_null($tiempo_espera_obra) && !is_null($tiempo_promedio_espera_obra)) {
                                        $promedio_horas = array($tiempo_espera_obra, $tiempo_promedio_espera_obra);
                                        $tiempo_promedio_espera_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_espera_final = $tiempo_espera_obra;
                                    }

                                    if (!is_null($tiempo_descargue_obra) && !is_null($tiempo_promedio_descargue_obra)) {
                                        $promedio_horas = array($tiempo_descargue_obra, $tiempo_promedio_descargue_obra);
                                        $tiempo_promedio_descargue_final = SELF::promedio_horas($promedio_horas);
                                    } else {
                                        $tiempo_promedio_descargue_final = $tiempo_descargue_obra;
                                    }

                                    // Actualizar promedio de pedido
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_pedido`= :tiempo_promedio_pedido WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_pedido', $tiempo_promedio_pedido_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio en pedido " . $tiempo_promedio_pedido_final . "<br>";
                                    }

                                    // Actualizar Promedio de Planta
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_planta`= :tiempo_promedio_planta WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_planta', $tiempo_promedio_planta_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio en planta " . $tiempo_promedio_planta_final . "<br>";
                                    }

                                    // Actualizar Promedio de tiempo de ida 
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_ida`= :tiempo_promedio_ida WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_ida', $tiempo_promedio_ida_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio de ida " . $tiempo_promedio_ida_final . "<br>";
                                    }

                                    // actualizar Promedio de Tiempo de Vuelta
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_vuelta`= :tiempo_promedio_vuelta WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_vuelta', $tiempo_promedio_vuelta_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio en vuelta " . $tiempo_promedio_vuelta_final . "<br>";
                                    }

                                    
                                    // actualizar Promedio de Tiempo de Transporte
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_transporte`= :tiempo_promedio_transporte WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_transporte', $tiempo_promedio_transporte_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo Promedio Trasporte " . $tiempo_promedio_transporte_final . "<br>";
                                    }

                                    // ------------------------------------------------------------
                                    // actualizar Promedio de Tiempo de Obra
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_obra`= :tiempo_promedio_obra WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_obra', $tiempo_promedio_obra_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo en obra " . $tiempo_promedio_obra_final . "<br>";
                                    }

                                    // actualizar Promedio de Espera en Obra
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_espera_obra`= :tiempo_promedio_espera_obra WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_espera_obra', $tiempo_promedio_espera_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio en espera en obra " . $tiempo_promedio_espera_final . "<br>";
                                    }

                                    // actualizar Promedio de descargue en Obra
                                    $sql2 = "UPDATE `ct5_obras` SET `tiempo_promedio_descargue_obra`= :tiempo_promedio_descargue_obra WHERE `ct5_IdObras` = :id_obra";
                                    $stmt2 = $this->con->prepare($sql2); // Preparar la conexion
                                    $stmt2->bindParam(':tiempo_promedio_descargue_obra', $tiempo_promedio_descargue_final, PDO::PARAM_STR);
                                    $stmt2->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
                                    if ($stmt2->execute()) {
                                        $resultado[] =  "la obra " . $id_obra . " actualizo, tiempo promedio descargue obra " . $tiempo_promedio_descargue_final . "<br>";
                                    }

                                    $resultado[] = "<br> ------------------------------------------------------------------------------ <br>";
                                }
                            }
                        }
                    } else {
                        return 3;
                    }
                }
                return $resultado;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    function actualizar_horas_remi($datos_remi)
    {

        foreach ($datos_remi as $key) {
            $sql = "UPDATE `ct26_remisiones` SET tiempo_pedido = :tiempo_pedido, tiempo_planta = :tiempo_planta, tiempo_ida = :tiempo_ida , tiempo_vuelta = :tiempo_vuelta, tiempo_transporte = :tiempo_transporte, tiempo_obra = :tiempo_obra, tiempo_espera_obra = :tiempo_espera_obra, tiempo_descargue_obra = :tiempo_descargue_obra WHERE ct26_id_remision = :id_remision ";
            $stmt = $this->con->prepare($sql); // Preparar la conexion

            $stmt->bindParam(':tiempo_pedido', $key['tiempo_pedido'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_planta', $key['tiempo_planta'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_ida', $key['tiempo_ida'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_vuelta', $key['tiempo_vuelta'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_transporte', $key['tiempo_transporte'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_obra', $key['tiempo_obra'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_espera_obra', $key['tiempo_espera_obra'], PDO::PARAM_STR);
            $stmt->bindParam(':tiempo_descargue_obra', $key['tiempo_descargue_obra'], PDO::PARAM_STR);
            $stmt->bindParam(':id_remision', $key['id_remision'], PDO::PARAM_STR);

            if ($stmt->execute()) // Ejecutar
            {
                $num_reg =  $stmt->rowCount(); // Get Numero de Registros  
                return true;
            } else {
                return false;
            }
        }
    }

    function diferencia_horas($hora_mayor, $hora_menor)
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


    function suma_horas($array_horas)
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

    function get_remisiones()
    {

        //foreach ($array_obras as $key) {
        $sql = "SELECT `ct26_id_remision`,`ct26_codigo_remi`,`ct26_hora_remi`,`ct26_hora_salida_planta`,`ct26_hora_llegada_obra`,`ct26_hora_inicio_descargue`,`ct26_hora_terminada_descargue`,`ct26_hora_llegada_planta` FROM `ct26_remisiones` WHERE `ct26_date_create` BETWEEN '2021-05-01 00:00:00.000000' AND '2021-06-10 23:59:46.000000'";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        //$stmt->bindParam(':id_obra', $key['id_obra'], PDO::PARAM_STR);
        if ($stmt->execute()) // Ejecutar
        {
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros  
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_remisiones['id_remision'] = $fila['ct26_id_remision'];
                    $datos_remisiones['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos_remisiones['hora_cargue'] = $fila['ct26_hora_remi'];
                    $datos_remisiones['hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
                    $datos_remisiones['hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
                    $datos_remisiones['hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
                    $datos_remisiones['hora_terminacion_descargue'] = $fila['ct26_hora_terminada_descargue'];
                    $datos_remisiones['hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
                    $datos[] = $datos_remisiones;
                }
                //$datos[] = $datos_remi;
            }
        }
        // }
        return $datos;
    }
    function get_obras()
    {
        $sql = "SELECT * FROM `ct5_obras` ";
        $stmt = $this->con->prepare($sql); // Preparar la conexion

        //$stmt->bindParam(':id', $this->id, PDO::PARAM_STR);

        if ($stmt->execute()) // Ejecutar
        {
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros  
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_obras['id_obra'] = $fila['ct5_IdObras'];
                    $datos[] = $datos_obras;
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
$obj_hr = new customHR;


//$datos_obras = $obj_hr->get_obras();

$datos_remisiones = $obj_hr->get_remisiones();
foreach ($datos_remisiones as $key) {

    $hora_cargue = $key['hora_cargue'];
    $hora_salida_mixer_planta = $key['hora_salida_planta'];
    $hora_llegada_obra = $key['hora_llegada_obra'];
    $hora_inicio_descargue = $key['hora_inicio_descargue'];
    $hora_terminacion_descargue = $key['hora_terminacion_descargue'];
    $hora_llegada_planta = $key['hora_llegada_planta'];

    // Tiempo pedido
    if ($hora_llegada_planta >= 0 && $hora_llegada_planta >= 0) {
        $tiempo_pedido = $obj_hr->diferencia_horas($hora_llegada_planta, $hora_cargue);
    } else {
        $tiempo_pedido = NULL;
    }

    // Tiempo de Ida
    if ($hora_llegada_obra >= 0 && $hora_salida_mixer_planta >= 0) {
        $tiempo_ida = $obj_hr->diferencia_horas($hora_llegada_obra, $hora_salida_mixer_planta);
    } else {
        $tiempo_ida = NULL;
    }

    //tiempo Vuelta 
    if ($hora_terminacion_descargue >= 0 && $hora_llegada_planta >= 0) {
        $tiempo_vuelta = $obj_hr->diferencia_horas($hora_terminacion_descargue, $hora_llegada_planta);
    } else {
        $tiempo_vuelta = NULL;
    }

    // Tiempo_obra
    if ($hora_terminacion_descargue >= 0 && $hora_llegada_planta >= 0) {
        $tiempo_obra = $obj_hr->diferencia_horas($hora_terminacion_descargue, $hora_llegada_obra);
    } else {
        $tiempo_obra = NULL;
    }

    // Tiempo descargue_obra
    if ($hora_terminacion_descargue >= 0 && $hora_inicio_descargue >= 0) {
        $tiempo_descargue_obra = $obj_hr->diferencia_horas($hora_terminacion_descargue, $hora_inicio_descargue);
    } else {
        $tiempo_descargue_obra = NULL;
    }

    // Tiempo  Transporte
    if ($hora_terminacion_descargue >= 0 && $hora_llegada_planta >= 0) {
        $horas_sumar = array($tiempo_ida, $tiempo_vuelta);
        $tiempo_transporte = $obj_hr->suma_horas($horas_sumar);
    } else {
        $tiempo_transporte = NULL;
    }


    if ($hora_terminacion_descargue >= 0 && $hora_llegada_planta >= 0) {
        $tiempo_espera_obra = $obj_hr->diferencia_horas($hora_inicio_descargue, $hora_llegada_obra);
    } else {
        $tiempo_espera_obra = NULL;
    }

    if ($hora_salida_mixer_planta >= 0 && $hora_cargue >= 0) {
        $tiempo_planta = $obj_hr->diferencia_horas($hora_salida_mixer_planta, $hora_cargue);
    } else {
        $tiempo_planta = NULL;
    }

    $key['tiempo_pedido'] = $tiempo_pedido;
    $key['tiempo_planta'] = $tiempo_planta;
    $key['tiempo_ida'] =  $tiempo_ida;
    $key['tiempo_vuelta'] = $tiempo_vuelta;
    $key['tiempo_transporte'] = $tiempo_transporte;
    $key['tiempo_obra'] = $tiempo_obra;
    $key['tiempo_espera_obra'] = $tiempo_espera_obra;
    $key['tiempo_descargue_obra'] = $tiempo_descargue_obra;
    // Crear Columnas Tabla
    //ALTER TABLE `ct26_remisiones`  ADD `tiempo_pedido` TIME NULL DEFAULT NULL  AFTER `ct26_hora_llegada_planta`,  ADD `tiempo_planta` TIME NULL DEFAULT NULL  AFTER `tiempo_pedido`,  ADD `tiempo_ida` TIME NULL DEFAULT NULL  AFTER `tiempo_planta`,  ADD `tiempo_vuelta` TIME NULL DEFAULT NULL  AFTER `tiempo_ida`,  ADD `tiempo_transporte` TIME NULL DEFAULT NULL  AFTER `tiempo_vuelta`,  ADD `tiempo_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_transporte`,  ADD `tiempo_espera_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_obra`,  ADD `tiempo_descargue_obra` TIME NULL DEFAULT NULL  AFTER `tiempo_espera_obra`;

    $datos_remi[] = $key;
}

if (is_array($datos_remi)) {
    $actualizar_horas = $obj_hr->actualizar_horas_remi($datos_remi);
    if ($actualizar_horas) {
        echo "Las Horas Fueron Actualizadas Correctamente";
        echo "<br>";

        foreach ($datos_remi as $key1) {
        }
    }
} else {
    echo "No se Pudo Actualizar las Horas";
}

var_dump($obj_hr->actualizar_promedio_horas());
