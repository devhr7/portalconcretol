<?php


class t26_remisiones extends conexionPDO
{
  protected $con;
  protected $PDO;
  private $id;


  // Iniciar Conexion
  public function __construct()
  {
    $this->PDO = new conexionPDO();
    $this->con = $this->PDO->connect();
  }
  // SELECT ct27_facturae.ct27_nombre_factura, ct26_remisiones.ct26_codigo_remi FROM `ct28_factura_remi` INNER JOIN ct27_facturae ON ct28_factura_remi.ct28_id_fact = ct27_facturae.ct27_id_factura INNER JOIN ct26_remisiones ON ct28_factura_remi.ct28_id_remision = ct26_remisiones.ct26_id_remision WHERE `ct27_fecha_subda` >= '2021-03-01 00:00:40' ORDER BY `ct27_id_factura` DESC

  function param_bombas_edit($fecha_ini = null, $fecha_fin = null)
  {
    $fecha_ini = "2023-05-10";
    $fecha_fin = "2023-05-10";
    $sql = "SELECT `ct26_id_remision`,`ct26_metros`, `ct26_bomba`,`ct26_cant_bomba` FROM `ct26_remisiones` WHERE `ct26_bomba` != 'null' AND `ct26_fecha_remi` BETWEEN :fecha_ini AND :fecha_fin ORDER BY `ct26_id_remision` DESC";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);

    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $id_remision = $fila['ct26_id_remision'];
          $metros_cubicos = $fila['ct26_metros'];
          if ($fila['ct26_bomba'] == "BOMBA1" || $fila['ct26_bomba'] == "BOMBA2" || $fila['ct26_bomba'] == "BOMBA3" || $fila['ct26_bomba'] == "BOMBA4" || $fila['ct26_bomba'] == "BOMBA5" || $fila['ct26_bomba'] == "BOMBA6" || $fila['ct26_bomba'] == "BOMBA7" || $fila['ct26_bomba'] == "BOMBA8" || $fila['ct26_bomba'] == "AUTOBOMBA"|| $fila['ct26_bomba'] == "BOMBA9") {

            $sql1 = "UPDATE `ct26_remisiones` SET `ct26_cant_bomba` = :cant_bomba WHERE `ct26_id_remision` = :id_remision";
            $stmt1 = $this->con->prepare($sql1);
            $stmt1->bindParam(':cant_bomba', $metros_cubicos, PDO::PARAM_STR);
            $stmt1->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);
            if ($stmt->execute()) {
            }
          }
        }
      }
    }
  }


  function select_bomba_edit($id_remision)
  {
    $this->id_remision = $id_remision;
    $option = "<option  selected='true'  value='0'> Seleccione un Vehiculo</option>";

    $sql = "SELECT `ct26_id_bomba`,`ct26_bomba`,`ct26_id_op_bomba`,`ct26_op_bomba`,`ct26_id_aux_bomba`,`ct26_aux_bomba`,`ct26_cant_bomba` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision ";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);


    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores


          $selection = "selected='true'";
          $option .= '<option value="' . $fila['ct26_bomba'] . '" ' . $selection . ' >' . $fila['ct26_bomba']  . ' </option>';

          $option .= "<option value='NA'  >No tiene servicio bombeo</option>";
          $option .= "<option value='BOMBA1'>Bomba 1</option>";
          $option .= "<option value='BOMBA2'>Bomba 2</option>";
          $option .= "<option value='BOMBA3'>Bomba 3</option>";
          $option .= "<option value='BOMBA4'>Bomba 4</option>";
          $option .= "<option value='BOMBA5'>Bomba 5</option>";
          $option .= "<option value='BOMBA6'>Bomba 6</option>";
          $option .= "<option value='BOMBA7'>Bomba 7</option>";
          $option .= "<option value='BOMBA8'>Bomba 8</option>";
          $option .= "<option value='BOMBA9'>Bomba 9</option>";
          $option .= "<option value='AUTOBOMBA'>AUTOBOMBA</option>";
          $option .= "<option value='AUTOBOMBA-ALQUILADA'>AUTOBOMBA-ALQUILADA</option>";
        }
      } else {
        $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
      }
    } else {
      $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
    }
    return $option;
  }



  function seguimiento_remisiones_final($planta, $fecha)
  {

    //$fechaActual = "2022-09-30";

    $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_nombre_obra ,ct26_vehiculo,ct26_metros, ct26_hora_remi, ct26_hora_salida_planta,ct26_hora_llegada_obra,ct26_hora_inicio_descargue,ct26_hora_terminada_descargue,ct26_hora_llegada_planta,ct26_nombre_conductor,tipo_hora_prog,hora_programada   FROM `ct26_remisiones` WHERE ct26_fecha_remi = :fecha_actual  AND `ct26_idplanta` IN($planta)  AND ct26_estado <> '10'  ORDER BY `ct26_id_remision` DESC LIMIT 5000";
    //$sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_razon_social ,ct26_nombre_obra ,ct26_vehiculo, ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':fecha_actual', $fecha, PDO::PARAM_STR);

    // Ejecutar 
    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      //$hora_actual = date('H:i:s');
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores


          $datos['ct26_id_remision'] = $fila['ct26_id_remision'];
          $datos['ct26_codigo_remi'] = $fila['ct26_codigo_remi'];
          $datos['ct26_nombre_obra'] = $fila['ct26_nombre_obra'];
          $datos['ct26_vehiculo'] = $fila['ct26_vehiculo'];
          $datos['ct26_hora_remi'] = $fila['ct26_hora_remi'];
          $datos['ct26_nombre_conductor'] = $fila['ct26_nombre_conductor'];
          $datos['ct26_metros'] = $fila['ct26_metros'];
          $datos['tipo_hora_prog'] = $fila['tipo_hora_prog'];
          $datos['hora_programada'] = $fila['hora_programada'];


          if ($fila['tipo_hora_prog'] == "HORA_PROGRAMADA") {
            if (!empty($fila['hora_programada']) && !empty($fila['ct26_hora_llegada_obra'])) {

              $hora_mayor = $fila['hora_programada']; // hora actual
              $hora_mayor = new DateTime($hora_mayor); // convertir la hora actual en el formato Hora
              $hora_menor = $fila['ct26_hora_llegada_obra']; // hora primera
              $hora_menor = new DateTime($hora_menor); // conviente la hora remision en formato hora


              if ($hora_mayor > $hora_menor) {
                $interval1 = $hora_menor->diff($hora_mayor); // Obtiene la diferencia de la hora actual 
                $hora_diff4 = $interval1->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                $datos['cumplimiento'] = "<small class='badge badge-success'><i class='far fa-clock'></i>" . $hora_diff4 . "</small>";
              } else {
                $interval1 = $hora_mayor->diff($hora_menor); // Obtiene la diferencia de la hora actual 
                $hora_diff4 = $interval1->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                $datos['cumplimiento'] = "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff4 . "</small>";
              }
            } else {
              $datos['cumplimiento'] = "0:0:0";
              $datos['hora_programada'] = $fila['tipo_hora_prog'];
            }
          } else {
            $datos['hora_programada'] = $fila['tipo_hora_prog'];
            $datos['cumplimiento'] = "0:0:0";
          }

          /**
           * HORA DE SALIDA DE PLANTA
           */
          if (!empty($fila['ct26_hora_salida_planta'])) {
            $datos['ct26_hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
          } else {
            $hora_actual = "" . date('H:i:s'); // hora actual
            $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
            $hora_remision = $fila['ct26_hora_remi']; // hora primera

            $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
            $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
            $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

            //$hora_diff
            $datos['ct26_hora_salida_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
          }
          /**
           * HORA DE LLEGADA OBRA
           */
          if (!empty($fila['ct26_hora_salida_planta'])) { // verificar el campo anterior
            if (!empty($fila['ct26_hora_llegada_obra'])) {
              $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_salida_planta']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_llegada_obra'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
          } else {
            $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
          }

          /**
           * HORA DE INICIO DESCARGUE
           */
          if (!empty($fila['ct26_hora_llegada_obra'])) { // verificar el campo anterior
            if (!empty($fila['ct26_hora_inicio_descargue'])) {
              $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_llegada_obra']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_inicio_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
          } else {
            $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
          }


          /**
           * HORA DE TERMINACION DESCARGUE
           */
          if (!empty($fila['ct26_hora_inicio_descargue'])) { // verificar el campo anterior
            if (!empty($fila['ct26_hora_terminada_descargue'])) {
              $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_inicio_descargue']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_terminada_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
          } else {
            $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
          }

          /**
           * HORA DE LLEGADA EN PLANTA
           */
          if (!empty($fila['ct26_hora_terminada_descargue'])) { // verificar el campo anterior
            if (!empty($fila['ct26_hora_llegada_planta'])) {
              $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_terminada_descargue']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_llegada_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
          } else {
            $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
          }

          //


          $hora_actual = "" . date('H:i:s'); // hora actual
          $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
          $hora_remision2 = $fila['ct26_hora_remi']; // hora primera

          $hora_remi2 = new DateTime($hora_remision2); // conviente la hora remision en formato hora
          $interval = $hora_remi2->diff($hora_new); // Obtiene la diferencia de la hora actual 
          $hora_diff2 = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

          //CICLO ESPERA EN OBRA
          if (!empty($fila['ct26_hora_llegada_obra']) && !empty($fila['ct26_hora_inicio_descargue'])) {

            $hora_mayor = $fila['ct26_hora_inicio_descargue']; // hora actual
            $hora_mayor = new DateTime($hora_mayor); // convertir la hora actual en el formato Hora
            $hora_menor = $fila['ct26_hora_llegada_obra']; // hora primera
            $hora_menor = new DateTime($hora_menor); // conviente la hora remision en formato hora
            $interval1 = $hora_menor->diff($hora_mayor); // Obtiene la diferencia de la hora actual 
            $hora_diff3 = $interval1->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 
            $datos['ciclo_espera_obra'] = $hora_diff3;
          } else {
            $datos['ciclo_espera_obra'] = "0:00:00";
          }


          //CICLO DESCARGUE EN OBRA
          if (!empty($fila['ct26_hora_inicio_descargue']) && !empty($fila['ct26_hora_terminada_descargue'])) {

            $hora_mayor = $fila['ct26_hora_terminada_descargue']; // hora actual
            $hora_mayor = new DateTime($hora_mayor); // convertir la hora actual en el formato Hora
            $hora_menor = $fila['ct26_hora_inicio_descargue']; // hora primera
            $hora_menor = new DateTime($hora_menor); // conviente la hora remision en formato hora
            $interval1 = $hora_menor->diff($hora_mayor); // Obtiene la diferencia de la hora actual 
            $hora_diff4 = $interval1->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 
            $datos['ciclo_descargue'] = $hora_diff4;
          } else {
            $datos['ciclo_descargue'] = "0:00:00";
          }


          //CICLO DESCARGUE EN OBRA
          if (!empty($fila['ct26_hora_llegada_obra']) && !empty($fila['ct26_hora_terminada_descargue'])) {

            $hora_mayor = $fila['ct26_hora_terminada_descargue']; // hora actual
            $hora_mayor = new DateTime($hora_mayor); // convertir la hora actual en el formato Hora
            $hora_menor = $fila['ct26_hora_llegada_obra']; // hora primera
            $hora_menor = new DateTime($hora_menor); // conviente la hora remision en formato hora
            $interval1 = $hora_menor->diff($hora_mayor); // Obtiene la diferencia de la hora actual 
            $hora_diff4 = $interval1->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 
            $datos['ciclo_obra'] = $hora_diff4;
          } else {
            $datos['ciclo_obra'] = "0:00:00";
          }




          $datos['cicloviaje'] = "<small class='badge badge-warning'><i class='far fa-clock'></i>" . $hora_diff2 . "</small>";
          //$datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
          //$datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
          //$datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
          //$datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
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





  function inf_viajes_mes($planta, $mes)
  {
    $sql = "SELECT `ct26_fecha_remi`, COUNT(`ct26_vehiculo`) as 'viajes',  COUNT(DISTINCT `ct26_vehiculo`) as vehiculos , sum(`ct26_metros`) AS 'metros' FROM `ct26_remisiones` WHERE `ct26_idplanta` IN($planta)  AND MONTH(`ct26_fecha_remi`) = :mes AND YEAR(`ct26_fecha_remi`) = '2025' AND `ct26_estado` != '10' AND  `ct26_estado` != '5'   GROUP BY `ct26_fecha_remi`  ORDER BY `ct26_remisiones`.`ct26_fecha_remi` ASC";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':mes', $mes, PDO::PARAM_STR);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos['fecha_mes'] = $fila['ct26_fecha_remi'];
          $datos['viajes'] = $fila['viajes'];
          $datos['vehiculos'] = $fila['vehiculos'];


          $datos['metros'] = $fila['metros'];
          $datos['m3_viajes'] = number_format(doubleval($fila['metros']) / $fila['viajes'], 2);
          $datos['viajes_vehi'] = number_format(doubleval($fila['viajes']) / $fila['vehiculos'], 2);
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

  function inf_viajes_totalizado_mes($planta, $mes)
  {
    $sql = "SELECT COUNT(`ct26_vehiculo`) as 'viajes', COUNT(DISTINCT `ct26_vehiculo`) as vehiculos ,  sum(`ct26_metros`) AS 'metros' FROM `ct26_remisiones` WHERE `ct26_idplanta` IN($planta)  AND MONTH(`ct26_fecha_remi`) = :mes AND YEAR(`ct26_fecha_remi`) = '2025' AND `ct26_estado` != '10' AND  `ct26_estado` != '5' ";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':mes', $mes, PDO::PARAM_STR);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos['viajes'] = $fila['viajes'];
          $datos['metros'] = $fila['metros'];
          $datos['vehiculos'] = $fila['vehiculos'];
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



  function inf_viajes_totalizado($planta, $fecha_remi)
  {
    $sql = "SELECT COUNT(`ct26_vehiculo`) as 'viajes', sum(`ct26_metros`) AS 'metros' FROM `ct26_remisiones` WHERE `ct26_idplanta` IN($planta) AND `ct26_fecha_remi` = :fecha_remi ";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':fecha_remi', $fecha_remi, PDO::PARAM_STR);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos['viajes'] = $fila['viajes'];
          $datos['metros'] = $fila['metros'];
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

  function inf_viajes($planta, $fecha_remi)
  {
    $sql = "SELECT `ct26_fecha_remi`,`ct26_vehiculo`, `ct26_nombre_conductor` , COUNT(`ct26_vehiculo`) as 'viajes', sum(`ct26_metros`) AS 'metros' FROM `ct26_remisiones` WHERE `ct26_idplanta` IN($planta) AND `ct26_fecha_remi` = :fecha_remi GROUP BY `ct26_fecha_remi`, `ct26_vehiculo` ";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':fecha_remi', $fecha_remi, PDO::PARAM_STR);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

          $datos['fecha_remi'] = $fila['ct26_fecha_remi'];
          $datos['placa'] = $fila['ct26_vehiculo'];
          $datos['nombre_conductor'] = $fila['ct26_nombre_conductor'];
          $datos['viajes'] = $fila['viajes'];
          $datos['metros'] = $fila['metros'];

          //** consulta Registro GPS  */
          $sql2 = "SELECT `distacia` AS distancia, `tiempo_uso`  FROM `registrosgps` WHERE `fecha` = :fecha AND `vehiculo` = :vehiculo";
          $stmt2 = $this->con->prepare($sql2);
          $stmt2->bindParam(':fecha', $fila['ct26_fecha_remi'], PDO::PARAM_STR);
          $stmt2->bindParam(':vehiculo', $fila['ct26_vehiculo'], PDO::PARAM_STR);
          // ejecucion SQL
          if ($stmt2->execute()) {

            // numero de registros
            $num_reg2 =  $stmt2->rowCount();

            // valida si hay registros
            if ($num_reg2 > 0) {

              while ($fila1 = $stmt2->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                if ($fila1['distancia'] == "" || $fila1['distancia'] == null) {
                  $datos['distancia'] = " ";
                  $datos['tiempo_uso'] = " ";
                  $datos['indicador_distancia'] = " ";
                } else {
                  $datos['indicador_distancia'] = number_format($fila1['distancia'] / $datos['viajes'], 1);
                  $datos['distancia'] = $fila1['distancia'];
                  $datos['tiempo_uso'] = $fila1['tiempo_uso'];
                }
              }
            } else {
              $datos['distancia'] = " ";
              $datos['tiempo_uso'] = " ";
              $datos['indicador_distancia'] = " ";
            }
          } else {
            $datos['distancia'] = " ";
            $datos['tiempo_uso'] = " ";
            $datos['indicador_distancia'] = "";
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



  // Actualizar Hora Remision
  function update_hora_remi($id_remision, $hora)
  {
    $this->id_remision = (int)$id_remision;
    $this->hora = $hora;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_hora_remi`= :hora_remi WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':hora_remi', $this->hora, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Numero Remision
  function numero_remi($id_remision, $num_remi)
  {
    $this->id_remision = (int)$id_remision;
    $this->num_remi = (int)$num_remi;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_codigo_remi`= :num_remi WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':num_remi', $this->num_remi, PDO::PARAM_INT);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }


  function metros_cubi_remi($id_remision, $metros_cubicos)
  {
    $this->id_remision = (int)$id_remision;
    $this->metros_cubicos = doubleval($metros_cubicos);
    $sql = "UPDATE `ct26_remisiones` SET `ct26_metros`= :metros_cubicos WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':metros_cubicos', $this->metros_cubicos, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }


  function lista_estado_obra()
  {
    $sql = "SELECT ct5_obras.ct5_IdObras, ct1_terceros.ct1_RazonSocial,ct5_obras.ct5_NombreObra, ct5_obras.ct5_estado2 FROM `ct5_obras` INNER JOIN ct1_terceros ON ct5_obras.ct5_IdTerceros = ct1_terceros.ct1_IdTerceros WHERE `ct5_estado2` = 2 ";
    $stmt = $this->con->prepare($sql);


    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
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
  }

  function validar_falta_horas_remi_conductor_all()
  {
    // se establece las Horas hacia atras
    $hora = 48;
    $fecha_now = new DateTime();
    $fecha_now->format('Y-m-d H:i:s');
    $fecha_now->modify('-' . $hora . ' Hour');
    $this->fechaH = $fecha_now->format('Y-m-d H:i:s');

    // id conductor


    $sql = "SELECT ct26_conductor,ct26_hora_salida_planta,ct26_hora_llegada_obra,ct26_hora_inicio_descargue,ct26_hora_terminada_descargue,ct26_hora_llegada_planta,ct26_imagen_remi   FROM `ct26_remisiones` WHERE `ct26_date_create` >= :fecha_atras  AND `ct26_estado` != 10 ORDER BY `ct26_id_remision` DESC ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_atras', $this->fechaH, PDO::PARAM_STR);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos[] = $fila;
        }

        foreach ($datos as $key) {
          $this->id_conductor = $key['ct26_conductor'];
          // Valida si Existe Remision Fisica
          if (is_null($key['ct26_imagen_remi'])) {
            // Valida si estan digitada las Horas         
            if (!empty($key['ct26_hora_salida_planta']) && !empty($key['ct26_hora_llegada_obra']) && !empty($key['ct26_hora_inicio_descargue']) && !empty($key['ct26_hora_terminada_descargue']) && !empty($key['ct26_hora_llegada_planta'])) {
              $result[] = true;
            } else {
              $result[] = false;
            }
          } else {
            // Si esta Fisica No Valida Ni Bloquea
            $result[] = true;
          }

          // Validamos si en el array falta algun campo por digitar
          if (in_array(false, $result)) {
            $this->estado = 2;
          } else {
            $this->estado = 1;
          }

          $sql_conductor = 'UPDATE `ct1_terceros` SET `ct1_estado2`= :estado WHERE `ct1_IdTerceros` = :id_conductor';
          $stmt_conductor = $this->con->prepare($sql_conductor);
          $stmt_conductor->bindParam(':estado', $this->estado, PDO::PARAM_INT);
          $stmt_conductor->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);
          if ($stmt_conductor->execute()) {
            return true;
          } else {
            return false;
          }
        }
      } else {
        return true;
      }
    } else {
      return false;
    }
  }


  function registro_novedades($id_remision, $novedad)
  {
    $this->novedad_remi = $novedad;
    $this->id_remision = (int)$id_remision;

    $sql = "INSERT INTO `ct44_novedades_remi`(`ct44_id_remi`, `ct44_novedades`) VALUES (:id_remision , :novedad_remi)";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    $stmt->bindParam(':novedad_remi', $this->novedad_remi, PDO::PARAM_STR);
    // ejecucion SQL
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function validar_estado_obra($id_obra)
  {
    $this->id_obra = (int)$id_obra;
    $sql = "SELECT `ct5_estado2` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    if ($stmt->execute()) {
      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos = $fila['ct5_estado2'];
        }
        return $datos;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  function validar_falta_firma_por_obra_all()
  {

    $dia_ini = 6;
    $fecha_ini = new DateTime();
    $fecha_ini->format('Y-m-d');
    $fecha_ini->modify('-' . $dia_ini . ' day');
    $this->fechaR = $fecha_ini->format('Y-m-d');

    // se establece las Horas hacia atras
    $dia_fin = 1;
    $fecha_fin = new DateTime();
    $fecha_fin->format('Y-m-d');
    $fecha_fin->modify('-' . $dia_fin . ' day');
    $this->fechaH = $fecha_fin->format('Y-m-d');


    // id conductor

    $sql = 'SELECT ct26_idObra,ct26_codigo_remi,ct26_razon_social, ct26_nombre_obra, ct26_recibido,ct26_imagen_remi,ct26_fechaRecibido   FROM ct26_remisiones WHERE ct26_date_create BETWEEN :fech_ini AND :fech_ant AND ct26_estado != 10   ORDER BY ct26_id_remision DESC ';
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fech_ini', $this->fechaR, PDO::PARAM_STR);
    $stmt->bindParam(':fech_ant', $this->fechaH, PDO::PARAM_STR);


    // ejecucion SQL
    if ($stmt->execute()) {
      // numero de registros
      $num_reg =  $stmt->rowCount();

      if ($num_reg > 0) {

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos[] = $fila;
        }

        foreach ($datos as $fila) {
          // Obtener los datos de los valores
          $id_obra = (int)$fila['ct26_idObra'];








          // Valida si Existe Remision Fisica
          if (is_null($fila['ct26_imagen_remi']) || empty($fila['ct26_imagen_remi'])) {
            // Valida si estan digitada las Horas         
            if (!empty($fila['ct26_recibido']) || !is_null($fila['ct26_recibido'])) {
              $estado = 1;
              $result[] = true;
            } else {
              $estado = 2;
              $result[] = false;
            }
            $this->fisica = "no";
          } else {
            // Si esta Fisica No Valida Ni Bloquea
            $estado = 1;
            $this->fisica = "si";
            // $result[] = true;
          }



          $numero_remision = $fila['ct26_codigo_remi'];
          $cliente = $fila['ct26_razon_social'];
          $obra = $fila['ct26_nombre_obra'];



          $sql_obra = "UPDATE `ct5_obras` SET `ct5_estado2` = :estado_obra WHERE `ct5_obras`.`ct5_IdObras` = :id_obra";
          $stmt_obra = $this->con->prepare($sql_obra);
          $stmt_obra->bindParam(':estado_obra', $estado, PDO::PARAM_INT);
          $stmt_obra->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
          if ($stmt_result = $stmt_obra->execute()) {
            $fila_obra = $stmt_obra->rowCount();
            $resultado['remision'] = $numero_remision;
            $resultado['cliente'] = $cliente;
            $resultado['id obra'] = $id_obra;
            $resultado['obra'] = $obra;
            $resultado['estado'] =  $estado;
            $resultado['fisica'] = $this->fisica;
            $resultado['firma'] = $fila['ct26_recibido'];
            $resultado['imagen'] = $fila['ct26_imagen_remi'];
            $resultado['Rangofecha'] = $this->fechaR . ' - ' . $this->fechaH;
            $resultado['ejecucion'] = $stmt_result;
            $resultado['Filas Afectadas'] = $fila_obra . " filas";
          } else {
            $resultado[] = false;
          }
          $full[] = $resultado;
          $datos[] = $fila;
        }
        return $full;
      } else {
        return 2;
      }
    } else {
      return 1;
    }
  }


  function validar_falta_firma_por_obra($id_obra)
  {
    // se establece las Horas hacia atras
    $dia_anterior = 1;
    $fecha_now = new DateTime();
    $fecha_now->format('Y-m-d H:i:s');
    $fecha_now->modify('-' . $dia_anterior . ' day');
    $this->fechaH = $fecha_now->format('Y-m-d H:i:s');

    $dia_fin = 3;
    $fecha_fin = new DateTime();
    $fecha_fin->format('Y-m-d H:i:s');
    $fecha_fin->modify('-' . $dia_fin . ' day');
    $this->fechaR = $fecha_fin->format('Y-m-d H:i:s');

    // id conductor
    $this->id_obra = $id_obra;

    $sql = "SELECT ct26_recibido,ct26_imagen_remi,ct26_fechaRecibido   FROM `ct26_remisiones` WHERE `ct26_date_create` BETWEEN :fecha_fin AND :fecha_atras AND ct26_idObra = :id_obra AND `ct26_estado` != 10 ORDER BY `ct26_id_remision` DESC ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_fin', $this->fechaR, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_atras', $this->fechaH, PDO::PARAM_STR);
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos[] = $fila;
        }

        foreach ($datos as $key) {
          // Valida si Existe Remision Fisica
          if (is_null($key['ct26_imagen_remi'])) {
            // Valida si estan digitada las Horas         
            if (!empty($key['ct26_recibido']) && !empty($key['ct26_fechaRecibido'])) {
              $result[] = true;
            } else {
              $result[] = false;
            }
          } else {
            // Si esta Fisica No Valida Ni Bloquea
            $result[] = true;
          }
        }

        // Validamos si en el array falta algun campo por digitar
        if (in_array(false, $result)) {
          $this->estado = 2;
        } else {
          $this->estado = 1;
        }

        $sql_conductor = 'UPDATE `ct5_obras` SET `ct5_estado2` = :estado WHERE `ct5_obras`.`ct5_IdObras` = :id_obra ';
        $stmt_conductor = $this->con->prepare($sql_conductor);
        $stmt_conductor->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt_conductor->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if ($stmt_conductor->execute()) {
          return true;
        } else {
          return false;
        }
      } else {
        return true;
      }
    } else {
      return false;
    }
  }


  function validar_falta_horas_remi_conductor($id_conductor)
  {
    // se establece las Horas hacia atras
    $hora = 48;
    $fecha_now = new DateTime();
    $fecha_now->format('Y-m-d H:i:s');
    $fecha_now->modify('-' . $hora . ' Hour');
    $this->fechaH = $fecha_now->format('Y-m-d H:i:s');

    // id conductor
    $this->id_conductor = $id_conductor;

    $sql = "SELECT ct26_hora_salida_planta,ct26_hora_llegada_obra,ct26_hora_inicio_descargue,ct26_hora_terminada_descargue,ct26_hora_llegada_planta,ct26_imagen_remi   FROM `ct26_remisiones` WHERE `ct26_date_create` >= :fecha_atras AND ct26_conductor = :id_conductor AND `ct26_estado` != 10 ORDER BY `ct26_id_remision` DESC ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_atras', $this->fechaH, PDO::PARAM_STR);
    $stmt->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);

    // ejecucion SQL
    if ($stmt->execute()) {

      // numero de registros
      $num_reg =  $stmt->rowCount();

      // valida si hay registros
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos[] = $fila;
        }

        foreach ($datos as $key) {
          // Valida si Existe Remision Fisica
          if (is_null($key['ct26_imagen_remi'])) {
            // Valida si estan digitada las Horas         
            if (!empty($key['ct26_hora_salida_planta']) && !empty($key['ct26_hora_llegada_obra']) && !empty($key['ct26_hora_inicio_descargue']) && !empty($key['ct26_hora_terminada_descargue']) && !empty($key['ct26_hora_llegada_planta'])) {
              $result[] = true;
            } else {
              $result[] = false;
            }
          } else {
            // Si esta Fisica No Valida Ni Bloquea
            $result[] = true;
          }
        }

        // Validamos si en el array falta algun campo por digitar
        if (in_array(false, $result)) {
          $this->estado = 2;
        } else {
          $this->estado = 1;
        }

        $sql_conductor = 'UPDATE `ct1_terceros` SET `ct1_estado2`= :estado WHERE `ct1_IdTerceros` = :id_conductor';
        $stmt_conductor = $this->con->prepare($sql_conductor);
        $stmt_conductor->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt_conductor->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);
        if ($stmt_conductor->execute()) {
          return true;
        } else {
          return false;
        }
      } else {

        $estado = 1;
        $sql_conductor = 'UPDATE `ct1_terceros` SET `ct1_estado2`= :estado WHERE `ct1_IdTerceros` = :id_conductor';
        $stmt_conductor = $this->con->prepare($sql_conductor);
        $stmt_conductor->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt_conductor->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);
        if ($stmt_conductor->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } else {
      return false;
    }
  }

  function estado_remi($id_remision, $estado)
  {
    $this->id_remision = (int)$id_remision;
    $this->estado = (int)$estado;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_estado`= :estado WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }



  function actualizar_asent_sello($id_remision, $asentamiento, $sello)
  {
    $this->id_remision = (int)$id_remision;
    $this->asentamiento = $asentamiento;
    $this->sello = $sello;

    $sql = "UPDATE `ct26_remisiones` SET `ct26_sello`= :sello,`ct26_asentamiento`= :asentamiento WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";

    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':sello', $this->sello, PDO::PARAM_STR);
    $stmt->bindParam(':asentamiento', $this->asentamiento, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }


  function actualizar_producto($id_remision, $id_producto)
  {
    $this->id_remision = (int)$id_remision;
    $this->id_producto = (int)$id_producto;
    $this->codigo_producto = NULL;
    $this->descrip_producto = NULL;

    $sql_product = "SELECT  `ct4_Nombre`, `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id_producto";
    $stmt_product = $this->con->prepare($sql_product);
    $stmt_product->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
    if ($stmt_product->execute()) {
      $num_reg =  $stmt_product->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_product->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->codigo_producto = $fila['ct4_Nombre'];
          $this->descrip_producto = $fila['ct4_Descripcion'];
        }
      } else {
        return false;
      }
    } else {
      return false;
    }

    $sql = "UPDATE `ct26_remisiones` SET `ct26_id_producto`= :id_producto,`ct26_codigo_producto`=:codigo_producto,`ct26_descripcion_producto`=:descrip_producto WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
    $stmt->bindParam(':codigo_producto', $this->codigo_producto, PDO::PARAM_STR);
    $stmt->bindParam(':descrip_producto', $this->descrip_producto, PDO::PARAM_STR);



    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function actualizar_conduc_vehi($id_remision, $id_conductor, $id_vehiculo)
  {
    $this->id_remision = (int)$id_remision;
    $this->id_conductor = (int)$id_conductor;
    $this->id_vehiculo = (int)$id_vehiculo;
    $this->nombre_conductor = NULL;
    $this->placa_vehiculo = NULL;


    $sql_conduc = "SELECT ct1_RazonSocial FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt_conduc = $this->con->prepare($sql_conduc);
    $stmt_conduc->bindParam(':id_cliente', $this->id_conductor, PDO::PARAM_INT);
    if ($stmt_conduc->execute()) {
      $num_reg =  $stmt_conduc->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_conduc->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->nombre_conductor = $fila['ct1_RazonSocial'];
        }
      } else {
        return false;
      }
    } else {
      return false;
    }


    $sql_veh = "SELECT `ct10_Placa` FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` = :id_vehiculo";
    $stmt_veh = $this->con->prepare($sql_veh);
    $stmt_veh->bindParam(':id_vehiculo', $this->id_vehiculo, PDO::PARAM_INT);
    if ($stmt_veh->execute()) {
      $num_reg =  $stmt_veh->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_veh->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->placa_vehiculo = $fila['ct10_Placa'];
        }
      } else {
        return false;
      }
    } else {
      return false;
    }


    $sql = "UPDATE `ct26_remisiones` SET `ct26_conductor`= :id_conductor,`ct26_nombre_conductor`=:nombre_conductor,`ct26_id_vehiculo`=:id_vehiculo,`ct26_vehiculo`=:placa_vehiculo WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_conductor', $this->nombre_conductor, PDO::PARAM_STR);
    $stmt->bindParam(':id_vehiculo', $this->id_vehiculo, PDO::PARAM_INT);
    $stmt->bindParam(':placa_vehiculo', $this->placa_vehiculo, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function actualizar_cli_obra($id_remision, $id_cliente, $id_obra)
  {
    $this->id_remision = (int)$id_remision;
    $this->id_cliente = (int)$id_cliente;
    $this->id_obra = (int)$id_obra;
    $this->razon_rocial = NULL;
    $this->nombre_obra = NULL;
    $this->nit = NULL;

    //select cliente 

    $sql_cli = "SELECT ct1_NumeroIdentificacion,ct1_RazonSocial FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt_cli = $this->con->prepare($sql_cli);
    $stmt_cli->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    if ($stmt_cli->execute()) {
      $num_reg =  $stmt_cli->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_cli->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->razon_social = $fila['ct1_RazonSocial'];
          $this->nit = $fila['ct1_NumeroIdentificacion'];
        }
      } else {
        return false;
      }
    } else {
      return false;
    }

    //select obra 

    $sql_obra = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
    $stmt_obra = $this->con->prepare($sql_obra);
    $stmt_obra->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);

    if ($stmt_obra->execute()) {
      $num_reg =  $stmt_obra->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_obra->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->nombre_obra = $fila['ct5_NombreObra'];
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
    //////  


    $sql = "UPDATE `ct26_remisiones` SET `ct26_idcliente`= :id_cliente,`ct26_nitcliente`= :id_nit,`ct26_razon_social`= :razon_social,`ct26_idObra`= :id_obra,`ct26_nombre_obra`= :nombre_obra WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':id_nit', $this->nit, PDO::PARAM_INT);
    $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function actualizar_estado_remi_fact($id_remision, $estado)
  {
    $this->id_remision = (int)$id_remision;
    $this->estado = (int)$estado;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_estado` = :estado WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) {
      // Devolver el ultimo Registro insertado
      $id_insert = $this->con->lastInsertId();

      if ($id_insert) {
        return $id_insert;
      } else {
        return false;
      }
    } else {
      return false;
    }

    $this->PDO->closePDO();
  }


  function actualizar_bombeo_avanzado($id_remision, $bomba, $id_op_bomba, $id_aux_bomba, $metros_bombeados)
  {

    if ($bomba == 'NA') {
      $this->bomba = NULL;
      $this->id_remision = $id_remision;
      $this->id_op_bomba = NULL;
      $this->nombre_op_bomba = NULL;
      $this->id_aux_bomba = NULL;
      $this->nombre_aux_bomba = NULL;
    } else {

      $this->bomba = $bomba;
      $this->id_remision = $id_remision;
      $this->id_op_bomba = $id_op_bomba;
      $this->nombre_op_bomba = null;
      $this->id_aux_bomba = $id_aux_bomba;
      $this->nombre_aux_bomba = null;

      /////////////////////////////////////////////////////////////////////
      if ($this->id_op_bomba != null) {
        $sql_op_bomba = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";
        $stmt_op_bomba = $this->con->prepare($sql_op_bomba);
        $stmt_op_bomba->bindParam(':id_tercero', $this->id_op_bomba, PDO::PARAM_INT);
        if ($stmt_op_bomba->execute()) {
          $num_reg =  $stmt_op_bomba->rowCount();
          if ($num_reg > 0) {
            while ($fila = $stmt_op_bomba->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
              $this->nombre_op_bomba = $fila['ct1_RazonSocial'];
            }
          } else {
            return false;
          }
        } else {
          return false;
        }
      }

      /////////////////////////////////////////////////////////////////////
      if ($this->id_aux_bomba != null) {

        $sql_aux_bomba = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";
        $stmt_aux_bomba = $this->con->prepare($sql_aux_bomba);
        $stmt_aux_bomba->bindParam(':id_tercero', $this->id_aux_bomba, PDO::PARAM_INT);
        if ($stmt_aux_bomba->execute()) {
          $num_reg =  $stmt_aux_bomba->rowCount();
          if ($num_reg > 0) {
            while ($fila = $stmt_aux_bomba->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
              $this->nombre_aux_bomba = $fila['ct1_RazonSocial'];
            }
          } else {
            return false;
          }
        } else {
          return false;
        }
      }

      /////////////////////////////////////////////////////////////////////
    }

    $sql = "UPDATE `ct26_remisiones` SET 	ct26_bomba = :bomba, ct26_id_op_bomba = :id_op_bomba , ct26_op_bomba = :nombre_op_bomba, ct26_id_aux_bomba = :id_aux_bomba, ct26_aux_bomba = :nombre_aux_bomba , `ct26_cant_bomba` = :bombeados  WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':bomba', $this->bomba, PDO::PARAM_STR);
    $stmt->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_op_bomba', $this->nombre_op_bomba, PDO::PARAM_STR);
    $stmt->bindParam(':id_aux_bomba', $this->id_aux_bomba, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_aux_bomba', $this->nombre_aux_bomba, PDO::PARAM_STR);
    $stmt->bindParam(':bombeados', $metros_bombeados, PDO::PARAM_STR);



    //$stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    // Ejecutar 
    if ($result = $stmt->execute()) {

      return true;
    } else {
      return false;
    }


    //Cerrar Conexion
    $this->PDO->closePDO();
  }


  function actualizar_bombeo($id_remision, $bomba, $id_op_bomba, $id_aux_bomba)
  {

    if ($bomba == 'NA') {
      $this->bomba = NULL;
      $this->id_remision = $id_remision;
      $this->id_op_bomba = NULL;
      $this->nombre_op_bomba = NULL;
      $this->id_aux_bomba = NULL;
      $this->nombre_aux_bomba = NULL;
    } else {

      $this->bomba = $bomba;
      $this->id_remision = $id_remision;
      $this->id_op_bomba = $id_op_bomba;
      $this->nombre_op_bomba = null;
      $this->id_aux_bomba = $id_aux_bomba;
      $this->nombre_aux_bomba = null;

      /////////////////////////////////////////////////////////////////////
      if ($this->id_op_bomba != null) {
        $sql_op_bomba = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";
        $stmt_op_bomba = $this->con->prepare($sql_op_bomba);
        $stmt_op_bomba->bindParam(':id_tercero', $this->id_op_bomba, PDO::PARAM_INT);
        if ($stmt_op_bomba->execute()) {
          $num_reg =  $stmt_op_bomba->rowCount();
          if ($num_reg > 0) {
            while ($fila = $stmt_op_bomba->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
              $this->nombre_op_bomba = $fila['ct1_RazonSocial'];
            }
          } else {
            return false;
          }
        } else {
          return false;
        }
      }

      /////////////////////////////////////////////////////////////////////
      if ($this->id_aux_bomba != null) {

        $sql_aux_bomba = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";
        $stmt_aux_bomba = $this->con->prepare($sql_aux_bomba);
        $stmt_aux_bomba->bindParam(':id_tercero', $this->id_aux_bomba, PDO::PARAM_INT);
        if ($stmt_aux_bomba->execute()) {
          $num_reg =  $stmt_aux_bomba->rowCount();
          if ($num_reg > 0) {
            while ($fila = $stmt_aux_bomba->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
              $this->nombre_aux_bomba = $fila['ct1_RazonSocial'];
            }
          } else {
            return false;
          }
        } else {
          return false;
        }
      }

      /////////////////////////////////////////////////////////////////////
    }


    if ($bomba == 'NA') {
      $sql = "UPDATE `ct26_remisiones` SET 	ct26_bomba = :bomba, ct26_id_op_bomba = :id_op_bomba , ct26_op_bomba = :nombre_op_bomba, ct26_id_aux_bomba = :id_aux_bomba, ct26_aux_bomba = :nombre_aux_bomba , `ct26_cant_bomba` = NULL  WHERE `ct26_id_remision` = :id_remision";
    } else {
      $sql = "UPDATE `ct26_remisiones` SET 	ct26_bomba = :bomba, ct26_id_op_bomba = :id_op_bomba , ct26_op_bomba = :nombre_op_bomba, ct26_id_aux_bomba = :id_aux_bomba, ct26_aux_bomba = :nombre_aux_bomba , `ct26_cant_bomba` = `ct26_metros`  WHERE `ct26_id_remision` = :id_remision";
    }
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':bomba', $this->bomba, PDO::PARAM_STR);
    $stmt->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_op_bomba', $this->nombre_op_bomba, PDO::PARAM_STR);
    $stmt->bindParam(':id_aux_bomba', $this->id_aux_bomba, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_aux_bomba', $this->nombre_aux_bomba, PDO::PARAM_STR);

    //$stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    // Ejecutar 
    if ($result = $stmt->execute()) {

      return true;
    } else {
      return false;
    }


    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function insert_bomba($id_remision, $bomba, $id_op_bomba, $id_aux_bomba)
  {
    $this->id_remision = $id_remision;
    $this->bomba = $bomba;
    $this->id_op_bomba = $id_op_bomba;
    $this->id_aux_aux = $id_aux_bomba;


    $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_op_bomba";

    $stmt_op_bomba = $this->con->prepare($sql);
    $stmt_op_bomba->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_INT);

    if ($stmt_op_bomba->execute()) {
      $num_reg =  $stmt_op_bomba->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_op_bomba->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos[] = $fila['ct1_RazonSocial'];
        }
        return $datos;
      } else {
        return false;
      }
    } else {
      return false;
    }








    $sql = "UPDATE `ct26_remisiones` SET `ct26_bomba`= :bomba,`ct26_id_op_bomba`=:id_op_bomba,`ct26_op_bomba`= :op_bomba,`ct26_id_aux_bomba`= :id_aux_bomba,`ct26_aux_bomba`= :aux_bomba  WHERE `ct26_id_remision` = :id_remision";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':bomba', $this->bomba, PDO::PARAM_STR);
    $stmt->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_STR);
    $stmt->bindParam(':op_bomba', $this->h_llegada_mix_obra, PDO::PARAM_STR);
    $stmt->bindParam(':id_aux_bomba', $this->id_aux_aux, PDO::PARAM_STR);
    $stmt->bindParam(':aux_bomba', $this->h_terminacion_descargue, PDO::PARAM_STR);
    //$stmt->bindParam(':hora_llegada_planta', $this->h_llegada_mix_planta, PDO::PARAM_STR);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
  }

  function remisiones_cliente_torreon()
  {


    $sql_cli = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idObra` IN(202,1307,1266) ORDER BY `ct26_remisiones`.`ct26_fecha_remi` DESC LIMIT 100;"; //Select Cliente
    $stmt_cli = $this->con->prepare($sql_cli);
    if ($stmt_cli->execute()) {
      $num_reg =  $stmt_cli->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt_cli->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
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


  function remision_cliente($id_cliente, $id_obra = null)
  {
    $this->id_cliente = intval($id_cliente);
    if (is_null($id_obra)) {
      $sql_cli = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idcliente` LIKE '%$id_cliente%'  ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC"; //Select Cliente
      $stmt_cli = $this->con->prepare($sql_cli);
      //$stmt_cli->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
      if ($stmt_cli->execute()) {
        $num_reg =  $stmt_cli->rowCount();
        if ($num_reg > 0) {
          while ($fila = $stmt_cli->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
            $datos[] = $fila;
          }
          return $datos;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      $this->id_obra = intval($id_obra);
      $sql_obra = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idcliente` =  :id_cliente AND `ct26_idObra` = :id_obra  ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC "; //Select Cliente
      $stmt_obra = $this->con->prepare($sql_obra);
      $stmt_obra->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
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
  }

  function get_remision_numero($num_remision, $planta)
  {

    $this->num_remision = intval($num_remision);
    $this->num_remision = $num_remision;
    $this->planta = $planta;

    $sql = "SELECT ct26_id_remision FROM `ct26_remisiones` WHERE `ct26_codigo_remi` = :num_remision AND `ct26_idplanta` = :id_planta";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':num_remision', $this->num_remision, PDO::PARAM_INT);
    $stmt->bindParam(':id_planta', $this->planta, PDO::PARAM_STR);
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $id_remision = $fila['ct26_id_remision'];
        }
        return $id_remision;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  function get_remision($id_remision)
  {

    $this->id_remi = intval($id_remision);

    $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $this->id_remi, PDO::PARAM_INT);
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
  }

  function get_vehiculo($id_remision)
  {

    $this->id_remision = intval($id_remision);

    $sql = "SELECT `ct26_vehiculo` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $nombre_conductor = $fila['ct26_vehiculo'];
        }
        return $nombre_conductor;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }



  function get_conductor($id_remision)
  {

    $this->id_remision = intval($id_remision);

    $sql = "SELECT `ct26_nombre_conductor` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $nombre_conductor = $fila['ct26_nombre_conductor'];
        }
        return $nombre_conductor;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  function planotxt_remi($fecha_ini, $fecha_fin, $id_planta)
  {
    $this->fecha_ini = $fecha_ini;
    $this->fecha_fin = $fecha_fin;
    $this->id_planta = $id_planta;

    //$sql = "SELECT * FROM `ct29_batch` WHERE `ct29_IdPlanta` = :id_planta AND `ct29_Fecha` BETWEEN  :fecha_ini AND :fecha_fin  ORDER BY `ct29_batch`.`ct29_Remision` ASC";
    $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_idplanta` = :id_planta AND `ct26_fecha_remi` BETWEEN  :fecha_ini AND :fecha_fin  ORDER BY `ct26_remisiones`.`ct26_codigo_remi` ASC ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
    $stmt->bindParam(':id_planta', $this->id_planta, PDO::PARAM_STR);



    // Ejecutar 
    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $datos['id_planta'] = $fila['ct26_idplanta'];
          $datos['numero_remi'] = $fila['ct26_codigo_remi'];
          $datos['fecha'] = $fila['ct26_fecha_remi'];
          $datos['nit_cliente'] = $fila['ct26_nitcliente'];
          $datos['cod_producto'] = $fila['ct26_codigo_producto'];
          $datos['metros'] = $fila['ct26_metros'];
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

  function planotxt_remi2($fecha_ini, $fecha_fin)
  {
    $this->fecha_ini = $fecha_ini;
    $this->fecha_fin = $fecha_fin;
    //$sql= "SELECT * FROM `ct26_remisiones` WHERE `ct26_idplanta` = :id_planta AND `ct26_fecha_remi` BETWEEN  :fecha_ini AND :fecha_fin  ORDER BY `ct26_remisiones`.`ct26_codigo_remi` ASC ";
    $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_fecha_remi` BETWEEN  :fecha_ini AND :fecha_fin ORDER BY `ct26_remisiones`.`ct26_codigo_remi` ASC ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
    // Ejecutar 
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          // `ct26_idplanta`, `ct26_codigo_remi`, `ct26_fecha_remi`, `ct26_nitcliente`, `ct26_codigo_producto`, `ct26_metros`
          $datos['id_planta'] = $fila['ct26_idplanta'];
          $datos['numero_remi'] = $fila['ct26_codigo_remi'];
          $datos['fecha'] = $fila['ct26_fecha_remi'];
          $datos['nit_cliente'] = $fila['ct26_nitcliente'];
          $datos['cod_producto'] = $fila['ct26_codigo_producto'];
          $datos['metros'] = $fila['ct26_metros'];
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

  function codigo_producto($id_producto)
  {
    $this->id_producto = $id_producto;

    $sql = "SELECT `ct4_Nombre` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam('id', $this->id_producto, PDO::PARAM_INT);

    // Ejecutar 
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          return $fila['ct4_Nombre'];
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


  function descripcion_producto($id_producto)
  {
    $this->id_producto = $id_producto;

    $sql = "SELECT `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id', $this->id_producto, PDO::PARAM_INT);

    // Ejecutar 
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          return $fila['ct4_Descripcion'];
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



  function nombre_obra($id_obra)
  {
    $this->id_obra = $id_obra;

    $sql = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);

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


  function identificacion_cliente($id_cliente)
  {
    $this->id_cliente = $id_cliente;

    $sql = "SELECT `ct1_NumeroIdentificacion` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

    // Ejecutar 
    if ($stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          return $fila['ct1_NumeroIdentificacion'];
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

  function nombre_cliente($id_cliente)
  {
    $this->id_cliente = $id_cliente;

    $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

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

  function insertar_remision($hora, $asentamiento, $despachador, $numero_cilindro,  $codigo_remi, $fecha, $id_planta, $id_cliente, $nit,  $razon_social, $id_obra, $nombre_obra, $metros,  $id_producto, $codigo_producto, $descripcion_producto,  $id_vehiculo, $placa, $id_conductor, $conductor)
  {

    $this->hora = $hora;
    $this->asentamiento =  $asentamiento;
    $this->despachador =  $despachador;
    $this->numero_cilindro = $numero_cilindro;



    $this->fecha = $fecha;
    $this->metros = $metros;

    $this->nit = $nit;
    $this->id_planta = $id_planta;
    $this->codigo_remi = $codigo_remi;
    $this->id_cliente = $id_cliente;
    $this->razon_social = $razon_social;
    $this->id_obra = $id_obra;
    $this->nombre_obra = $nombre_obra;
    $this->id_producto = $id_producto;
    $this->codigo_producto = $codigo_producto;
    $this->descripcion_producto = $descripcion_producto;
    $this->id_vehiculo = $id_vehiculo;
    $this->placa = $placa;
    $this->id_conductor = $id_conductor;
    $this->conductor = $conductor;
    $this->estado = 4;
    $this->notificacion = 3;
    $this->fisica = 0;
    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());
    $this->consolidado_remi = $this->id_planta . ' - ' . $this->codigo_remi;

    $sql = "INSERT INTO `ct26_remisiones`(ct26_date_create, `ct26_codigo_remi`, `ct26_idplanta`, `ct26_fecha_remi` , `ct26_idcliente`,`ct26_nitcliente` ,`ct26_razon_social`, `ct26_idObra`, `ct26_nombre_obra`, `ct26_metros` ,`ct26_id_producto`, `ct26_codigo_producto`, `ct26_descripcion_producto`,`ct26_id_vehiculo`, `ct26_vehiculo`,`ct26_conductor`, `ct26_nombre_conductor` , `ct26_estado`, `ct26_hora_remi`, `ct26_sello`, `ct26_asentamiento`, `ct26_despachador`,`ct26_notificacion`,  ct26_fisica, consolidado_remi) VALUES";
    $sql .= " (:datetime_remi, :codigo_remi, :id_planta , :fecha , :id_cliente , :nit, :razon_social, :id_obra, :nombre_obra, :metros ,:id_producto , :codigo_producto, :descripcion_producto , :id_vehiculo, :placa, :id_conductor, :nombre_conductor, :estado, :hora_remi, :sello , :asentamiento, :despachador, :notificacion , :fisica,:consolidado_remi)";

    $stmt = $this->con->prepare($sql);


    $stmt->bindParam(':datetime_remi', $date, PDO::PARAM_STR);
    $stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_planta', $this->id_planta, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
    $stmt->bindParam(':nit', $this->nit, PDO::PARAM_STR);
    $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
    $stmt->bindParam(':metros', $this->metros, PDO::PARAM_STR);
    $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_STR);
    $stmt->bindParam(':codigo_producto', $this->codigo_producto, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion_producto', $this->descripcion_producto, PDO::PARAM_STR);
    $stmt->bindParam(':id_vehiculo', $this->id_vehiculo, PDO::PARAM_STR);
    $stmt->bindParam(':placa', $this->placa, PDO::PARAM_STR);
    $stmt->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_conductor', $this->conductor, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
    $stmt->bindParam(':hora_remi', $this->hora, PDO::PARAM_STR);
    $stmt->bindParam(':sello', $this->numero_cilindro, PDO::PARAM_STR);
    $stmt->bindParam(':asentamiento', $this->asentamiento, PDO::PARAM_STR);
    $stmt->bindParam(':despachador', $this->despachador, PDO::PARAM_STR);
    $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_STR);
    $stmt->bindParam(':fisica', $this->fisica, PDO::PARAM_INT);
    $stmt->bindParam(':consolidado_remi', $this->consolidado_remi, PDO::PARAM_STR);



    if ($stmt->execute()) {
      // Devolver el ultimo Registro insertado
      $id_insert = $this->con->lastInsertId();


      if ($id_insert) {
        return $id_insert;
      } else {
        return false;
      }
    } else {
      return false;
    }

    $this->PDO->closePDO();
  }


  //

  function rz_anular_remision($id_remision, $rz_anular)
  {
    $this->id_remision = $id_remision;
    $this->rz_anular = $rz_anular;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_razon_anular` = :rz_anular WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':rz_anular', $this->rz_anular, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    // Ejecutar 
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function anular_remision($id_remision)
  {
    $this->id_remision = $id_remision;
    $sql = "UPDATE `ct26_remisiones` SET `ct26_estado` = 10 WHERE `ct26_remisiones`.`ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    // Ejecutar 
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function eliminar_remision($id_remision)
  {
    $this->id_remision = $id_remision;
    $sql = "DELETE FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    // Ejecutar 
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  function editar_remision($img_remi, $ruta, $id_remision)
  {
    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());

    $this->id_remision = $id_remision;
    $this->img_remi = $img_remi;
    $php_fileexten = strrchr($this->img_remi, ".");
    $php_serial = strtoupper(substr(hash('sha1', $this->img_remi . $date), 0, 40)) . $php_fileexten;
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
    $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);

    $sql = "UPDATE `ct26_remisiones` SET `ct26_imagen_remi` = :img_remi , `ct26_estado`= 2 , ct26_fisica = 1 WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':img_remi', $php_tempfoto, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
    // Ejecutar 
    if ($result = $stmt->execute()) {
      $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
      return true;
    }
    //Cerrar Conexion
    $this->PDO->closePDO();
    //resultado
    return $result;
  }




  function actualizar_horas_remi($id_remision, $h_salida_mix_planta, $h_llegada_mix_obra, $h_inicio_descargue, $h_terminacion_descargue, $h_llegada_mix_planta)
  {
    $this->id_remision = $id_remision;
    $this->h_salida_mix_planta = $h_salida_mix_planta;
    $this->h_llegada_mix_obra = $h_llegada_mix_obra;
    $this->h_inicio_descargue = $h_inicio_descargue;
    $this->h_terminacion_descargue = $h_terminacion_descargue;
    $this->h_llegada_mix_planta = $h_llegada_mix_planta;

    $sql = "UPDATE `ct26_remisiones` SET `ct26_hora_salida_planta`= :hora_salida_planta,`ct26_hora_llegada_obra`= :hora_llegada_obra,`ct26_hora_inicio_descargue`= :hora_inicio_descargue,`ct26_hora_terminada_descargue`=:hora_terminacion_descargue,`ct26_hora_llegada_planta`= :hora_llegada_planta WHERE `ct26_id_remision` = :id_remision";

    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':hora_salida_planta', $this->hora_salida_planta, PDO::PARAM_STR);
    $stmt->bindParam(':hora_salida_planta', $this->h_salida_mix_planta, PDO::PARAM_STR);
    $stmt->bindParam(':hora_llegada_obra', $this->h_llegada_mix_obra, PDO::PARAM_STR);
    $stmt->bindParam(':hora_inicio_descargue', $this->h_inicio_descargue, PDO::PARAM_STR);
    $stmt->bindParam(':hora_terminacion_descargue', $this->h_terminacion_descargue, PDO::PARAM_STR);
    $stmt->bindParam(':hora_llegada_planta', $this->h_llegada_mix_planta, PDO::PARAM_STR);

    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    if ($stmt->execute()) { // Ejecutar
      return true;
    } else {
      return false;
    }



    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function select_hora_programada($id_remision, $tipo_hora_prog = null)
  {
    $this->id_remision = intval($id_remision);


    $option = "<option  selected='true' disabled> Seleccionar </option>";

    $sql = "SELECT `tipo_hora_prog` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    // Ejecutar 
    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          if (!is_null($fila['tipo_hora_prog'])) {
            $option .= "<option value='" . $fila['tipo_hora_prog']  . "' selected='true'  >  " . $fila['tipo_hora_prog'] . " </option>";
          }
        }
      }

      $option .= "<option value='HORA_PROGRAMADA'  >  HORA PROGRAMADA </option>";
      $option .= "<option value='CAMBIO_HORARIO'  > CAMBIO HORARIO </option>";
      $option .= "<option value='ADICIONAL'  > ADICIONAL  </option>";

      return $option;
    } else {
      return false;
    }



    if (intval($tipo_hora_prog) == $fila1['tipo_hora_prog']) {
      $selection = " selected='true' ";
    } else {
      $selection = "";
    }
    $option .= "<option value='" . $this->tipo_hora_prog . "'  >  " . $tipo_hora_prog . " </option>";

    //resultado
    return $result;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function actualizar_hora_programada($id_remision, $tipo_hora_prog, $hora_programada)
  {
    $this->id_remision = intval($id_remision);
    $this->tipo_hora_prog = $tipo_hora_prog;

    if ($tipo_hora_prog ==  'ADICIONAL') {
      $this->hora_programada =  NULL;
    } else {
      $this->hora_programada =  $hora_programada;
    }

    $sql = "UPDATE `ct26_remisiones` SET  tipo_hora_prog = :tipo_hora_prog, hora_programada = :hora_programada  WHERE `ct26_id_remision` = :id_remision";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':tipo_hora_prog', $this->tipo_hora_prog, PDO::PARAM_STR);
    $stmt->bindParam(':hora_programada', $this->hora_programada, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);

    // Ejecutar 
    $result = $stmt->execute();


    //resultado
    return $result;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function editar_datos_remision1($id_remision, $id_cliente, $nit, $nombre_cliente, $id_obra, $nombre_obra,  $id_mixer, $id_conductor, $identificacion_conductor, $nombre_conductor, $id_producto, $codigo_producto, $nombre_producto, $estado, $observacion_desp)
  {
    $this->id_remision = $id_remision;
    $this->id_cliente = $id_cliente;
    $this->id_obra = $id_obra;
    $this->id_mixer = $id_mixer;
    $this->id_conductor = $id_conductor;
    $this->id_producto = $id_producto;

    $this->estado = $estado;
    $this->observaciones = $observacion_desp;
    // $this->codigo_remi = $codigo_remi;

    $sql = "UPDATE `ct26_remisiones` SET  ct26_estado = :estado, ct26_idcliente = :id_cliente, ct26_nitcliente= :nit_cliente , ct26_razon_social = :nombre_cliente,  `ct26_idObra`= :id_obra, ct26_nombre_obra  = :nombre_obra ,`ct26_id_vehiculo` = :id_mixer , `ct26_conductor`= :id_conductor,ct26_identificacion_conductor=  :identificacion_conductor, ct26_nombre_conductor = :nombre_conductor , `ct26_id_producto` = :id_producto, ct26_codigo_producto =  :codigo_producto , ct26_descripcion_producto = :descripcion_producto,  ct26_observaciones_desp = :observaciones_desp  WHERE `ct26_id_remision` = :id_remision";


    $stmt = $this->con->prepare($sql);


    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':nit_cliente', $nit, PDO::PARAM_INT); // Nit
    $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR); // razon social
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR); // Nombre Obra
    $stmt->bindParam(':id_mixer', $this->id_mixer, PDO::PARAM_INT);
    $stmt->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);
    $stmt->bindParam(':identificacion_conductor', $identificacion_conductor, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_conductor', $nombre_conductor, PDO::PARAM_STR);
    $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_STR);
    $stmt->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR); // Codigo Producto
    $stmt->bindParam(':descripcion_producto', $nombre_producto, PDO::PARAM_STR); // Descripcion Producto
    $stmt->bindParam(':observaciones_desp', $this->observaciones, PDO::PARAM_STR);

    //$stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    // Ejecutar 
    $result = $stmt->execute();

    //resultado
    return $result;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function editar_datos_remision($id_remision, $codigo_remi, $cliente, $obra_remi, $conductor, $id_vehiculo, $estado)
  {
    $this->id_remision = $id_remision;
    $this->id_cliente = $cliente;

    //-------------------------------------------------------------------------------------------------------------------
    $sql_cli = "SELECT ct1_NumeroIdentificacion , `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt_cli = $this->con->prepare($sql_cli);
    $stmt_cli->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    if ($stmt_cli->execute()) { // Ejecutar
      $num_reg =  $stmt_cli->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_cli = $stmt_cli->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->razon_social = $fila_cli['ct1_RazonSocial'];
          $this->nit_cliente = $fila_cli['ct1_NumeroIdentificacion'];
        }
        //return $datos;
      } else {
        $this->razon_social = null;
        $this->nit_cliente = null;
      }
    } else {
      $this->nit_cliente = null;
      $this->razon_social = null;
    }
    //-------------------------------------------------------------------------------------------------------------------
    $this->id_obra = $obra_remi;
    $sql_obra = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
    $stmt_obra = $this->con->prepare($sql_obra);
    $stmt_obra->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    if ($stmt_obra->execute()) { // Ejecutar
      $num_reg =  $stmt_obra->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_obra = $stmt_obra->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->nombre_obra = $fila_obra['ct5_NombreObra'];
        }
      } else {
        $this->nombre_obra = null;
      }
    } else {
      $this->nombre_obra = null;
    }
    //-------------------------------------------------------------------------------------------------------------------


    $this->id_vehiculo = $id_vehiculo;

    $sql_vehiculo = "SELECT `ct10_Placa` FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` = :id_vehiculo";
    $stmt_vehiculo = $this->con->prepare($sql_vehiculo);
    $stmt_vehiculo->bindParam(':id_vehiculo', $this->id_vehiculo, PDO::PARAM_INT);
    if ($stmt_vehiculo->execute()) { // Ejecutar
      $num_reg =  $stmt_vehiculo->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_placa = $stmt_vehiculo->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->placa_mixer = $fila_placa['ct10_Placa'];
        }
      } else {
        $this->placa_mixer = null;
      }
    } else {
      $this->placa_mixer = null;
    }

    $this->conductor = $conductor;
    $sql_coductor = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_conductor";

    $stmt_conductor = $this->con->prepare($sql_coductor);
    $stmt_conductor->bindParam(':id_conductor', $this->conductor, PDO::PARAM_INT);
    if ($stmt_conductor->execute()) { // Ejecutar
      $num_reg =  $stmt_conductor->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_conductor = $stmt_conductor->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->nombre_conductor = $fila_conductor['ct1_RazonSocial'];
        }
      } else {
        $this->nombre_conductor = null;
      }
    } else {
      $this->nombre_conductor = null;
    }

    //$this->id_producto = $id_producto;

    $this->estado = $estado;
    $this->codigo_remi = $codigo_remi;

    $sql = "UPDATE `ct26_remisiones` SET  ct26_codigo_remi = :codigo_remi, ct26_estado = :estado, ct26_idcliente = :id_cliente, `ct26_nitcliente` = :nit_cliente, `ct26_razon_social` = :razon_social, `ct26_nombre_obra` = :nombre_obra, `ct26_idObra`= :id_obra, `ct26_id_vehiculo` = :id_mixer , `ct26_vehiculo` = :placa_mixer , `ct26_nombre_conductor` = :nombre_conductor, `ct26_conductor`= :id_conductor  WHERE `ct26_id_remision` = :id_remision";


    $stmt = $this->con->prepare($sql);


    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':nit_cliente', $this->nit_cliente, PDO::PARAM_STR);
    $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);


    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
    $stmt->bindParam(':id_mixer', $this->id_mixer, PDO::PARAM_INT);
    $stmt->bindParam(':placa_mixer', $this->placa_mixer, PDO::PARAM_STR);
    $stmt->bindParam(':id_conductor', $this->conductor, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_conductor', $this->nombre_conductor, PDO::PARAM_STR);
    // $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_STR);

    $stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);


    // Ejecutar 
    $result = $stmt->execute();

    //resultado
    return $result;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }
  // function editar_remision($img_remi,$ruta,$id_remision){
  //     $php_fechatime = date("Y-m-d H:i:s");
  //     $date = "".date('Y/m/d h:i:s', time());

  //     $this->id_remision = $id_remision;
  //     $this->img_remi = $img_remi;

  //     $php_fileexten = strrchr($this->img_remi, ".");
  //     $php_serial = strtoupper(substr(hash('sha1', $this->img_remi . $date), 0, 40)) . $php_fileexten;


  //     $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
  //     $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);




  //     $sql = "UPDATE `ct26_remisiones` SET `ct26_imagen_remi` = :img_remi WHERE `ct26_id_remision` = :id_remision";
  //     $stmt = $this->con->prepare($sql);

  //     $stmt->bindParam(':img_remi', $php_tempfoto, PDO::PARAM_STR);

  //     $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
  //   // Ejecutar 
  //   if($result = $stmt->execute()){
  //     $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
  //   }

  //   //Cerrar Conexion
  //   $this->PDO->closePDO();

  //   //resultado
  //   return $result;
  // }

  function subir_remision($codigo_remi, $imagen_remi, $id_cliente, $id_obra, $fecha_remi, $estado, $notificacion, $conductor, $vehiculo)
  {
    $this->codigo_remi = $codigo_remi;
    $this->imagen_remi = $imagen_remi;


    $this->id_cliente = $id_cliente;
    $sql_cli = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
    $stmt_cli = $this->con->prepare($sql_cli);
    $stmt_cli->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    if ($stmt_cli->execute()) { // Ejecutar
      $num_reg =  $stmt_cli->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_cli = $stmt_cli->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->razon_social = $fila_cli['ct1_RazonSocial'];
        }
        //return $datos;
      } else {
        return false;
        $this->razon_social = null;
      }
    } else {
      return false;
      $this->razon_social = null;
    }


    $this->id_obra = $id_obra;
    $sql_obra = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
    //Preparar Conexion
    $stmt_obra = $this->con->prepare($sql_obra);
    $stmt_obra->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);

    if ($stmt_obra->execute()) { // Ejecutar
      $num_reg =  $stmt_obra->rowCount(); // Get Numero de Registros
      if ($num_reg == 1) { // Validar el numero de Registros
        while ($fila_obra = $stmt_obra->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $this->nombre_obra = $fila_obra['ct5_NombreObra'];
        }
      } else {
        return false;
        $this->nombre_obra = null;
      }
    } else {
      return false;
      $this->nombre_obra = null;
    }



    $this->fecha_remi = $fecha_remi;
    $this->estado = $estado;
    $this->notificacion = $notificacion;
    $this->conductor = $conductor;
    $this->vehiculo = $vehiculo;

    $sql = "INSERT INTO `ct26_remisiones`(`ct26_codigo_remi`, `ct26_imagen_remi`,ct26_idcliente, ct26_razon_social , `ct26_idObra`,ct26_nombre_obra ,  `ct26_fecha_remi`, `ct26_estado`,ct26_notificacion, ct26_conductor,ct26_vehiculo) VALUES 
                                (:codigo_remi,:imagen_remi,:id_cliente ,:razon_social , :id_obra,:nombre_obra ,:fecha_remi,:estado,:notificacion,:conductor,:vehiculo)";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':imagen_remi', $this->imagen_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
    $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
    $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_remi', $this->fecha_remi, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
    $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_STR);
    $stmt->bindParam(':conductor', $this->conductor, PDO::PARAM_STR);
    $stmt->bindParam(':vehiculo', $this->vehiculo, PDO::PARAM_STR);

    if ($result = $stmt->execute()) {
      return true;
    } else {
      return false;
    }

    $this->PDO->closePDO();
  }

  function select_remisiones_obra_editFact($id_obra)
  {

    $this->id = $id_obra;
    $sql = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi` FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra  ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    if ($result = $stmt->execute()) {
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
    return $stmt;
  }

  function select_remisiones_obra($id_obra)
  {

    $this->id = $id_obra;
    $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra  ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC";
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

  function seguimiento_remisiones_honda()
  {
    $fechaActual = "" . date('Y-m-d');
    //$fechaActual = "2022-09-30";

    $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_nombre_obra ,ct26_vehiculo, ct26_hora_remi, ct26_hora_salida_planta,ct26_hora_llegada_obra,ct26_hora_inicio_descargue,ct26_hora_terminada_descargue,ct26_hora_llegada_planta,ct26_nombre_conductor   FROM `ct26_remisiones` WHERE ct26_fecha_remi = :fecha_actual  AND ct26_idplanta = 'HND' ORDER BY `ct26_id_remision` DESC LIMIT 5000";
    //$sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_razon_social ,ct26_nombre_obra ,ct26_vehiculo, ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);

    // Ejecutar 
    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      //$hora_actual = date('H:i:s');
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

          if (empty($fila['ct26_hora_salida_planta']) || empty($fila['ct26_hora_llegada_obra']) || empty($fila['ct26_hora_inicio_descargue']) || empty($fila['ct26_hora_terminada_descargue']) || empty($fila['ct26_hora_llegada_planta'])) {
            $datos['ct26_id_remision'] = $fila['ct26_id_remision'];
            $datos['ct26_codigo_remi'] = $fila['ct26_codigo_remi'];
            $datos['ct26_nombre_obra'] = $fila['ct26_nombre_obra'];
            $datos['ct26_vehiculo'] = $fila['ct26_vehiculo'];
            $datos['ct26_hora_remi'] = $fila['ct26_hora_remi'];
            $datos['ct26_nombre_conductor'] = $fila['ct26_nombre_conductor'];
            /**
             * HORA DE SALIDA DE PLANTA
             */
            if (!empty($fila['ct26_hora_salida_planta'])) {
              $datos['ct26_hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_remi']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_salida_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
            /**
             * HORA DE LLEGADA OBRA
             */
            if (!empty($fila['ct26_hora_salida_planta'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_llegada_obra'])) {
                $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_salida_planta']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_llegada_obra'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
            }

            /**
             * HORA DE INICIO DESCARGUE
             */
            if (!empty($fila['ct26_hora_llegada_obra'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_inicio_descargue'])) {
                $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_llegada_obra']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_inicio_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
            }


            /**
             * HORA DE TERMINACION DESCARGUE
             */
            if (!empty($fila['ct26_hora_inicio_descargue'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_terminada_descargue'])) {
                $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_inicio_descargue']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_terminada_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
            }

            /**
             * HORA DE LLEGADA EN PLANTA
             */
            if (!empty($fila['ct26_hora_terminada_descargue'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_llegada_planta'])) {
                $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_terminada_descargue']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_llegada_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
            }

            //$datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
            //$datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
            //$datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
            //$datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
            $datosf[] = $datos;
          }
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

  function seguimiento_remisiones()
  {
    $fechaActual = "" . date('Y-m-d');
    //$fechaActual = "2022-09-30";

    $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_nombre_obra ,ct26_vehiculo,ct26_metros, ct26_hora_remi, ct26_hora_salida_planta,ct26_hora_llegada_obra,ct26_hora_inicio_descargue,ct26_hora_terminada_descargue,ct26_hora_llegada_planta,ct26_nombre_conductor   FROM `ct26_remisiones` WHERE ct26_fecha_remi = :fecha_actual  AND ct26_idplanta <> 'HND'  AND ct26_estado <> '10'  ORDER BY `ct26_id_remision` DESC LIMIT 5000";
    //$sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_razon_social ,ct26_nombre_obra ,ct26_vehiculo, ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':fecha_actual', $fechaActual, PDO::PARAM_STR);

    // Ejecutar 
    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      //$hora_actual = date('H:i:s');
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

          if (empty($fila['ct26_hora_salida_planta']) || empty($fila['ct26_hora_llegada_obra']) || empty($fila['ct26_hora_inicio_descargue']) || empty($fila['ct26_hora_terminada_descargue']) || empty($fila['ct26_hora_llegada_planta'])) {
            $datos['ct26_id_remision'] = $fila['ct26_id_remision'];
            $datos['ct26_codigo_remi'] = $fila['ct26_codigo_remi'];
            $datos['ct26_nombre_obra'] = $fila['ct26_nombre_obra'];
            $datos['ct26_vehiculo'] = $fila['ct26_vehiculo'];
            $datos['ct26_hora_remi'] = $fila['ct26_hora_remi'];
            $datos['ct26_nombre_conductor'] = $fila['ct26_nombre_conductor'];
            $datos['ct26_metros'] = $fila['ct26_metros'];
            /**
             * HORA DE SALIDA DE PLANTA
             */
            if (!empty($fila['ct26_hora_salida_planta'])) {
              $datos['ct26_hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
            } else {
              $hora_actual = "" . date('H:i:s'); // hora actual
              $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
              $hora_remision = $fila['ct26_hora_remi']; // hora primera

              $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
              $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
              $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

              //$hora_diff
              $datos['ct26_hora_salida_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
            }
            /**
             * HORA DE LLEGADA OBRA
             */
            if (!empty($fila['ct26_hora_salida_planta'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_llegada_obra'])) {
                $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_salida_planta']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_llegada_obra'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
            }

            /**
             * HORA DE INICIO DESCARGUE
             */
            if (!empty($fila['ct26_hora_llegada_obra'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_inicio_descargue'])) {
                $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_llegada_obra']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_inicio_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
            }


            /**
             * HORA DE TERMINACION DESCARGUE
             */
            if (!empty($fila['ct26_hora_inicio_descargue'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_terminada_descargue'])) {
                $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_inicio_descargue']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_terminada_descargue'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
            }

            /**
             * HORA DE LLEGADA EN PLANTA
             */
            if (!empty($fila['ct26_hora_terminada_descargue'])) { // verificar el campo anterior
              if (!empty($fila['ct26_hora_llegada_planta'])) {
                $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
              } else {
                $hora_actual = "" . date('H:i:s'); // hora actual
                $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
                $hora_remision = $fila['ct26_hora_terminada_descargue']; // hora primera

                $hora_remi = new DateTime($hora_remision); // conviente la hora remision en formato hora
                $interval = $hora_remi->diff($hora_new); // Obtiene la diferencia de la hora actual 
                $hora_diff = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 

                //$hora_diff
                $datos['ct26_hora_llegada_planta'] =  "<small class='badge badge-danger'><i class='far fa-clock'></i>" . $hora_diff . "</small>";
              }
            } else {
              $datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
            }

            //


            $hora_actual = "" . date('H:i:s'); // hora actual
            $hora_new = new DateTime($hora_actual); // convertir la hora actual en el formato Hora
            $hora_remision2 = $fila['ct26_hora_remi']; // hora primera

            $hora_remi2 = new DateTime($hora_remision2); // conviente la hora remision en formato hora
            $interval = $hora_remi2->diff($hora_new); // Obtiene la diferencia de la hora actual 
            $hora_diff2 = $interval->format("%H:%I:%S"); // se convierte en formato hora, minutos , segundos el resultador de la diferencia 



            $datos['cicloviaje'] = "<small class='badge badge-warning'><i class='far fa-clock'></i>" . $hora_diff2 . "</small>";
            //$datos['ct26_hora_llegada_obra'] = $fila['ct26_hora_llegada_obra'];
            //$datos['ct26_hora_inicio_descargue'] = $fila['ct26_hora_inicio_descargue'];
            //$datos['ct26_hora_terminada_descargue'] = $fila['ct26_hora_terminada_descargue'];
            //$datos['ct26_hora_llegada_planta'] = $fila['ct26_hora_llegada_planta'];
            $datosf[] = $datos;
          }
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


  function select_remisiones_for_table()
  {

    $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_razon_social ,ct26_nombre_obra ,ct26_vehiculo, ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC LIMIT 2000";

    //$sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_razon_social ,ct26_nombre_obra ,ct26_vehiculo, ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    if ($result = $stmt->execute()) {
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
  function select_remisiones_for_table_old()
  {

    $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi, ct26_idObra , ct26_fecha_remi FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC LIMIT 3000";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    if ($result = $stmt->execute()) {
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

  function select_remisiones()
  {
    $sql = "SELECT * FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    $result = $stmt->execute();

    //Cerrar Conexion
    $this->PDO->closePDO();

    //resultado
    return $stmt;
  }

  function get_remi_id($id_remision)
  {
    $this->id = $id_remision;

    $sql = "SELECT * FROM `ct26_remisiones`  WHERE ct26_id_remision = :id_remision ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    if ($result = $stmt->execute()) {
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


  function agregar_copia($hora, $numero_remision, $id_cliente, $id_obra, $doc_remi, $id_vehiculo, $id_conductor, $metros, $id_producto, $asentamiento, $sello, $estado, $hora_salida_planta, $hora_llegada_obra, $hora_inicio_descargue, $hora_terminada_descargue, $hora_llegada_planta, $id_usuario, $nombre_usuario)
  {
    $this->numero_remision = $numero_remision;
    $this->hora = $hora;
    $this->doc = $doc_remi;
    $this->cliente = $id_cliente;
    $this->obra = $id_obra;
    $this->conductor = $id_conductor;
    $this->vehiculo = $id_vehiculo;
    $this->estado = $estado;
    $this->sello = $sello;
    $this->metrosC = $metros;
    $this->producto = $id_producto;
    $this->asentamiento = $asentamiento;
    $this->hora_salida_planta = $hora_salida_planta;
    $this->hora_llegada_obra = $hora_llegada_obra;
    $this->hora_inicio_descargue = $hora_inicio_descargue;
    $this->hora_terminada_descargue = $hora_terminada_descargue;
    $this->hora_llegada_planta = $hora_llegada_planta;
    $this->id_usuario = $id_usuario;
    $this->nombre_usuario = $nombre_usuario;

    $sql = "INSERT INTO `remision_update`(`hora`, `numero_remision`, `id_cliente`, `id_obra`, `doc_remi`, `id_vehiculo`, `id_conductor`, `metros`, `id_producto`, `asentamiento`, `sello`, `estado`, `hora_salida_planta`, `hora_llegada_obra`, `hora_inicio_descargue`, `hora_terminada_descargue`, `hora_llegada_planta`, `id_usuario`, `nombre_usuario`) VALUES (:hora, :numero_remision, :id_cliente, :id_obra, :doc_remi, :id_vehiculo, :id_conductor, :metros, :id_producto, :asentamiento, :sello, :estado, :hora_salida_planta, :hora_llegada_obra, :hora_inicio_descargue, :hora_terminada_descargue, :hora_llegada_planta, :id_usuario, :nombre_usuario)";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
    $stmt->bindParam(':numero_remision', $this->numero_remision, PDO::PARAM_STR);
    $stmt->bindParam(':id_cliente', $this->cliente, PDO::PARAM_STR);
    $stmt->bindParam(':id_obra', $this->obra, PDO::PARAM_STR);
    $stmt->bindParam(':doc_remi', $this->doc, PDO::PARAM_STR);
    $stmt->bindParam(':id_vehiculo', $this->vehiculo, PDO::PARAM_STR);
    $stmt->bindParam(':id_conductor', $this->conductor, PDO::PARAM_STR);
    $stmt->bindParam(':metros', $this->metros, PDO::PARAM_STR);
    $stmt->bindParam(':id_producto', $this->producto, PDO::PARAM_STR);
    $stmt->bindParam(':asentamiento', $this->asentamiento, PDO::PARAM_STR);
    $stmt->bindParam(':sello', $this->sello, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
    $stmt->bindParam(':hora_salida_planta', $this->hora_salida_planta, PDO::PARAM_STR);
    $stmt->bindParam(':hora_llegada_obra', $this->hora_llegada_obra, PDO::PARAM_STR);
    $stmt->bindParam(':hora_inicio_descargue', $this->hora_inicio_descargue, PDO::PARAM_STR);
    $stmt->bindParam(':hora_terminada_descargue', $this->hora_terminada_descargue, PDO::PARAM_STR);
    $stmt->bindParam(':hora_llegada_planta', $this->hora_llegada_planta, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':nombre_usuario', $this->nombre_usuario, PDO::PARAM_STR);

    $result = $stmt->execute();
    return $result;

    $this->PDO->closePDO();
  }

  function get_remision_id($id_remision)
  {
    $this->id = $id_remision;

    $sql = "SELECT * FROM `ct26_remisiones`  WHERE ct26_id_remision = :id_remision ";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    $result = $stmt->execute();

    //Cerrar Conexion
    $this->PDO->closePDO();

    //resultado
    return $stmt;
  }

  function get_datos_for_admin()
  {

    $sql = "SELECT * FROM `ct26_remisiones` WHERE ct26_estado  BETWEEN 2 AND 3 ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC LIMIT 1500";
    //Preparar Conexion
    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    // Ejecutar 
    // Ejecutar 
    if ($result = $stmt->execute()) {
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
    return $stmt;
  }

  function get_datos_for_conductor($id_conductor)
  {
    $this->id = $id_conductor;


    $sql = "SELECT * FROM `ct26_remisiones` WHERE  ct26_conductor = :id_conductor  ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC LIMIT 500";

    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':id_conductor', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    $result = $stmt->execute();

    //Cerrar Conexion
    $this->PDO->closePDO();

    //resultado
    return $stmt;
  }

  function insert_datos_remi($codigo_remi, $fecha, $hora, $cliente, $placa, $obra, $conductor, $planta, $sello, $metrosC, $producto, $asentamiento, $observacion)
  {
    $this->codigo_remi = $codigo_remi;
    $this->fecha = $fecha;
    $this->hora = $hora;
    $this->cliente = $cliente;
    $this->placa = $placa;
    $this->obra = $obra;
    $this->conductor = $conductor;
    $this->planta = $planta;
    $this->sello = $sello;
    $this->metrosC = $metrosC;
    $this->producto = $producto;
    $this->asentamiento = $asentamiento;
    $this->observacion = $observacion;

    $sql = "INSERT INTO `ct26_remisiones`( `ct26_codigo_remi`, `ct26_fecha_remi`, `ct26_hora_remi`, `ct26_cliente_remi`, `ct26_placa`, `ct26_idObra`, `ct26_conductor`, `ct26_planta`, `ct26_sello_seguridad`,  `ct26_metrosC`, `ct26_producto`, `ct26_asentamiento`,  `ct26_observaciones`) VALUES (:codigo_remi, :fecha, :hora, :cliente, :placa, :obra, :conductor, :planta, :sello, :metrosC, :producto, :asentamiento, :observacion)";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':codigo_remi', $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
    $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
    $stmt->bindParam(':cliente', $this->cliente, PDO::PARAM_INT);
    $stmt->bindParam(':placa', $this->placa, PDO::PARAM_INT);
    $stmt->bindParam(':obra', $this->obra, PDO::PARAM_INT);
    $stmt->bindParam(':conductor', $this->conductor, PDO::PARAM_STR);
    $stmt->bindParam(':planta', $this->planta, PDO::PARAM_STR);
    $stmt->bindParam(':sello', $this->sello, PDO::PARAM_INT);
    $stmt->bindParam(':metrosC', $this->metrosC, PDO::PARAM_INT);
    $stmt->bindParam(':producto', $this->producto, PDO::PARAM_INT);
    $stmt->bindParam(':asentamiento', $this->asentamiento, PDO::PARAM_STR);
    $stmt->bindParam(':observacion', $this->observacion, PDO::PARAM_STR);

    $result = $stmt->execute();
    return $result;

    $this->PDO->closePDO();
  }
}
