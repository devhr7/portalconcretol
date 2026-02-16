<?php
class t22_resistencia_concre extends conexionPDO
{

    protected $con;
    protected $PDO;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    //Con esta funcion se crean la resistencia del concreto y para ello se usan los parametros cod y descripcion, la fecha de creacion y el estado vienen por defecto.
    function crear_resistencia_concreto($cod, $descripcion)
    {
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->cod = $cod;
        $this->descripcion = $descripcion;
        $sql = "INSERT INTO `ct22_resistenciaconcreto`( `ct22_FechaCreacion`, `ct22_estado`, `ct22_CodResistenciaConcreto`, `ct22_DescripcionRC`) VALUES (:fecha_create, :estado, :cod , :descripcion)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':cod', $this->cod, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Esta funcion permite modificar los datos de la resistencia del concreto y se usan los parametros como el id, ct22_CodResistenciaConcreto y ct22_DescripcionRC y este va condicionado con el id.
    function modificar_resistencia_concreto($id, $ct22_CodResistenciaConcreto, $ct22_DescripcionRC)
    {
        $this->ct22_CodResistenciaConcreto = $ct22_CodResistenciaConcreto;
        $this->ct22_DescripcionRC = $ct22_DescripcionRC;
        $this->id = $id;

        $sql = "UPDATE `ct22_resistenciaconcreto` SET `ct22_CodResistenciaConcreto`= :ct22_CodResistenciaConcreto,`ct22_DescripcionRC`= :ct22_DescripcionRC WHERE `ct22_IdResistenciaConcreto` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct22_CodResistenciaConcreto', $this->ct22_CodResistenciaConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct22_DescripcionRC', $this->ct22_DescripcionRC, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }

    //Esta funcion permite eliminar los datos de la resistencia del concreto y tiene un parametro que es el id y ese mismo se usa como condicional para eliminar los datos.
    function eliminar_resistencia_concreto($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct22_resistenciaconcreto` WHERE `ct22_IdResistenciaConcreto` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    //En esta funcion se buscan todos los datos de la tabla resistencia del concreto
    function get_datatable_resistencia_concreto()
    {
        $sql = "SELECT `ct22_IdResistenciaConcreto`, `ct22_FechaCreacion`, `ct22_estado`, `ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct22_IdResistenciaConcreto'];
                    $datos['cod'] = $fila['ct22_CodResistenciaConcreto'];
                    $datos['descripcion'] = $fila['ct22_DescripcionRC'];
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

     //Esta funcion trae los datos de la resistencia del concreto condicionado que el estado sea activo (1) y el id buscado.
    function get_resistencia_concre_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct22_IdResistenciaConcreto`,`ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`  WHERE `ct22_estado` = 1 AND  ct22_IdResistenciaConcreto = :id ORDER BY `ct22_IdResistenciaConcreto` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

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

    function get_resistencia_concre($id = null)
    {
        $rowsArray_Resistencia = '<option value="NULL">Seleccionar resistencia Concreto</option>';

        $sql = "SELECT `ct22_IdResistenciaConcreto`,`ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`  WHERE `ct22_estado` = 1 ORDER BY `ct22_IdResistenciaConcreto` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                        //selected
                        if ($id == $fila['ct22_IdResistenciaConcreto']) {
                            $selection_resistencia_concre = "selected='true'";
                        } else {
                            $selection_resistencia_concre = "";
                        }
                        $rowsArray_Resistencia .= '<option value="' . $fila['ct22_IdResistenciaConcreto'] . '"  ' . $selection_resistencia_concre . ' >' . $fila['ct22_CodResistenciaConcreto'] . " - " . $fila['ct22_DescripcionRC'] . '</option>';
                    
                   
                }
                return $rowsArray_Resistencia;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }
}
