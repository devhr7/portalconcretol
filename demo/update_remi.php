<?php

class update_remi extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }



    public static function nombre_cliente($con, $id_cliente){
        $sql="SELECT `ct1_NumeroIdentificacion`,`ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id_cliente, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
                
            } else {
                return false;
            }
        }
    }


    public static function identificacion_cliente($con,$id_cliente){
        $sql="SELECT `ct1_NumeroIdentificacion`,`ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id_cliente, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_NumeroIdentificacion'];
                }
                
            } else {
                return false;
            }
        }
    }


    public static function nombre_obra($con,$id_obra){
        
        $sql="SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id_obra, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct5_NombreObra'];
                }
                
            } else {
                return false;
            }
        }
    }


    public static function actualizar_remiweb($con,$nit,$nombre_cliente,$nombre_obra,$id_remision){
        
        $sql="UPDATE `ct26_remisiones` SET `ct26_nitcliente` = :nit, `ct26_razon_social` = :nombre_cliente, `ct26_nombre_obra` =:nombre_obra WHERE `ct26_id_remision` =  :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nit', $nit, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id_remision, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            return true;
        }
    }



    function actualizar_nombres_cliente_obra($fecha_ini, $fecha_fin)
    {
        $sql="SELECT `ct26_id_remision`,ct26_codigo_remi,  `ct26_idcliente`, `ct26_idObra`  FROM `ct26_remisiones`  WHERE `ct26_fecha_remi` BETWEEN '2023-01-01' AND '2023-2-9'";
        
        $stmt = $this->con->prepare($sql);
        //insertar parametros
        //$stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        //$stmt->bindParam(':fecha_final', $fecha_final, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $id_remision = $fila['ct26_id_remision'];
                    $cod_remision = $fila['ct26_codigo_remi'];
                    $id_cliente = $fila['ct26_idcliente'];
                    $nombre_cliente = SELF::nombre_cliente($this->con,$id_cliente);
                    $identificacionCliente = SELF::identificacion_cliente($this->con,$id_cliente);
                    $id_obra = $fila['ct26_idObra'];
                    $nombre_obra = SELF::nombre_obra($this->con,$id_obra);

                    if( SELF::actualizar_remiweb($this->con,$identificacionCliente,$nombre_cliente,$nombre_obra,$id_remision))
                    {
                        $result2[]= "La remision " . $cod_remision . " Se actualizo Correctamente. ". "nombre_cliente " . $nombre_cliente;

                    }else{
                        $result2[]= "La remision " . $cod_remision . " Error Al actualizar";
                    }
                }

                return $result2;
                
            } else {
                return "Errorrrrr";
            }
        }

    }




}
