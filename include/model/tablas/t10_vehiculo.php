<?php
class t10_vehiculo extends conexionPDO {

    private $id;

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function select_conductor(){
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

    function asignar_conductor($id_vehiculo,$id_conductor) {
        
        $this->id =$id_vehiculo;
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

    function select_vehiculos_id($id) {
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

    function select_vehiculos_all() {
        // Asignacion de Variables
        //$this->fecha_creacion = date("Y-m-d H:i:s");
        //SQL
        $sql = "SELECT * FROM ct10_vehiculo";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':FechaCreacion', $this->fecha_creacion, PDO::PARAM_STR);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

//===============================================================================================================
//===============================================================================================================
// CREAR 

    function insertarVehiculos_1($placa, $letras, $num) {
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

    function editar_vehiculos_1($placa, $letras, $num, $id_vehiculo) {
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





}
?>