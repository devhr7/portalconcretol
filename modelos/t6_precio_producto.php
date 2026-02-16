<?php
class t6_precio_producto extends conexionPDO
{
    private $id;
    private $estado;
    private $id_tercero;
    private $id_obra;
    private $precio;
    private $id_producto;
    public $con;
    protected $PDO;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function insertar_precios_productos($fecha_creacion,$estado,$id_tercero , $id_obra, $id_producto, $id_precio)
    {
        $this->fecha_creacion = $fecha_creacion;
        $this->estado  = $estado;
        $this->id_tercero = $id_tercero;
        $this->id_obra = $id_obra;
        $this->id_producto = $id_producto;
        $this->id_precio = $id_precio;


        $sql = "INSERT INTO `ct6_precioproductos`( `ct6_FechaCreacion`, `ct6_Estado`, `ct6_IdTercero`, `ct6_IdObras`, `ct6_IdProducto`, `ct6_Precio`) VALUES ( :fecha_creacion , :estado , :id_tercero, :id_obra, :id_producto, :id_precio)";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        
        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_tercero', $this->id_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':id_precio', $this->id_precio, PDO::PARAM_STR);
        
        if($result= $stmt->execute()){
            
        }
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }


    function editar_precio($id, $estado, $id_tercero, $id_obra, $precio, $id_producto)
    {

        $this->id = $id;
        $this->estado = $estado;
        $this->id_tercero = $id_tercero;
        $this->id_obra = $id_obra;
        $this->precio = $precio;
        $this->id_producto = $id_producto;

        $sql = "UPDATE `ct6_precioproductos` SET `ct6_Estado`= :estado,`ct6_IdTercero`= :id_tercero,`ct6_IdObras`=:id_obra,`ct6_IdProducto`=:id_producto,`ct6_Precio`= :precio WHERE `ct6_IdPrecioProducto`= :id_precio_producto;";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_tercero', $this->id_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);
        $stmt->bindParam(':id_precio_producto', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }

    function select_precio_producto_id($id_precioProduct)
    {
        $this->id = $id_precioProduct;
        $sql = "SELECT * FROM `ct6_precioproductos` WHERE `ct6_IdPrecioProducto` = :id_precio_producto";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_precio_producto', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
}
