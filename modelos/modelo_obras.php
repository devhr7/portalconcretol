<?php





class modelo_obras extends conexionPDO

{



    protected $con;
    protected $PDO;


    // Iniciar Conexion

    public function __construct()

    {

        $this->PDO = new conexionPDO();

        $this->con = $this->PDO->connect();

    }





    function select_segmento($id_obra = null)

    {

        $option = "<option  selected='true' disabled> Seleccionar Segmento</option>";

        $sql = "SELECT segmento.id_segmento as id, segmento.id_gruposegmentacion as id_grupo,grupo_segmentacion.descripcion , segmento.descripcion as descripcion FROM `segmento` INNER JOIN grupo_segmentacion ON segmento.id_gruposegmentacion = grupo_segmentacion.id";



        $stmt = $this->con->prepare($sql); // Preparar la conexion

        if ($result = $stmt->execute()) { // Ejecutar



            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 0) { // Validar el numero de Registros



                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores



            

                    if (intval($id_obra) == $fila['id']) {

                        $selection = " selected='true' ";

                    } else {

                        $selection = "";

                    }



                    if(intval($fila['id_grupo']) == 1) // Vivienda

                    {

                        $option .="<optgroup label='Vivienda'>";

                        $option .="<option value=".$fila['id']." ". $selection." >".$fila['descripcion']."</option>";

                        $option .="</optgroup>";

                    }                    

                    

                    if(intval($fila['id_grupo']) == 2) // Obras Civiles

                    {

                        $option .="<optgroup label='Vivienda'>";

                        $option .="<option value=".$fila['id']." ". $selection." >".$fila['descripcion']."</option>";

                        $option .="</optgroup>";

                    }    

                    

                    if(intval($fila['id_grupo']) == 3) // Edificaciones

                    {

                        $option .="<optgroup label='Vivienda'>";

                        $option .="<option value=".$fila['id']." ". $selection." >".$fila['descripcion']."</option>";

                        $option .="</optgroup>";

                    }    

                    

                    if(intval($fila['id_grupo']) == 4) // Otros

                    {

                        $option .="<optgroup label='Vivienda'>";

                        $option .="<option value=".$fila['id']." ". $selection." >".$fila['descripcion']."</option>";

                        $option .="</optgroup>";

                    }   

                  

                }

            }

        }

        return $option;

        $this->PDO->closePDO(); // Cerrar Conexion 

    }







    function select_ciudad($id_departamento, $id_municipio = null)
    {
        $option = "<option  selected='true' disabled> Seleccionar Ciudad</option>";
        $sql1 = "SELECT `id_municipio`, `municipio`, `departamento_id` FROM `municipios` WHERE `departamento_id` = :id_dpt ";
        $stmt1 = $this->con->prepare($sql1); // Preparar la conexion
        $stmt1->bindParam(':id_dpt', $id_departamento, PDO::PARAM_INT);
        if ($result = $stmt1->execute()) { // Ejecutar
            $num_reg =  $stmt1->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $id = $fila1['id_municipio'];
                    $municipio = $fila1['municipio'];
                    if (intval($id_municipio) == $fila1['id_municipio']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= "<option value='" . $id . "' " . $selection . " >  " . $municipio . " </option>";
                }
            }
        }
        return $option;
        $this->PDO->closePDO(); // Cerrar Conexion 
    }

    function select_departamento($id_departamento = null)
    {
        $option = "<option  selected='true' disabled> Seleccionar Departamento</option>";
        $sql1 = "SELECT `id_departamento`, `departamento` FROM `departamentos` ";
        $stmt1 = $this->con->prepare($sql1); // Preparar la conexion
        if ($result = $stmt1->execute()) { // Ejecutar
            $num_reg =  $stmt1->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $id = $fila1['id_departamento'];
                    $departamento = $fila1['departamento'];
                    if (intval($id_departamento) == $fila1['id_departamento']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= "<option value='" . $id . "' " . $selection . " >  " . $departamento . " </option>";
                }
            }
        }
        return $option;
        $this->PDO->closePDO(); // Cerrar Conexion 
    }
    public function select_comuna($id_municipio, $id_comuna = null)
    {
        $this->id_municipio = intval($id_municipio);
        $this->id_comuna = intval($id_comuna);

        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione</option>";

        if ($id_municipio == 427 || $id_municipio == 428) {
            $sql = "SELECT `id`, `nombre_comuna` FROM `comunas` WHERE `id_municipio` = :id_municipio";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_INT);
        } else {
            $sql = "SELECT `id`, `nombre_comuna` FROM `comunas` WHERE `id_municipio` = 0";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
        }


        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_comuna == $fila['id']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre_comuna'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }



    function validar_obra($id_cliente, $nombre_obra)

    {

        $this->id_cliente = intval($id_cliente);

        $this->nombre_obra = strval($nombre_obra);



        $sql = "SELECT `ct5_IdObras` FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente AND `ct5_NombreObra` = :nombre_obra";

        $stmt = $this->con->prepare($sql); // Preparar la conexion

        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);



        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if ($num_reg == 0) {

                return true;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }


    function update_distancias($id_obra, $distanciaRMI, $distanciaRZO, $distanciaRMT, $distanciaHND)
    {
        $distanciaRMI = $distanciaRMI;
        $distanciaRZO = $distanciaRZO;
        $distanciaRMT = $distanciaRMT;
        $distanciaHND = $distanciaHND;
        $id_obra = intval($id_obra);
       //ALTER TABLE `ct5_obras` ADD `distanciaRMI` DOUBLE(11,2) NULL DEFAULT NULL AFTER `latitud`, ADD `distanciaRZO` DOUBLE(11,2) NULL DEFAULT NULL AFTER `distanciaRMI`, ADD `distanciaRMT` DOUBLE(11,2) NULL DEFAULT NULL AFTER `distanciaRZO`, ADD `distanciaHND` DOUBLE(11,2) NULL DEFAULT NULL AFTER `distanciaRMT`;
        $sql = "UPDATE `ct5_obras` SET distanciaRMI = :distanciaRMI , distanciaRZO = :distanciaRZO ,distanciaRMT = :distanciaRMT , distanciaHND = :distanciaHND   WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':distanciaRMI', $distanciaRMI, PDO::PARAM_STR);
        $stmt->bindParam(':distanciaRZO', $distanciaRZO, PDO::PARAM_STR);
        $stmt->bindParam(':distanciaRMT', $distanciaRMT, PDO::PARAM_STR);
        $stmt->bindParam(':distanciaHND', $distanciaHND, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        if($result = $stmt->execute())
        {
        }else{
            return false;
        }
    }


    function update_latitud_longitud($id_obra, $latitud, $longitud)
    {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->id_obra = intval($id_obra);
       
        $sql = "UPDATE `ct5_obras` SET latitud = :latitud , longitud = :longitud  WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':latitud', $this->latitud, PDO::PARAM_STR);
        $stmt->bindParam(':longitud', $this->longitud, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if($result = $stmt->execute())
        {
        }else{
            return false;
        }
    }

    function update_ciudad_departamento($id_obra, $id_departamento, $id_ciudad)
    {
        $this->id_obra = intval($id_obra);
        $this->id_departamento = intval($id_departamento);
        $this->id_ciudad = intval($id_ciudad);
        $sql = "UPDATE `ct5_obras` SET ct5_id_departamento = :departamento , ct5_id_ciudad = :ciudad  WHERE `ct5_IdObras` = :id_obra";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':departamento', $this->id_departamento, PDO::PARAM_INT);
        $stmt->bindParam(':ciudad', $this->id_ciudad, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if($result = $stmt->execute())
        {
        }else{
            return false;
        }
    }



    //Obtener el nombre del departamento mediante el id del departamento
    public function get_nombre_departamento($id)
    {
        $this->id = $id;
        $sql = "SELECT `departamento` FROM `departamentos` WHERE `id_departamento` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['departamento'];
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
    //Obtener el nombre del municipio mediante el id del municipio
    public function get_nombre_ciudad($id)
    {
        $this->id = $id;
        $sql = "SELECT `municipio` FROM `municipios` WHERE `id_municipio` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['municipio'];
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
    //Obtener el nombre de la comuna mediante el id de la comuna
    public function get_nombre_comuna($id)
    {
        $this->id = $id;
        $sql = "SELECT `nombre_comuna` FROM `comunas` WHERE `id` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['nombre_comuna'];
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
    function crear_obra($id_cliente, $nombre_obra, $id_departamento, $nombre_departamento, $id_ciudad, $nombre_ciudad, $id_comuna, $nombre_comuna, $barrio, $segmento, $direccion)

    {
        $this->id_departamento = $id_departamento;
        $this->nombre_departamento = $nombre_departamento;
        $this->id_ciudad = $id_ciudad;
        $this->nombre_ciudad = $nombre_ciudad;
        $this->id_comuna = $id_comuna;
        $this->nombre_comuna = $nombre_comuna;
        $this->barrio = $barrio;
        $this->id_cliente = intval($id_cliente);
        $this->nombre_obra = $nombre_obra;
        $this->segmento = $segmento;
        $this->direccion = $direccion;
        $this->estado = 1;
        $this->fecha_create = "" . date("Y-m-d H:i:s");

        $sql = "INSERT INTO `ct5_obras`(`ct5_EstadoObra`,`ct5_FechaCreacion`,`ct5_IdTerceros`, `ct5_NombreObra`, `ct5_id_departamento`, `ct5_nombre_departamento`,`ct5_id_ciudad`, `ct5_nombre_ciudad`, `ct5_id_comuna`, `ct5_nombre_comuna`, `ct5_barrio`, `ct5_segmento`, `ct5_DireccionObra`) VALUES (:estado, :fecha_create, :id_cliente, :nombre_obra, :id_departamento, :nombre_departamento, :id_ciudad, :nombre_ciudad, :id_comuna, :nombre_comuna, :nombre_barrio, :segmento, :direccion_obra)";

        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_departamento', $this->id_departamento, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_departamento', $this->nombre_departamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_ciudad', $this->id_ciudad, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_ciudad', $this->nombre_ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':id_comuna', $this->id_comuna, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_comuna', $this->nombre_comuna, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_barrio', $this->barrio, PDO::PARAM_STR);
        $stmt->bindParam(':segmento', $this->segmento, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $this->direccion, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id_insert = $this->con->lastInsertId();
            return $id_insert;
        } else {
            return false;
        }
    }
    function get_cliente_for_user($id_usuario)

    {

        $this->id_usuario = intval($id_usuario);

        $sql = "SELECT `ct11_id_tercero` FROM `ct11_usuario` WHERE `ct11_IdUsuario` = :id_usuario";

        $stmt = $this->con->prepare($sql); // Preparar la conexion

        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);

        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if ($num_reg > 0) { // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $id_tercero = intval($fila['ct11_id_tercero']);

                    return $id_tercero;

                }

            } else {

                return false;

            }

        } else {

            return false;

        }

    }



    function get_select_obra_cliente($id_cliente, $id_obra = null)

    {

        $this->id_cliente = intval($id_cliente);

        $this->id_obra = intval($id_obra);



        $option = "<option  selected='true' value='ALL'> TODAS LAS OBRAS </option>";

        $sql1 = "SELECT ct5_IdObras, ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente  AND `ct5_EstadoObra` = 1";

        $stmt1 = $this->con->prepare($sql1); // Preparar la conexion

        $stmt1->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

        if ($result = $stmt1->execute()) { // Ejecutar

            $num_reg =  $stmt1->rowCount(); // Get Numero de Registros

            if ($num_reg > 0) { // Validar el numero de Registros

                while ($fila1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $id_obra = $fila1['ct5_IdObras'];

                    $nombre_obra = $fila1['ct5_NombreObra'];



                    if ($this->id_obra == $fila1['ct5_IdObras']) {

                        $selection = " selected='true' ";

                    } else {

                        $selection = "";

                    }



                    $option .= "<option value='" . $id_obra . "' " . $selection . " >  " . $id_obra . " - " . $nombre_obra . " </option>";

                }

            }

        }

        return $option;

        $this->PDO->closePDO(); // Cerrar Conexion 

    }





    function get_select_obra($id_cliente, $id_obra = null)

    {

        $this->id_cliente = intval($id_cliente);

        $this->id_obra = intval($id_obra);

        $option = "<option  selected='true' value='0'> Seleccione una obra</option>";

        $sql1 = "SELECT ct5_IdObras, ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente  AND `ct5_EstadoObra` = 1";

        $stmt1 = $this->con->prepare($sql1); // Preparar la conexion

        $stmt1->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

        if ($result = $stmt1->execute()) { // Ejecutar

            $num_reg =  $stmt1->rowCount(); // Get Numero de Registros

            if ($num_reg > 0) { // Validar el numero de Registros

                while ($fila1 = $stmt1->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $id_obra = $fila1['ct5_IdObras'];

                    $nombre_obra = $fila1['ct5_NombreObra'];



                    if ($this->id_obra == $fila1['ct5_IdObras']) {

                        $selection = " selected='true' ";

                    } else {

                        $selection = "";

                    }



                    $option .= "<option value='" . $id_obra . "' " . $selection . " >  " . $id_obra . " - " . $nombre_obra . " </option>";

                }

            }

        }

        return $option;

        $this->PDO->closePDO(); // Cerrar Conexion 

    }

}

