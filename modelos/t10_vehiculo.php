<?php
class t10_vehiculo extends conexionPDO
{

    protected $con;
    private $id;
    protected $PDO;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function select_vehiculo_edit($placa = null)
    {
        $this->placa = $placa;
        $option = "<option  selected='true'  value='0'> Seleccione un Vehiculo</option>";

            $sql = "SELECT `ct10_IdVehiculo`, `ct10_Placa` FROM `ct10_vehiculo` ";
            $stmt = $this->con->prepare($sql);
       

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    if ($this->placa == $fila['ct10_Placa']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct10_IdVehiculo'] . '" ' . $selection . ' >' . $fila['ct10_Placa']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
        }
        return $option;
    }


    function select_mixer_edit($id_mixer = null)
    {
        $this->id_mixer = $id_mixer;
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Vehiculo</option>";
        $sql = "SELECT `ct10_IdVehiculo`, `ct10_Placa` FROM `ct10_vehiculo`";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    if ($this->id_mixer == $fila['ct10_IdVehiculo']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct10_IdVehiculo'] . '" ' . $selection . ' >' . $fila['ct10_Placa']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Vehiculos</option>";
        }
        return $option;
    }

    function buscarvehiculo($placa)
    {
        $this->placa = $placa;
        $sql = "SELECT `ct10_IdVehiculo` FROM `ct10_vehiculo` WHERE `ct10_Placa` = :Placa";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':Placa', $this->placa, PDO::PARAM_STR);


        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                //return $datos;

                foreach ($datos as $fila) {
                    return  $fila['ct10_IdVehiculo'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

        $this->PDO->closePDO();
    }


    function insertarVehiculos($letras, $num)
    {
        // Asignacion de Variables
        $this->fecha_creacion = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->letras = strtoupper($letras);
        $this->num = intval($num);
        $this->placa = $letras . $num;
        //SQL
        $sql = "INSERT INTO ct10_vehiculo(ct10_FechaCreacion,ct10_Estado, ct10_Placa,ct10_letras,ct10_num) VALUES (:FechaCreacion, :Estado, :Placa,:letras,:num)";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':Estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':Placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':letras', $letras, PDO::PARAM_STR);
        $stmt->bindParam(':num', $num, PDO::PARAM_STR);

        // Ejecutar 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // Devolver el ultimo Registro insertado
        $id_insert = $this->con->lastInsertId();

        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        // return $id_insert;
    }

    function select_conductor()
    {
        $option = "<option> Seleccione un Vehiculo</option>";
        $sql = "SELECT * FROM `ct10_vehiculo` WHERE `ct10_Estado` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $option .= '<option value="' . $fila['ct10_IdVehiculo'] . '" >' . $fila['ct10_Placa'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function asignar_conductor($id_vehiculo, $id_conductor)
    {

        $this->id = $id_vehiculo;
        $this->conductor = $id_conductor;

        $sql = "UPDATE ct10_vehiculo SET ct10_conductor_asignado = :Coductor WHERE ct10_IdVehiculo = :id_vehiculo ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_vehiculo', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':Coductor', $this->conductor, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        $id_insert = $this->con->lastInsertId();

        //Cerrar Conexion
        $this->PDO->closePDO();
        return $result;
    }

    function select_vehiculos_id($id)
    {
        // Asignacion de Variables
        $this->id = $id;

        //SQL
        $sql = "SELECT * FROM ct10_vehiculo WHERE ct10_IdVehiculo = :id_vehiculo";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_vehiculo', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

    function select_vehiculos_all()
    {
        // Asignacion de Variables
        //$this->fecha_creacion = date("Y-m-d H:i:s");
        //SQL
        $sql = "SELECT `ct10_IdVehiculo`, `ct10_Estado`, `ct10_Placa` FROM `ct10_vehiculo`";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        // Ejecutar 
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

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        //return $stmt;
    }

    //===============================================================================================================
    //===============================================================================================================
    // CREAR 

    function insertarVehiculos_1($placa, $letras, $num)
    {
        // Asignacion de Variables
        $this->fecha_creacion = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->placa = $placa;


        //SQL
        $sql = "INSERT INTO ct10_vehiculo(ct10_FechaCreacion,ct10_Estado, ct10_Placa,ct10_letras,ct10_num) VALUES (:FechaCreacion, :Estado, :Placa,:letras,:num)";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':Estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':Placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':letras', $letras, PDO::PARAM_STR);
        $stmt->bindParam(':num', $num, PDO::PARAM_STR);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        $id_insert = $this->con->lastInsertId();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $id_insert;
    }

    function editar_vehiculos_1($placa, $letras, $num, $id_vehiculo)
    {
        // Asignacion de Variables
        $this->fecha_creacion = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->placa = $placa;
        $this->id = $id_vehiculo;


        //SQL
        $sql = "UPDATE `ct10_vehiculo` SET `ct10_Placa`= :Placa,`ct10_letras`= :letras,`ct10_num`= :num WHERE `ct10_IdVehiculo` = :id_vehiculo";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        //$stmt->bindParam(':Estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':Placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':letras', $letras, PDO::PARAM_STR);
        $stmt->bindParam(':num', $num, PDO::PARAM_STR);
        $stmt->bindParam(':id_vehiculo', $this->id, PDO::PARAM_INT);


        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }



    function editar_vehiculos($letras, $num, $id_vehiculo)
    {
        // Asignacion de Variables
        $this->fecha_creacion = date("Y-m-d H:i:s");
        $this->estado = 1;

        $this->id = intval($id_vehiculo);
        $this->letras = strtoupper($letras);
        $this->num = intval($num);
        $this->placa = $letras . $num;

        //SQL
        $sql = "UPDATE `ct10_vehiculo` SET  `ct10_Placa`= :Placa, `ct10_letras`= :letras,`ct10_num`= :num WHERE `ct10_IdVehiculo` = :id_vehiculo";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        //$stmt->bindParam(':Estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':Placa', $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(':letras', $this->letras, PDO::PARAM_STR);
        $stmt->bindParam(':num', $this->num, PDO::PARAM_STR);
        $stmt->bindParam(':id_vehiculo', $this->id, PDO::PARAM_INT);


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


    function eliminar_vehiculo($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` = :id_vehiculo";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_vehiculo', $this->id, PDO::PARAM_INT);

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
}
