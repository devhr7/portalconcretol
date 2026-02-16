<?php

class modelo_batch extends conexionPDO

{





    public $con;
    protected $PDO;


    public function __construct()

    {



        $this->PDO = new conexionPDO();

        $this->con = $this->PDO->connect();

    }



    public static function select_codremi_bath($con, $numero_remision, $id_planta)

    {

        $sql = "SELECT ct26_id_remision as id_remision, ct26_remisiones.ct26_estado as estado, ct26_remisiones.ct26_idcliente as id_cliente, ct1_terceros.ct1_NumeroIdentificacion as numero_identificacion, ct1_terceros.ct1_RazonSocial as nombre_cliente, ct5_obras.ct5_NombreObra as nombreObra, ct26_bomba as nombre_bomba, ct26_op_bomba as op_bomba, ct26_aux_bomba as aux_bomba,ct26_despachador as despachador,`ct26_observaciones` as obs,`ct26_observaciones_desp` as obs_desp,`ct26_observaciones_cli`as obs_cli

        FROM ct26_remisiones INNER JOIN ct1_terceros ON ct26_remisiones.ct26_idcliente = ct1_terceros.ct1_IdTerceros INNER JOIN ct5_obras ON ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras  WHERE `ct26_idplanta` = :id_planta AND `ct26_codigo_remi` = :cod_remi LIMIT 1 ";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id_planta', $id_planta, PDO::PARAM_STR);

        $stmt->bindParam(':cod_remi', $numero_remision, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {

            $num_reg =  $stmt->rowCount();

            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

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



    public function novedades_remi( $id_remision)

    {

        $id_remision = (int)$id_remision;

        $sql = "SELECT `ct44_novedades` FROM `ct44_novedades_remi` WHERE `ct44_id_remi` = :id_remision";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);

        if( $result = $stmt->execute()){ // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if($num_reg >= 1){ // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $datos[] = $fila;            

                }

                return $datos;  

            }else{

                return false;

            }

        }else{

            return false;

        }



    }





    public static function select_remisiones_for_batch($con, $cod_remision)

{

        $sql="";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':cod_remi', $cod_remision, PDO::PARAM_INT);



}



    function select_batches_informe($fecha_ini, $fecha_fin)

    {

        $this->fecha_ini = $fecha_ini;

        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT ct29_Id, ct29_idBatch,	ct29_estado,	ct29_Remision,	ct29_Fecha,	ct29_Hora,	ct29_CodigoFormula,	ct29_NombreFormula,	ct29_DescripcionFormula,	ct29_MetrosCubicos,	ct29_TAgregado1,	ct29_TAgregado2,	ct29_TAgregado3,	ct29_TAgregado4,	ct29_TCemento1,	ct29_TCemento2,	ct29_TCemento3,	ct29_TAditivo1,	ct29_TAditivo2,	ct29_TAditivo3,	ct29_TAditivo4,	ct29_TAgua,	ct29_RAgregado1,	ct29_RAgregado2,	ct29_RAgregado3,	ct29_RAgregado4,	ct29_RCemento1,	ct29_RCemento2,	ct29_RCemento3,	ct29_RAditivo1,	ct29_RAditivo2,	ct29_RAditivo3,	ct29_RAditivo4,	ct29_RAgua, ct29_NameAG1,	ct29_NameAG2,	ct29_NameAG3,	ct29_NameAG4,	ct29_NameCemento1,	ct29_NameCemento2,	ct29_NameCemento3,	ct29_NameAD1,	ct29_NameAD2,	ct29_NameAD3,	ct29_NameAD4,	ct29_NameAgua,	ct29_IdPlanta

        FROM `ct29_batch`  WHERE ct29_batch.ct29_estado = 1 AND `ct29_Fecha` BETWEEN :fecha_ini AND  :fecha_fin  ";

        //Prepara la conexion

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);



        if ($result = $stmt->execute()) {

            $num_reg =  $stmt->rowCount();

            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $datos_batch['id'] = $fila['ct29_Id'];

                    $datos_batch['estado'] = $fila['ct29_estado'];

                    $datos_batch['remision'] = $fila['ct29_Remision'];





                    $datos_batch['fecha'] = $fila['ct29_Fecha'];

                    $datos_batch['hora'] = $fila['ct29_Hora'];

                    $datos_batch['codigo_formula'] = $fila['ct29_CodigoFormula'];

                    $datos_batch['nombre_formula'] = $fila['ct29_NombreFormula'];

                    $datos_batch['descripcion_formula'] = $fila['ct29_DescripcionFormula'];

                    $datos_batch['metros'] = $fila['ct29_MetrosCubicos'];

                    $datos_batch['planta'] = $fila['ct29_IdPlanta'];



                    $datos2 = SELF::select_codremi_bath($this->con, $fila['ct29_Remision'], $fila['ct29_IdPlanta']);



                    if (is_array($datos2)) {

                        foreach ($datos2 as $key) {

                            $datos_batch['estado'] = $key['estado'];

                            $datos_batch['id_cliente'] = $key['id_cliente'];

                            $datos_batch['numero_identificacion'] = $key['numero_identificacion'];

                            $datos_batch['nombre_cliente'] = $key['nombre_cliente'];

                            $datos_batch['nombreObra'] = $key['nombreObra'];

                            $datos_batch['nombre_bomba'] = $key['nombre_bomba'];

                            $datos_batch['op_bomba'] = $key['op_bomba'];

                            $datos_batch['aux_bomba'] = $key['aux_bomba'];

                            $datos_batch['obs'] = $key['obs'];

                            $datos_batch['obs_desp'] = $key['obs_desp'];

                            $datos_batch['obs_cli'] = $key['obs_cli'];

                            $datos_batch['despachador'] = $key['despachador'];

                            $datos_batch['id_remision'] = $key['id_remision'];



                        }

                    } else {

                        $datos_batch['estado']   = '';               

                        $datos_batch['id_cliente']    = '';         

                        $datos_batch['numero_identificacion'] = '';

                        $datos_batch['nombre_cliente']    = '';  

                        $datos_batch['nombreObra'] = '';   

                        $datos_batch['nombre_bomba'] = '';   

                            $datos_batch['op_bomba'] = '';   

                            $datos_batch['aux_bomba'] = '';

                            $datos_batch['obs'] = '';

                            $datos_batch['obs_desp'] = '';

                            $datos_batch['obs_cli'] = '';

                            $datos_batch['despachador'] = '';   

                            $datos_batch['id_remision'] = ''; 

                                   

                    }



                    $datos_batch['t_agregado1'] = $fila['ct29_TAgregado1'];

                    $datos_batch['t_agregado2'] = $fila['ct29_TAgregado2'];

                    $datos_batch['t_agregado3'] = $fila['ct29_TAgregado3'];

                    $datos_batch['t_agregado4'] = $fila['ct29_TAgregado4'];

                    $datos_batch['t_cemento1'] = $fila['ct29_TCemento1'];

                    $datos_batch['t_cemento2'] = $fila['ct29_TCemento2'];

                    $datos_batch['t_cemento3'] = $fila['ct29_TCemento3'];

                    $datos_batch['t_adictivo1'] = $fila['ct29_TAditivo1'];

                    $datos_batch['t_adictivo2'] = $fila['ct29_TAditivo2'];

                    $datos_batch['t_adictivo3'] = $fila['ct29_TAditivo3'];

                    $datos_batch['t_adictivo4'] = $fila['ct29_TAditivo4'];

                    $datos_batch['t_agua'] = $fila['ct29_TAgua'];

                    $datos_batch['r_agregado1'] = $fila['ct29_RAgregado1'];

                    $datos_batch['r_agregado2'] = $fila['ct29_RAgregado2'];

                    $datos_batch['r_agregado3'] = $fila['ct29_RAgregado3'];

                    $datos_batch['r_agregado4'] = $fila['ct29_RAgregado4'];

                    $datos_batch['r_cemento1'] = $fila['ct29_RCemento1'];

                    $datos_batch['r_cemento2'] = $fila['ct29_RCemento2'];

                    $datos_batch['r_cemento3'] = $fila['ct29_RCemento3'];

                    $datos_batch['r_adictivo1'] = $fila['ct29_RAditivo1'];

                    $datos_batch['r_adictivo2'] = $fila['ct29_RAditivo2'];

                    $datos_batch['r_adictivo3'] = $fila['ct29_RAditivo3'];

                    $datos_batch['r_adictivo4'] = $fila['ct29_RAditivo4'];

                    $datos_batch['r_agua'] = $fila['ct29_RAgua'];

                    $datos_batch['n_agregado1'] = $fila['ct29_NameAG1'];

                    $datos_batch['n_agregado2'] = $fila['ct29_NameAG2'];

                    $datos_batch['n_agregado3'] = $fila['ct29_NameAG3'];

                    $datos_batch['n_agregado4'] = $fila['ct29_NameAG4'];

                    $datos_batch['n_cemento1'] = $fila['ct29_NameCemento1'];

                    $datos_batch['n_cemento2'] = $fila['ct29_NameCemento2'];

                    $datos_batch['n_cemento3'] = $fila['ct29_NameCemento3'];

                    $datos_batch['n_adictivo1'] = $fila['ct29_NameAD1'];

                    $datos_batch['n_adictivo2'] = $fila['ct29_NameAD2'];

                    $datos_batch['n_adictivo3'] = $fila['ct29_NameAD3'];

                    $datos_batch['n_adictivo4'] = $fila['ct29_NameAD4'];

                    $datos_batch['n_agua'] = $fila['ct29_NameAgua'];



                    $datos[] = $datos_batch;

                }

                return $datos;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }





    function select_batch_remi_vew($remision)

    {



        $this->id = intval($remision);

        $id_planta = SELF::select_ultimo($this->con, intval($remision));



        $sql = "SELECT `ct29_Id`,ct29_estado, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,

    `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,

    `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision  AND ct29_IdPlanta = :id_planta AND ct29_estado = 1  ORDER BY `ct29_batch`.`ct29_Id` DESC ";

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



    function get_remision_batch_id($id_batch)

    {



        $this->id = intval($id_batch);



        $sql = "SELECT `ct29_Remision` FROM `ct29_batch` WHERE `ct29_Id` = :id_batch    ORDER BY `ct29_batch`.`ct29_Id` ASC    ";

        //Prepara la conexion

        $stmt = $this->con->prepare($sql);

        // Asignar Datos ARRAY => SQL

        $stmt->bindParam(':id_batch', $this->id, PDO::PARAM_INT);





        //Ejecuta 

        if ($result = $stmt->execute()) {

            $num_reg =  $stmt->rowCount();

            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $numero_remision = $fila['ct29_Remision'];

                }

                return $numero_remision;

            } else {

                return false;

            }

        } else {

            return false;

        }



        // Cerrar Conexion

        $this->PDO->closePDO();

    }



    function select_batch_remi($remision, $estado = null)

    {



        $this->id = intval($remision);

        $id_planta = SELF::select_ultimo($this->con, intval($remision));



        $sql = "SELECT `ct29_Id`,ct29_estado, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`,

    `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`,

    `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Remision` = :remision  AND ct29_IdPlanta = :id_planta   ORDER BY `ct29_batch`.`ct29_Id` DESC ";

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



    function select_batch_id($id_batch)

    {



        $this->id = intval($id_batch);



        $sql = "SELECT `ct29_Id`, `ct29_Remision`, `ct29_Fecha`, `ct29_Hora`,`ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`, `ct29_MetrosCubicos`, `ct29_IdMixer`,`ct29_MixerDriver`,`ct29_IdCliente`,`ct29_NIT`,`ct29_DireccionCliente`,`ct29_IdObra`, `ct29_CodigoObra`,`ct29_DireccionObra`, `ct29_NumeroSello`,`ct29_OBSERVACIONES`,`ct29_IdPlanta`, `ct29_Responsable`,`ct29_NumeroCilindro`, `ct29_Asentamiento` FROM `ct29_batch` WHERE `ct29_Id` = :id_batch  AND  	`ct29_estado`  = 1  ORDER BY `ct29_batch`.`ct29_Id` ASC ";

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

}