<?php

class t29_batch extends conexionPDO
{

  public $id;
  protected $PDO;
  public $con;

  public function __construct()
  {

    $this->PDO = new conexionPDO();
    $this->con = $this->PDO->connect();
  }


  public function adicionar_id_remision($id_batch, $id_remision)
  {
    $sql = "UPDATE `ct29_batch` SET `Id_remision`= :id_remision WHERE `ct29_Id` = :id_batch ";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);
    $stmt->bindParam(':id_batch', $id_batch, PDO::PARAM_STR);
    if ($result = $stmt->execute()) {
    }
  }


  public static function select_ultimo($con, $num_remision)
  {
    $num_remision = intval($num_remision);
    $sql = "SELECT ct29_IdPlanta FROM `ct29_batch` WHERE `ct29_Remision` = :num_remision ORDER BY `ct29_batch`.`ct29_Id` DESC  LIMIT 1";
    //Prepara la conexion
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':num_remision', $num_remision, PDO::PARAM_STR);

    if ($result = $stmt->execute()) {
      $num_reg =  $stmt->rowCount();
      if ($num_reg > 0) {
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
          $id_planta = $fila['ct29_IdPlanta'];
        }
        return $id_planta;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }



  function anular_batch($id_batch)
  {
    $this->estado = 2;
    $this->id_batch = $id_batch;
    //UPDATE `ct29_batch` SET `ct29_estado` = '2' WHERE `ct29_batch`.`ct29_Id` = 1113;
    $sql = "UPDATE `ct29_batch` SET `ct29_estado` = 2   WHERE `ct29_batch`.`ct29_Id` = :id_batch";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_batch', $this->id_batch, PDO::PARAM_INT);


    if ($result = $stmt->execute()) {
      return $result;
    } else {
      return false;
    }
    // Cerrar Conexion
    $this->PDO->closePDO();
  }
  function habilitar_batch($id_batch)
  {
    $this->estado = 1;
    $this->id_batch = $id_batch;
    //UPDATE `ct29_batch` SET `ct29_estado` = '2' WHERE `ct29_batch`.`ct29_Id` = 1113;
    $sql = "UPDATE `ct29_batch` SET `ct29_estado` = 2   WHERE `ct29_batch`.`ct29_Id` = :id_batch";
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':id_batch', $this->id_batch, PDO::PARAM_INT);


    if ($result = $stmt->execute()) {
      return $result;
    } else {
      return false;
    }
    // Cerrar Conexion
    $this->PDO->closePDO();
  }



  function select_batch_cancelado()
  {

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,`ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`, `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_BatchStatus` = 'Cancelado por usuario' ORDER BY `ct29_batch`.`ct29_Id` DESC LIMIT 500";

    $stmt = $this->con->prepare($sql);
    //  $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
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




    //resultado
    //return $stmt;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }


  function select_batch_remi2_cancel($remision)
  {

    $this->id = intval($remision);

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision AND  `ct29_BatchStatus` = 'Cancelado por usuario' ORDER BY `ct29_batch`.`ct29_Id` ASC ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }

  function select_batch_remi2($remision)
  {

    $this->id = intval($remision);

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,ct29_CodigoCliente,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision  AND  	`ct29_estado`  = 1  ORDER BY `ct29_batch`.`ct29_Id` ASC ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }

  function select_batch_buscador($fecha, $codigo_remi)
  {

    $this->codigo_remi = "'%" . $codigo_remi . "%'";
    $this->fecha_batch = "'%" . $fecha . "%'";


    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,`ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`, `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Asentamiento` FROM `ct29_batch` WHERE  `ct29_Remision` LIKE '%" . $this->codigo_remi . "%' AND `ct29_Fecha` LIKE '%" . "%' ORDER BY `ct29_batch`.`ct29_Id` ";
    // SELECT * FROM `ct29_batch` WHERE `ct29_Remision` LIKE '%65915%' AND `ct29_Fecha` LIKE '%2020-09-17%'
    $stmt = $this->con->prepare($sql);

    $stmt->bindParam(':codigo_remision',  $this->codigo_remi, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_batch', $this->fecha_batch, PDO::PARAM_STR);
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




    //resultado
    //return $stmt;

    //Cerrar Conexion
    $this->PDO->closePDO();
  }

  function select_batch_date($fecha_report)
  {

    $this->fecha_report = $fecha_report;

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Fecha` = :fecha_remision AND   `ct29_BatchStatus` = 'Realizado'";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':fecha_remision', $this->fecha_report, PDO::PARAM_STR);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }

  function crear_consolidado_remision_para_batches($id_batch, $consolidado_remi)
  {
    $sql = "UPDATE `ct29_batch` SET `consolidado_remi`= :consolidado_remi WHERE `ct29_Id` = :id_batch";
    $stmt = $this->con->prepare($sql);
    $stmt->bindParam(':consolidado_remi', $consolidado_remi, PDO::PARAM_STR);
    $stmt->bindParam(':id_batch', $id_batch, PDO::PARAM_INT);
    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }


  function select_batch_remi($remision)
  {

    $this->id = intval($remision);
    $id_planta = SELF::select_ultimo($this->con, intval($remision));

    $sql = "SELECT `ct29_Id`,ct29_estado, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision  AND ct29_IdPlanta = :id_planta  ORDER BY `ct29_batch`.`ct29_Id` ASC ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':remision', $this->id, PDO::PARAM_INT);
    $stmt->bindParam(':id_planta', $id_planta, PDO::PARAM_STR);
    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }


  function select_batch_remi_cancel($remision)
  {

    $this->id = intval($remision);

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision  AND  `ct29_BatchStatus` =  'Cancelado por usuario' ORDER BY `ct29_batch`.`ct29_Id` DESC ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':remision', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }

  function select_batch_id_cancel($id_batch)
  {

    $this->id = intval($id_batch);

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Id` = :id_batch AND  `ct29_BatchStatus` = 'Cancelado por usuario' ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':id_batch', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }


  function select_batch_id($id_batch)
  {

    $this->id = intval($id_batch);

    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,
  `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,
  `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Id` = :id_batch  ";
    //Prepara la conexion
    $stmt = $this->con->prepare($sql);
    // Asignar Datos ARRAY => SQL
    $stmt->bindParam(':id_batch', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    //  $result = $stmt->execute();
    //Ejecuta 
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
    return $stmt;
    // Cerrar Conexion
    $this->PDO->closePDO();
  }


  function get_datos_batch($id_batch)
  {
    $this->id = $id_batch;

    $sql = "SELECT * FROM `ct29_batch`  WHERE ct29_Id = :id_batch";

    $stmt = $this->con->prepare($sql);

    // Asignando Datos ARRAY => SQL
    $stmt->bindParam(':id_batch', $this->id, PDO::PARAM_INT);

    // Ejecutar 
    $result = $stmt->execute();



    //resultado
    return $stmt;
  }

  function select_batch_table()
  {
    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`,`ct29_IdCliente`,`ct29_IdObra` FROM `ct29_batch`  ORDER BY `ct29_batch`.`ct29_Id` DESC LIMIT 10000";
    $stmt = $this->con->prepare($sql);
    //  $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
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

  function datatable_batch()
  {
    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_IdMixer`,`ct29_IdCliente`,`ct29_IdObra`,  `ct29_IdPlanta` FROM `ct29_batch`  ORDER BY `ct29_batch`.`ct29_Id` DESC LIMIT 3000";
    $stmt = $this->con->prepare($sql);
    //  $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
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

  function select_batch()
  {
    $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,`ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`, `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Asentamiento` FROM `ct29_batch`  ORDER BY `ct29_batch`.`ct29_Id` DESC LIMIT 5000";
    $stmt = $this->con->prepare($sql);
    //  $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
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

  function select_cliente_edit($id_cliente)
  {
    $id = $id_cliente;
    $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
    $sql = "SELECT * FROM ct29_batch WHERE ct29_Id = :id_cliente";
    $stmt = $this->con->prepare($sql);
    $result = $stmt->execute();

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if ($id_cliente == $fila['ct29_Id']) {
        $selection = "selected='true'";
      } else {
        $selection = "";
      }
      $option .= '<option value="' . $fila['ct29_IdCliente'] . '"  </option>';
    }

    //Cerrar Conexion
    $this->PDO->closePDO();

    //resultado
    return $option;
  }
}
