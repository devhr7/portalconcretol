<?php
class t4_productos extends conexionPDO
{
    public $con;
    private $id;
    private $estado;
    private $fecha_creacion;
    private $id_cliente;
    private $nombre_obra;
    private $direccion_obra;
    protected $PDO;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    
    function eliminar_producto($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
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

    function actualizar_producto($id, $tipo_concreto, $resistencia, $tamanoagregado, $caract_concre, $color,$codigo_concre, $descripcion_concre)
    {
        // $this->estado = $estado;
        // $this->codigo_syscafe = $codigo_syscafe;
        $this->tipo_concreto = $tipo_concreto;
        $this->resistencia = $resistencia;
        $this->tamanoagregado = $tamanoagregado;
        $this->caract_concre = $caract_concre;
        $this->color = $color;
        $this->codigo_concre = $codigo_concre;
        $this->descripcion_concre = $descripcion_concre;
        $this->id = $id;

        $sql = "UPDATE `ct4_productos` SET  `ct4_TipoConcreto` = :tipo_concreto, `ct4_Resistencia` = :resistencia, `ct4_TamanoMAgregado` = :tamanoagregado, `ct4_CaracteristicaConcreto` = :caract_concre, `ct4_Color` =:color, ct4_CodigoSyscafe = :codigo, ct4_Nombre = :cod ,ct4_Descripcion = :dsp  WHERE ct4_Id_productos = :id ";
        $stmt = $this->con->prepare($sql);

        // $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        // $stmt->bindParam(':codigo_syscafe', $this->codigo_syscafe, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_concreto', $this->tipo_concreto, PDO::PARAM_STR);
        $stmt->bindParam(':resistencia', $this->resistencia, PDO::PARAM_STR);
        $stmt->bindParam(':tamanoagregado', $this->tamanoagregado, PDO::PARAM_STR);
        $stmt->bindParam(':caract_concre', $this->caract_concre, PDO::PARAM_STR);
        $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $this->codigo_concre, PDO::PARAM_STR);
        $stmt->bindParam(':cod', $this->codigo_concre, PDO::PARAM_STR);
        $stmt->bindParam(':dsp', $this->descripcion_concre, PDO::PARAM_STR);
        // $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        // $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            return true;
        } else {
            return false;
        }
    }

    function crear_producto($fecha_create, $estado, $codigo_syscafe, $tipo_concreto, $resistencia, $tamanoagregado, $caract_concre, $color, $nombre, $descripcion)
    {
        $this->fecha_create = $fecha_create;
        $this->estado = $estado;
        $this->codigo_syscafe = $codigo_syscafe;
        $this->tipo_concreto = $tipo_concreto;
        $this->resistencia = $resistencia;
        $this->tamanoagregado = $tamanoagregado;
        $this->caract_concre = $caract_concre;
        $this->color = $color;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;

        $sql = "INSERT INTO `ct4_productos`( `ct4_FechaCreacion`, `ct4_EstadoProducto`, `ct4_CodigoSyscafe`, `ct4_TipoConcreto`, `ct4_Resistencia`, `ct4_TamanoMAgregado`, `ct4_CaracteristicaConcreto`, `ct4_Color`, `ct4_Nombre`, `ct4_Descripcion`) VALUES (:fecha_create, :estado , :codigo_syscafe , :tipo_concreto ,:resistencia , :tamanoagregado, :caract_concre , :color , :nombre , :descripcion)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':codigo_syscafe', $this->codigo_syscafe, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_concreto', $this->tipo_concreto, PDO::PARAM_STR);
        $stmt->bindParam(':resistencia', $this->resistencia, PDO::PARAM_STR);
        $stmt->bindParam(':tamanoagregado', $this->tamanoagregado, PDO::PARAM_STR);
        $stmt->bindParam(':caract_concre', $this->caract_concre, PDO::PARAM_STR);
        $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $id_insert = $this->con->lastInsertId();
            return $id_insert;
        } else {
            return false;
        }
    }

    function option_producto_prog($id_obra, $id_cliente, $id_producto = null)
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
                    } else {
                        $selection  = "";
                    }
                    $option .= '<option value="' . $fila['id_producto'] . '" ' . $selection . ' >' . $fila['codigo_producto']  . " - "  . $fila['descripcion_producto']  . ' </option>';
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

    function datos_precio_producto_prog($id_cliente, $id_obra, $id_producto)
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

    ///////////////////////////////////////////////////////77

    function buscar_productos_codigo($codigo_producto)
    {
        $this->codigo_producto = $codigo_producto;
        $sql = "SELECT `ct4_Id_productos` FROM `ct4_productos` WHERE `ct4_Nombre` = :nombre_producto ";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':nombre_producto', $this->codigo_producto, PDO::PARAM_STR);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $id_producto = $fila['ct4_Id_productos'];
                }
                return $id_producto;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function buscar_productos_descripcion($descripcion_producto)
    {
        $this->descripcion_producto = $descripcion_producto;
        $sql = "SELECT `ct4_Id_productos` FROM `ct4_productos` WHERE `ct4_Descripcion` = :descripcion_producto ";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':descripcion_producto', $this->descripcion_producto, PDO::PARAM_STR);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $id_producto = $fila['ct4_Id_productos'];
                }
                return $id_producto;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function get_productos_for_id($id_producto)
    {
        $this->id_producto = $id_producto;
        $sql = "SELECT * FROM `ct4_productos` WHERE  ct4_Id_productos = :id_producto";
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);

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
    }

    function tabla_productos()
    {
        $sql = "SELECT `ct4_Id_productos`,ct4_EstadoProducto,ct4_CodigoSyscafe, `ct4_Nombre`,`ct4_Descripcion` FROM `ct4_productos`";
        $stmt = $this->con->prepare($sql);
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
    }

    function option_producto()
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT * FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' .  ' >' . $fila['ct4_CodigoSyscafe']  . ' - ' . $fila['ct4_Descripcion']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }

    function option_producto_edit($id_producto = null)
    {
        $this->id = $id_producto;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT ct4_Id_productos , ct4_CodigoSyscafe , ct4_Descripcion FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['ct4_Id_productos']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' . $selection . ' >' . $fila['ct4_CodigoSyscafe']  . ' - ' . $fila['ct4_Descripcion']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H2" . $num_reg . "</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H1</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
}
