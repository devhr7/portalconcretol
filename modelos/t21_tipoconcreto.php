<?php
class t21_tipoconcreto extends conexionPDO
{
    protected $PDO;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function get_tipoconcreto($id = null)
    {
        $rowsArray_TipoConcreto = '<option value="NULL">Seleccionar Tipo Concreto </option>';

        $sql = "SELECT  `ct21_IdTipoConcreto`,`ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto` WHERE ct21_estado = 1 ORDER BY `ct21_IdTipoConcreto` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;

                    if ($id == $fila['ct21_IdTipoConcreto']) {
                        $selection_tipo_concreto = "selected='true'";
                    } else {
                        $selection_tipo_concreto = "";
                    }
        
                    $rowsArray_TipoConcreto .= '<option value="' . $fila['ct21_IdTipoConcreto'] . '" ' . $selection_tipo_concreto . ' >' . $fila['ct21_CodTConcreto'] . " - " . $fila['ct21_DescripcionTC'] . '</option>';
                }
                return $rowsArray_TipoConcreto;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    
    //Esta funcion trae los datos del tipo del concreto condicionado que el estado sea activo (1) y el id buscado.
    function get_tipoconcreto_id($id)
    {
        $this->id = $id;
        $sql = "SELECT  `ct21_IdTipoConcreto`,`ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto` WHERE ct21_estado = 1 AND `ct21_IdTipoConcreto` = :id ORDER BY `ct21_IdTipoConcreto` DESC";
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

    //Con esta funcion se crean los tipos de concreto y para ello se usan los parametros ct21_CodTConcreto y ct21_DescripcionTC, la fecha de creacion y el estado vienen por defecto.
    function crear_tipo_concreto($ct21_CodTConcreto, $ct21_DescripcionTC)
    {
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->ct21_CodTConcreto = $ct21_CodTConcreto;
        $this->ct21_DescripcionTC = $ct21_DescripcionTC;

        $sql = "INSERT INTO `ct21_tipoconcreto`(`ct21_FechaCreacion`, `ct21_estado`, `ct21_CodTConcreto`, `ct21_DescripcionTC`) VALUES (:ct21_FechaCreacion, :ct21_estado, :ct21_CodTConcreto, :ct21_DescripcionTC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct21_FechaCreacion', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct21_CodTConcreto', $this->ct21_CodTConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_DescripcionTC', $this->ct21_DescripcionTC, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    //Esta funcion permite modificar los datos del tipo de concreto y se usan los parametros como el id, ct21_CodTConcreto y ct21_DescripcionTC y este va condicionado con el id.
    function modificar_tipo_concreto($id, $ct21_CodTConcreto, $ct21_DescripcionTC)
    {
        $this->ct21_CodTConcreto = $ct21_CodTConcreto;
        $this->ct21_DescripcionTC = $ct21_DescripcionTC;
        $this->id = $id;

        $sql = "UPDATE `ct21_tipoconcreto` SET `ct21_CodTConcreto`= :ct21_CodTConcreto,`ct21_DescripcionTC`= :ct21_DescripcionTC WHERE `ct21_IdTipoConcreto` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct21_CodTConcreto', $this->ct21_CodTConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_DescripcionTC', $this->ct21_DescripcionTC, PDO::PARAM_STR);
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


    //Esta funcion permite eliminar los datos de tipo de concreto y tiene un parametro que es el id y ese mismo se usa como condicional para eliminar los datos.
    function eliminar_tipo_concreto($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct21_tipoconcreto` WHERE `ct21_IdTipoConcreto` = :id";
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
    

    //En esta funcion se buscan todos los datos de la tabla tipo de concreto
    function get_datatable_tipo_concreto()
    {
        $sql = "SELECT `ct21_IdTipoConcreto`, `ct21_FechaCreacion`, `ct21_estado`, `ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct21_IdTipoConcreto'];
                    $datos['cod'] = $fila['ct21_CodTConcreto'];
                    $datos['descripcion'] = $fila['ct21_DescripcionTC'];
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
