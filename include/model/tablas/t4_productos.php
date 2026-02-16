s` 

<?php


class t4_productos extends conexionPDO {

    private $id;
    private $estado;
    private $fecha_creacion; 
    private $id_cliente;
    private $nombre_obra;
    private $direccion_obra;



    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }




    function option_producto_edit($id_producto){
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT * FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($id_producto == $fila['ct4_Id_productos']){
                $selection = "selected='true'";
            }else{
                $selection = "";
                
            }
            $option .= '<option value="' . $fila['ct4_Id_productos'] . '" '. $selection .' >' . $fila['ct4_CodigoSyscafe']  . ' - '. $fila['ct4_Descripcion']  .' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

 

  


}