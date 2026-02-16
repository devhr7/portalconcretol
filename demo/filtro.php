<?php

class filtro extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function buscar_batch($fecha_inicio,$fecha_final,$nit,$codigo_formula)
    {
        $this->fecha_inicio =$fecha_inicio;
        $this->fecha_final =$fecha_final;
        $this->nit =$nit;
        $this->codigo_formula =$codigo_formula;

        if (true) {
            $sql = "SELECT `ct29_Remision`, `ct29_CodigoFormula`, `ct29_NombreFormula`, `ct29_DescripcionFormula`, `ct29_MetrosCubicos`, `ct29_IdCliente` FROM `ct29_batch` WHERE `ct29_Fecha` BETWEEN :fecha_inicio AND :fecha_final AND `ct29_NIT` LIKE :nit AND `ct29_CodigoFormula` = :codigo_formula ORDER BY `ct29_MetrosCubicos` ASC ";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            //insertar parametros
            $stmt->bindParam(':fecha_inicio', $this->fecha_inicio, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_final', $this->fecha_final, PDO::PARAM_STR);
            $stmt->bindParam(':nit', $this->nit, PDO::PARAM_STR);
            $stmt->bindParam(':codigo_formula', $this->codigo_formula, PDO::PARAM_STR);
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
        } else {
            return false;
        }
    }

    function buscar_nombre_factura($id_factura)
    {
        $this->id_factura = intval($id_factura);
        if ($this->id_factura) {
            $sql = "SELECT `ct27_nombre_factura` FROM `ct27_facturae` WHERE `ct27_id_factura` = :id_factura";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            //insertar parametros
            $stmt->bindParam(':id_factura', $this->id_factura, PDO::PARAM_INT);
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
        } else {
            return false;
        }
    }

    function buscar_id_factura($id_remision)
    {
        $this->id_remision = intval($id_remision);
        if ($this->id_remision) {
            $sql = "SELECT `ct28_id_fact` FROM `ct28_factura_remi` WHERE `ct28_id_remision`= :id_remision";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            //insertar parametros
            $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
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
        } else {
            return false;
        }
    }

    function get_id_remision($remision)
    {
        $this->remision = intval($remision);
        if ($this->remision) {
            $sql = "SELECT `ct26_id_remision` FROM `ct26_remisiones` WHERE `ct26_codigo_remi` = :codigo_remi";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            //insertar parametros
            $stmt->bindParam(':codigo_remi', $this->remision, PDO::PARAM_INT);
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
        } else {
            return false;
        }
    }
}
