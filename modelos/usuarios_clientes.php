<?php
class usuarios_clientes extends conexionPDO
{
    protected $PDO;
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    //Crear usuario cliente
    function crear_usuario_cliente($numero_id, $nombres, $apellidos, $id_cliente1, $id_obra, $rol)
    {
        $this->estado = 1;
        $this->tipo_tercero = 3;
        $this->numero_id = $numero_id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->razon_social = $this->nombres . " " . $this->apellidos;
        $this->id_cliente1 = $id_cliente1;
        $this->id_obra = $id_obra;
        $this->usuario = $this->numero_id;
        $this->pass = md5($this->numero_id);
        $this->rol = $rol;

        $sql = "INSERT INTO `ct1_terceros`( `ct1_Estado`, ct1_TipoTercero,`ct1_NumeroIdentificacion`, `ct1_RazonSocial`, `ct1_Nombre1`,  `ct1_Apellido1`, `ct1_id_cliente1`,  `ct1_obra_id`,`ct1_usuario`, `ct1_pass`, `ct1_rol`)  VALUES (:estado,:tipo_tercero,:numero_id,:razon_social,:nombres,:apellidos,:id_cliente1,:id_obra,:usuario,:pass,:rol)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_STR);
        $stmt->bindParam(':numero_id', $this->numero_id, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $this->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente1', $this->id_cliente1, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_STR);
        if ($stmt->execute()) {

            return true;
        } else {
            return false;
        }
    }
    //registrar los clientes y las obras en la tabla intermedia ct1_gestion_acceso
    public function insert_gestion_acceso($id_residente, $id_cliente, $id_obra)
    {
        $sql = "INSERT INTO `ct1_gestion_acceso`(`id_residente`, `id_cliente`, `id_obra`) VALUES (:id_residente, :id_cliente, :id_obra)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_residente', $id_residente, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //Obtener los datos de la tabla ct1_gestion_acceso mediante el id
    public function get_data_gestion_acceso_por_id($id)
    {
        $sql = "SELECT * FROM `ct1_gestion_acceso` WHERE `id_residente` = :id";
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_residente'] = $fila['id_residente'];
                    $datos['id_cliente'] = $fila['id_cliente'];
                    $datos['id_obra'] = $fila['id_obra'];
                }
                return $datos;
            }
        }
        return false;
    }
    //Eliminar datos de la tabla ct1_gestion_acceso mediante el id
    public function eliminar_gestion_acceso($id)
    {
        $sql = "DELETE FROM `ct1_gestion_acceso` WHERE `id` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //Restablecer la contraseña del usuario
    function restablecer_pass($id)
    {
        $this->id = $id;
        $sql = "SELECT ct1_NumeroIdentificacion FROM ct1_terceros WHERE ct1_IdTerceros = :id_tercero ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $numero_identificacion = $fila['ct1_NumeroIdentificacion'];
        }
        if ($result &&  $numero_identificacion > 1) {
            $this->pass = md5($numero_identificacion);
            $sql_edit = " UPDATE `ct1_terceros` SET ct1_pass = :pass WHERE `ct1_IdTerceros` = :id_cliente";
            $stmt2 = $this->con->prepare($sql_edit);
            $stmt2->bindParam(':pass', $this->pass, PDO::PARAM_STR);
            $stmt2->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
            $result = $stmt2->execute();
            return $result;
        } else {
            return false;
        }
    }
    //Obtener los clientes y obras
    public function get_clientes_obras($id)
    {
        $sql = "SELECT ct1_gestion_acceso.id, ct1_terceros.ct1_RazonSocial as cliente, ct5_obras.ct5_NombreObra as obra FROM ct1_gestion_acceso INNER JOIN ct1_terceros ON ct1_gestion_acceso.id_cliente = ct1_terceros.ct1_IdTerceros INNER JOIN ct5_obras ON ct1_gestion_acceso.id_obra = ct5_obras.ct5_IdObras WHERE ct1_gestion_acceso.id_residente = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['cliente'] = $fila['cliente'];
                    $datos['obra'] = $fila['obra'];
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
    public function terceros_id_cliente_y_obra(){
        $sql = "SELECT `ct1_IdTerceros`, `ct1_id_cliente1`, `ct1_obra_id` FROM `ct1_terceros` WHERE `ct1_TipoTercero` = 3";
         //Preparar Conexion
         $stmt = $this->con->prepare($sql);
         if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct1_IdTerceros'];
                    $datos['cliente'] = $fila['ct1_id_cliente1'];
                    $datos['obra'] = $fila['ct1_obra_id'];
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
