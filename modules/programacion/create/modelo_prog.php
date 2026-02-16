
<?php
class modelo_prog extends conexionPDO
{

    protected $con;

    // TODO - Insert your code here
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }


  
    function select_conductor($id_conductor = null)
    {
        $this->id_conductor = $id_conductor;
        $option = "<option value='NA'> Seleccione un Conductor</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND  `ct1_rol` IN (25,29) AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id_conductor == $fila['ct1_IdTerceros']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct1_IdTerceros'] . '"   ' . $selection . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Conductor</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Conductor</option>";
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    function select_vehiculo_edit($placa = null)
    {
        $this->placa = $placa;
        $option = "<option  selected='true'  value='NA'> Seleccione un Vehiculo</option>";

            $sql = "SELECT `ct10_IdVehiculo`, `ct10_Placa` FROM `ct10_vehiculo` ";
            $stmt = $this->con->prepare($sql);
       

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    if ($this->placa == $fila['ct10_IdVehiculo']) {
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
    function datos_precio_producto_prog($id_cliente,$id_obra,$id_producto)    
    {
        $this->id_cliente = intval($id_cliente);
        $this->id_obra = intval($id_obra);
        $this->id_producto = intval($id_producto);

        $selection = "";
        //$option = "<option  selected='true' disabled='disabled'> Seleccione un Producto</option>";
        $sql = "SELECT `ct6_Precio` FROM `ct6_precioproductos` WHERE `ct6_IdTercero` = :id_cliente AND `ct6_IdObras` = :id_obra AND ct6_IdProducto = :id_producto ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
              
                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                        $precio_producto = $fila['ct6_Precio'];
                        return $precio_producto;
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

    function option_producto_prog($id_obra,$id_cliente,$id_producto = null)
    {
        $this->id_obra = $id_obra;
        $this->id_producto = intval($id_producto);
        $this->id_cliente = intval($id_cliente);

        $selection = "";
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Producto</option>";
        $sql = "SELECT ct4_productos.ct4_Id_productos as id_producto, ct4_productos.ct4_CodigoSyscafe as codigo_producto, ct4_productos.ct4_Descripcion as descripcion_producto FROM ct4_productos INNER JOIN `ct6_precioproductos` WHERE ct6_precioproductos.ct6_IdProducto = ct4_productos.ct4_Id_productos AND ct6_precioproductos.ct6_IdObras = :id_obra AND ct6_precioproductos.ct6_IdTercero = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['id_producto']) {
                        $selection = "selected='true'";
                    }else{
                        $selection  = "";
                    }
                    $option .= '<option value="' . $fila['id_producto'] . '" '. $selection .' >' . $fila['codigo_producto']  ." - "  . $fila['descripcion_producto']  . ' </option>';
                }
            } else {
                $option .= "<option  selected='true' disabled='disabled'> No hay Productos </option>";
            }
        } else {
            $option .= "<option  selected='true' disabled='disabled'> Error al cargar Productos </option>";
        }

       

        //resultado
        return $option;

         //Cerrar Conexion
         $this->PDO->closePDO();
    }


    function option_obras($id_cliente,$id_obra = null)
    {
        $this->id_obra = $id_obra;
        $this->id_cliente = intval($id_cliente);

        $selection = "";
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT ct5_IdObras , ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_obra == $fila['ct5_IdObras']) {
                        $selection = "selected='true'";
                    }else{
                        $selection  = "";
                    }
                    $option .= '<option value="' . $fila['ct5_IdObras'] . '" '. $selection .' >' . $fila['ct5_NombreObra']  . ' </option>';
                }
              
            } else {
                $option .= "<option  selected='true' disabled='disabled'> No hay Obras </option>";
            }
        } else {
            $option .= "<option  selected='true' disabled='disabled'> Error al cargar Obras </option>";
        }

       

        //resultado
        return $option;

         //Cerrar Conexion
         $this->PDO->closePDO();
    }


   function option_cliente_edit($id_cliente = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT ct1_IdTerceros , ct1_NumeroIdentificacion , ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_cliente == $fila['ct1_IdTerceros']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" ' . $selection . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

}