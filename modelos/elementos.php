<?php
class elementos extends conexionPDO
{
    protected $con;
    protected $PDO;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    


    function option_tipo_movimiento($id = null)
    {

        $option = "<option  selected='true' value='0'> Seleccione el tipo de Movimiento</option>";

        $sql = "SELECT * FROM `ct64_tipo_movimiento` ";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function option_empleados($id = null)
    {

        $option = "<option  selected='true' value='0'> Seleccione un funcionario</option>";

        $sql = "SELECT `id`,`nombre_funcionario` FROM `ct64_funcionarios`;";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre_funcionario'] . ' </option>';
            }
        }
        return $option;
    }

    function option_epp($id = null)
    {

        $option = "<option  selected='true' value='0'> Seleccione el EPP</option>";

        $sql = "SELECT `id`,`descripcion` FROM `ct64_epp`;";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function option_tipo_epp($id = null)
    {

        $option = "<option  selected='true' value='0'> Seleccione el tipo de EPP</option>";

        $sql = "SELECT `id`,`descripcion` FROM `ct64_tipo_epp`;";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function option_tamano($id = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione el tamaño</option>";

        $sql = "SELECT `id`,`descripcion` FROM `ct64_tamano`;";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function option_color($id = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione el color</option>";

        $sql = "SELECT `id`,`descripcion` FROM `ct64_color`;";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function option_descripcion_epp($id = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione el epp</option>";

        $sql = "SELECT `id`, `descripcion` FROM `ct64_elementos_epp`";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected = 'true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    function crear_elemento_epp($id_epp, $nombre_epp, $id_tipo_epp, $nombre_tipo, $id_tamano, $nombre_tamano, $id_color, $nombre_color)
    {
        $this->id_epp = $id_epp;
        $this->id_tipo_epp = $id_tipo_epp;
        $this->id_tamano = $id_tamano;
        $this->id_color = $id_color;
        $this->nombre = $nombre_epp;
        $this->nombre_tipo_epp = $nombre_tipo;
        $this->nombre_tamano = $nombre_tamano;
        $this->nombre_color = $nombre_color;
       

        $this->descripcion = $this->nombre . " " . $this->nombre_tipo_epp ." ". $this->nombre_tamano .  $this->nombre_color;

        $sql = "INSERT INTO `ct64_elementos_epp`(`descripcion`, `id_epp`, `nombre_epp`, `id_tipo_epp`, `nombre_tipo_epp`, `id_tamano`, `nombre_tamano`, `id_color`, `nombre_color`) VALUES   (:descripcion, :id_epp, :nombre_epp, :id_tipo_epp, :nombre_tipo_epp, :id_tamano, :nombre_tamano, :id_color, :nombre_color)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_epp', $this->id_epp, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_epp', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_epp', $this->id_tipo_epp, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tipo_epp', $this->nombre_tipo_epp, PDO::PARAM_STR);
        $stmt->bindParam(':id_tamano', $this->id_tamano, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tamano', $this->nombre_tamano, PDO::PARAM_STR);
        $stmt->bindParam(':id_color', $this->id_color, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_color', $this->nombre_color, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }



    function crear_salida_epp($fecha,$id_movimiento, $nombre_movimiento, $id_empleado, $nombre_empleado, $id_cargo, $nombre_cargo, $id_area, $nombre_area, $id_elemento_epp, $nombre_epp, $cantidad,$observaciones)
    {
        $this->fecha = $fecha;
        $this->id_empleado = $id_empleado;
        $this->nombre_empleado = $nombre_empleado;
        $this->id_cargo = $id_cargo;
        $this->nombre_cargo = $nombre_cargo;
        $this->id_area = $id_area;
        $this->nombre_area = $nombre_area;
        $this->id_elemento_epp = $id_elemento_epp;
        $this->nombre_epp = $nombre_epp;
        $this->cantidad = $cantidad;


        $sql = "INSERT INTO `ct64_salida_epp`(`fecha`,id_movimiento,nombre_movimiento,  `id_empleado`, `nombre_empleado`, `id_cargo`, `nombre_cargo`, `id_area`, `nombre_area`, `id_elemento_epp`, `nombre_elemento_epp`, `cantidad`,observaciones) VALUES(:fecha, :id_movimiento, :nombre_movimiento, :id_empleado, :nombre_empleado, :id_cargo, :nombre_cargo, :id_area, :nombre_area, :id_elemento_epp, :nombre_epp, :cantidad, :observaciones)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':id_movimiento', $id_movimiento, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_movimiento', $nombre_movimiento, PDO::PARAM_STR);
        $stmt->bindParam(':id_empleado', $this->id_empleado, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_empleado', $this->nombre_empleado, PDO::PARAM_STR);
        $stmt->bindParam(':id_cargo', $this->id_cargo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cargo', $this->nombre_cargo, PDO::PARAM_STR);
        $stmt->bindParam(':id_area', $this->id_area, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_area', $this->nombre_area, PDO::PARAM_STR);
        $stmt->bindParam(':id_elemento_epp', $this->id_elemento_epp, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_epp', $this->nombre_epp, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    public function get_nombre_epp($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_epp` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_tipo_epp($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_tipo_epp` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_tamano($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_tamano` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_color($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_color` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_empleado($id)
    {
        $this->id = $id;
        $sql = "SELECT `nombre_funcionario` FROM `ct64_funcionarios` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['nombre_funcionario'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_id_cargo_empleado($id)
    {
        $this->id = $id;
        $sql = "SELECT `id_cargo` FROM `ct64_funcionarios` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['id_cargo'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_movimiento_inventario_epp($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM `ct64_tipo_movimiento`  WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }


    public function get_nombre_cargo_empleado($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_cargo` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_id_area_empleado($id)
    {
        $this->id = $id;
        $sql = "SELECT `id_area` FROM `ct64_funcionarios` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['id_area'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_area_empleado($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_areas` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_descripcion_epp($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct64_elementos_epp` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return "No aplica";
            }
        } else {
            return "";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_database_inventario_epp()
    {
        $sql = "SELECT id ,`id_elemento_epp`, `nombre_elemento_epp`, SUM(CASE WHEN `id_movimiento` = 4 THEN `cantidad` ELSE 0 END) AS INVENTARIO_INICIAL , SUM(CASE WHEN `id_movimiento` = 2 THEN `cantidad` ELSE 0 END) AS ENTRADAS, SUM(CASE WHEN `id_movimiento` = 1 THEN `cantidad` ELSE 0 END) AS SALIDAS,SUM(CASE WHEN `id_movimiento` =3 THEN `cantidad` ELSE 0 END) AS AJUSTES, SUM(CASE WHEN `id_movimiento` = 4 THEN `cantidad` ELSE 0 END) + SUM(CASE WHEN `id_movimiento` =3 THEN `cantidad` ELSE 0 END) + SUM(CASE WHEN `id_movimiento` = 2 THEN `cantidad` ELSE 0 END) - SUM(CASE WHEN `id_movimiento` = 1 THEN `cantidad` ELSE 0 END) as saldo FROM `ct64_salida_epp` GROUP BY `id_elemento_epp`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['nombre_elemento_epp'] = $fila['nombre_elemento_epp'];
                    $datos['inventario_inicial'] = $fila['INVENTARIO_INICIAL'];
                    $datos['entradas'] = $fila['ENTRADAS'];
                    $datos['salidas'] = $fila['SALIDAS'];
                    $datos['ajustes'] = $fila['AJUSTES'];
                    $datos['saldo'] = $fila['saldo'];
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

    public function get_database_salida_epp()
    {
        $sql = "SELECT `id`,`fecha`,nombre_movimiento,`nombre_empleado`,`nombre_cargo`,`nombre_area`,`nombre_elemento_epp`,`cantidad`,observaciones FROM `ct64_salida_epp` WHERE YEAR(`fecha`) = 2025";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha'];
                    $datos['nombre_movimiento'] = $fila['nombre_movimiento'];
                    $datos['nombre_empleado'] = $fila['nombre_empleado'];
                    $datos['nombre_cargo'] = $fila['nombre_cargo'];
                    $datos['nombre_area'] = $fila['nombre_area'];
                    $datos['nombre_elemento_epp'] = $fila['nombre_elemento_epp'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['observaciones'] = $fila['observaciones'];
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

    public function get_database_elementos_epp()
    {
        $sql = "SELECT `id`,`descripcion`,`nombre_epp`,`nombre_tipo_epp`,`nombre_tamano`,`nombre_color` FROM `ct64_elementos_epp`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['descripcion'] = $fila['descripcion'];
                    $datos['nombre_epp'] = $fila['nombre_epp'];
                    $datos['nombre_tipo_epp'] = $fila['nombre_tipo_epp'];
                    $datos['nombre_tamano'] = $fila['nombre_tamano'];
                    $datos['nombre_color'] = $fila['nombre_color'];
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

    public function excel_salidas_epp($fecha_ini, $fecha_fin){
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT `id`,`fecha`,nombre_movimiento,`nombre_empleado`,`nombre_cargo`,`nombre_area`,`nombre_elemento_epp`,`cantidad`,observaciones FROM `ct64_salida_epp` WHERE fecha BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha` DESC";

         // Preparar la conexion del sentencia SQL
         $stmt = $this->con->prepare($sql);
         $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
         $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['nombre_movimiento'] = $fila['nombre_movimiento'];
                    $data_array['nombre_empleado'] = $fila['nombre_empleado'];
                    $data_array['nombre_cargo'] = $fila['nombre_cargo'];
                    $data_array['nombre_area'] = $fila['nombre_area'];
                    $data_array['nombre_elemento_epp'] = $fila['nombre_elemento_epp'];
                    $data_array['cantidad'] = $fila['cantidad'];
                    $data_array['observaciones'] = $fila['observaciones'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }

    public function get_elementos_epp_id($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM `ct64_elementos_epp` WHERE `id` = :id";
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


    public function get_salida_epp_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `fecha`, `id_movimiento`, `nombre_movimiento`, `id_empleado`, `nombre_empleado`, `id_cargo`, `nombre_cargo`, `id_area`, `nombre_area`, `id_elemento_epp`, `nombre_elemento_epp`, `cantidad`, `observaciones` FROM `ct64_salida_epp` WHERE `id` = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha'];
                    $datos['id_movimiento'] = $fila['id_movimiento'];
                    $datos['option_tipo_movimiento'] = $this->option_tipo_movimiento($fila['id_movimiento']);
                    $datos['nombre_movimiento'] = $fila['nombre_movimiento'];
                    $datos['id_empleado'] = $fila['id_empleado'];
                    $datos['option_empleados'] = $this->option_empleados($fila['id_empleado']);  // P
                    $datos['id_cargo'] = $fila['id_cargo'];
                    $datos['id_area'] = $fila['id_area'];
                    $datos['id_elemento_epp'] = $fila['id_elemento_epp'];

                    $datos['option_elementos'] = $this->option_descripcion_epp($fila['id_elemento_epp']);
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datosf[] = $datos;
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

    public function editar_elemento_epp($id, $id_epp, $nombre_epp, $id_tipo_epp, $nombre_tipo, $id_tamano, $nombre_tamano, $id_color, $nombre_color){
        $this->id = $id;
        $this->id_epp = $id_epp;
        $this->nombre = $nombre_epp;
        $this->id_tipo_epp = $id_tipo_epp;
        $this->nombre_tipo_epp = $nombre_tipo;
        $this->id_tamano = $id_tamano;
        $this->nombre_tamano = $nombre_tamano;
        $this->id_color = $id_color;
        $this->nombre_color = $nombre_color;

        $this->descripcion = $this->nombre. " " .$this->nombre_tipo_epp." ".$this->nombre_tamano." ".$this->nombre_color;

        $sql = "UPDATE `ct64_elementos_epp` SET `descripcion` = :descripcion, `id_epp` = :id_epp, `nombre_epp` = :nombre_epp, `id_tipo_epp` = :id_tipo_epp, `nombre_tipo_epp` = :nombre_tipo_epp, `id_tamano` = :id_tamano, `nombre_tamano` = :nombre_tamano, `id_color` = :id_color, `nombre_color` = :nombre_color WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_epp', $this->id_epp, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_epp', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_epp', $this->id_tipo_epp, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_epp', $this->nombre_tipo_epp, PDO::PARAM_STR);
        $stmt->bindParam(':id_tamano', $this->id_tamano, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tamano', $this->nombre_tamano, PDO::PARAM_STR);
        $stmt->bindParam(':id_color', $this->id_color, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_color', $this->nombre_color, PDO::PARAM_STR);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }

    public function editar_salida_epp($id, $fecha,$id_movimiento, $id_empleado, $nombre_empleado, $id_cargo, $nombre_cargo, $id_area, $nombre_area, $id_elemento_epp, $nombre_epp, $cantidad,$observaciones){
  
        $nombre_tipo_movimiento = $this->get_nombre_movimiento_inventario_epp($id_movimiento);
        $sql = "UPDATE `ct64_salida_epp` SET `fecha` = :fecha, id_movimiento = :id_movimiento, `nombre_movimiento` = :nombre_movimiento,`id_empleado` = :id_empleado, `nombre_empleado` = :nombre_empleado, `id_cargo` = :id_cargo, `nombre_cargo` = :nombre_cargo, `id_area` = :id_area, `nombre_area` = :nombre_area, `id_elemento_epp` = :id_elemento_epp, `nombre_elemento_epp` = :nombre_elemento_epp, `cantidad` = :cantidad , observaciones = :observaciones WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':id_movimiento', $id_movimiento, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_movimiento', $nombre_tipo_movimiento, PDO::PARAM_STR);
        $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_empleado', $nombre_empleado, PDO::PARAM_STR);
        $stmt->bindParam(':id_cargo', $id_cargo, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cargo', $nombre_cargo, PDO::PARAM_STR);
        $stmt->bindParam(':id_area', $id_area, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_area', $nombre_area, PDO::PARAM_STR);
        $stmt->bindParam(':id_elemento_epp', $id_elemento_epp, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_elemento_epp', $nombre_epp, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        // Ejecutar 
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $result;
    }

    function eliminar_elemento($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct64_elementos_epp` WHERE `id` = :id";
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

    function eliminar_salida($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct64_salida_epp` WHERE `id` = :id";
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
}
