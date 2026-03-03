<?php
class t1_terceros extends conexionPDO
{
    public $vt1_num_identificacionuario;
    public $con;
    protected $PDO;
    // Tabla
    protected $table = 'ct1_terceros';
    //columnas
    protected $colt1_id = 'ct1_IdTerceros';
    protected $colt1_fechaCreacion = 'ct1_FechaCreacion';
    protected $colt1_Estado = 'ct1_Estado';
    protected $colt1_naturaleza = 'ct1_naturaleza';
    protected $colt1_tipo_tercero = 'ct1_TipoTercero';
    protected $colt1_tipo_identificacion = 'ct1_TipoIdentificacion';
    protected $colt1_num_identificacion = 'ct1_NumeroIdentificacion';
    protected $colt1_dv = 'ct1_dv';
    protected $colt1_razon_social = 'ct1_RazonSocial';
    protected $colt1_nombre1 = 'ct1_Nombre1';
    protected $colt1_nombre2 = 'ct1_Nombre2';
    protected $colt1_apellido1 = 'ct1_Apellido1';
    protected $colt1_id_cliente1 = 'ct1_id_cliente1';
    protected $colt1_obra_id = 'ct1_obra_id';
    protected $colt1_usuario = 'ct1_usuario';
    protected $colt1_pass = 'ct1_pass';
    protected $colt1_rol = 'ct1_rol';
    protected $colt1_fecha_nacimiento = 'ct1_FechaNacimiento';
    protected $colt1_telefono = 'ct1_Telefono';
    protected $colt1_celular = 'ct1_Celular';
    protected $colt1_correo_electronico = 'ct1_CorreoElectronico';
    protected $colt1_pais = 'ct1_Pais';
    protected $colt1_departamento = 'ct1_Departamento';
    protected $colt1_ciudad = 'ct1_Ciudad';
    protected $colt1_direccion = 'ct1_Direccion';
    //protected $col_ = '';

    //valoresColimnas
    public $datos = null;
    protected $vt1_id;
    protected $vt1_fechaCreacion;
    protected $vt1_Estado;
    protected $vt1_naturaleza;
    protected $vt1_tipo_tercero;
    protected $vt1_tipo_identificacion;
    protected $vt1_num_identificacion;
    protected $vt1_dv;
    protected $vt1_razon_social;
    protected $vt1_nombre1;
    protected $vt1_nombre2;
    protected $vt1_apellido1;
    protected $vt1_id_cliente1;
    protected $vt1_obra_id;
    protected $vt1_usuario;
    protected $vt1_pass;
    protected $vt1_rol;
    protected $vt1_fecha_nacimiento;
    protected $vt1_telefono;
    protected $vt1_celular;
    protected $vt1_correo_electronico;
    protected $vt1_pais;
    protected $vt1_departamento;
    protected $vt1_ciudad;
    protected $vt1_direccion;

    // TODO - Insert your code here
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }


    public function get_nombre_for_id(int $id)
    {
        $this->id = $id;
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);


        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    return  $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function conductor_estado($id_conductor)
    {
        $this->id_conductor = (int)$id_conductor;
        $sql = "SELECT `ct1_estado2` FROM `ct1_terceros` WHERE `ct1_Estado` != 10 AND `ct1_rol` = 25 AND `ct1_IdTerceros` = :id_conductor ORDER BY `ct1_IdTerceros` DESC ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_conductor', $this->id_conductor, PDO::PARAM_INT);


        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $datos = $fila['ct1_estado2'];
                }

                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function listconductores()
    {
        $sql = "SELECT `ct1_IdTerceros`,`ct1_NumeroIdentificacion`,`ct1_RazonSocial`,`ct1_Estado`,`ct1_estado2` FROM `ct1_terceros` WHERE `ct1_Estado` != 10 AND `ct1_rol` = 25 ORDER BY `ct1_IdTerceros` DESC ";


        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    switch ($fila['ct1_Estado']) {
                        case 1:






                            switch ($fila['ct1_estado2']) {
                                case 1:
                                    $fila['ct1_estado2'] = "<span class='badge badge-success float-right'> Activo </span>";

                                    break;
                                case 2:
                                    $fila['ct1_estado2'] = "<span class='badge badge-warning float-right'> Bloqueado </span>";
                                    break;
                                default:
                                    # code...
                                    break;
                            }

                            break;

                        default:

                            break;
                    }

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

    function select_aux_bomba($id_aux_bomba = null)
    {
        $this->id_aux_bomba = intval($id_aux_bomba);

        $option = "<option  selected='true' value='0'> No Tiene</option>";
        $sql = "SELECT ct1_IdTerceros, ct1_NumeroIdentificacion, ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND ct1_Estado = 1 AND ct1_rol = 31";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);


        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_aux_bomba == $fila['ct1_IdTerceros']) {
                $selection = "selected='true'";
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


    function select_op_bomba($id_op_bomba = null)
    {
        $this->id_op_bomba = intval($id_op_bomba);

        $option = "<option  selected='true' value='0'> No Tiene</option>";
        $sql = "SELECT ct1_IdTerceros, ct1_NumeroIdentificacion, ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND ct1_Estado = 1 AND ct1_rol = 30";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);


        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($this->id_op_bomba == $fila['ct1_IdTerceros']) {
                $selection = "selected='true'";
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

    function crear_terceros_cliente()
    {

        $this->Fecha_creacion; // Falta
        $this->estado = 1;
        $this->naturaleza_cli;
        $this->tipo_tercero;
        $this->num_identificacion;
        $this->dv;
        $this->razon_social;
        $this->nombre1;
        $this->nombre2;
        $this->apellido1;



        $sql = "INSERT INTO `ct1_terceros`(`ct1_FechaCreacion`, `ct1_Estado`, `ct1_naturaleza`, `ct1_TipoTercero`, `ct1_TipoIdentificacion`, `ct1_NumeroIdentificacion`, `ct1_dv`, `ct1_RazonSocial`, `ct1_Nombre1`, `ct1_Nombre2`, `ct1_Apellido1`, `ct1_Apellido2`, `ct1_id_cliente1`,  `ct1_usuario`, `ct1_pass`, `ct1_rol`, `ct1_FechaNacimiento`, `ct1_Telefono`, `ct1_Celular`, `ct1_CorreoElectronico`, `ct1_Departamento`, `ct1_Ciudad`, `ct1_Direccion`) VALUES 
                                        ( :Fecha_creacion, :estado, :naturaleza_cli, :tipo_tercero , :tipo_identificacion, :num_identificacion , :dv , :razon_social ,:nombre1 , :nombre2 , :apellido1 , :apellido2, :id_cliente1 , :usuario , :pass, :rol_user, :fecha_nacimiento , :telefono, :celular, :email, :departamento , :ciudad, :direccion )";


        $stmt = $this->con->prepare($sql); // Prepare Conexion


        $stmt->bindParam(':Fecha_creacion', $this->Fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':naturaleza_cli', $this->naturaleza_cli, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_identificacion', $this->tipo_identificacion, PDO::PARAM_STR);
        $stmt->bindParam(':num_identificacion', $this->num_identificacion, PDO::PARAM_STR);
        $stmt->bindParam(':dv', $this->dv, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2', $this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2', $this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente1', $this->id_cliente1, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol_user', $this->rol_user, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_nacimiento', $this->fecha_nacimiento, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':celular', $this->celular, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $this->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $this->ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $id_insert = $this->con->lastInsertId();

            $sql2 = "INSERT INTO `ct3_clientes`(`ct3_IdTerceros`, `ct3_TipoCliente`, `ct3_ModalidadPago`, `ct3_CupoEstado`, `ct3_Cupo`, `ct3_SaldoCartera`) VALUES 
            (:id_cliente, :Tipo_cliente , :Modalidad_pago , :cupo_estado, :cupo , :saldo_cartera)";

            $stmt2 = $this->con->prepare($sql2);

            $stmt2->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
            $stmt2->bindParam(':Tipo_cliente', $this->Tipo_cliente, PDO::PARAM_STR);
            $stmt2->bindParam(':Modalidad_pago', $this->Modalidad_pago, PDO::PARAM_STR);
            $stmt2->bindParam(':cupo_estado', $this->cupo_estado, PDO::PARAM_STR);
            $stmt2->bindParam(':cupo', $this->cupo, PDO::PARAM_STR);
            $stmt2->bindParam(':saldo_cartera', $this->cupo, PDO::PARAM_STR);

            if ($stmt2->execute()) {
                return $id_insert;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function crear_usuario_cliente($numero_id, $nombres, $apellidos,  $rol)
    {
        $this->estado = 1;
        $this->tipo_tercero = 3;
        $this->numero_id = $numero_id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->razon_social = $this->nombres . " " . $this->apellidos;
        $this->usuario = $this->numero_id;
        $this->pass = md5($this->numero_id);
        $this->rol = $rol;
        $sql = "INSERT INTO `ct1_terceros`( `ct1_Estado`, ct1_TipoTercero, `ct1_NumeroIdentificacion`, `ct1_RazonSocial`, `ct1_Nombre1`,  `ct1_Apellido1`, `ct1_usuario`, `ct1_pass`, `ct1_rol`)  VALUES (:estado, :tipo_tercero, :numero_id,:razon_social, :nombres, :apellidos, :usuario, :pass, :rol)";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_STR);
        $stmt->bindParam(':numero_id', $this->numero_id, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
        $stmt->bindParam(':apellidos', $this->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->con->lastInsertId();
        } else {
            return false;
        }
    }

    function get_estado_cupo($id_cliente)
    {
        $this->id_cliente = $id_cliente;
        $sql = "SELECT `ct3_CupoEstado`, `ct3_Cupo`, `ct3_SaldoCartera`, `ct3_CupoExtraEstado`, `ct3_CupoExtra`, `ct3_SaldoExtra` FROM `ct3_clientes` WHERE `ct3_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        //Preparar Conexion

        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
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

    function editar_cliente($id_cliente, $tipo_tercero, $id_comercial, $nombre_comercial, $id_sede, $nombre_sede, $id_tipo_cliente, $nombre_tipo_cliente, $id_tipo_plan_maestro, $forma_pago, $naturaleza, $tipo_documento, $numero_documento, $dv, $nombre1, $nombre2, $apellido1, $apellido2, $razon_social, $email, $telefono, $celular, $cupo_cliente, $saldo_cartera,$direccion)
    {
        $this->tipo_tercero = $tipo_tercero;
        $this->formapago    = $forma_pago;
        $this->naturaleza = $naturaleza;
        $this->tipo_documento     = $tipo_documento;
        $this->numero_documento   = $numero_documento;
        $this->dv                 = $dv;
        $this->razon_social       = $razon_social;
        $this->nombre1            = $nombre1;
        $this->nombre2            = $nombre2;
        $this->apellido1          = $apellido1;
        $this->apellido2          = $apellido2;
        $this->email              = $email;
        $this->telefono           = $telefono;
        $this->celular            = $celular;
        $this->cupo = $cupo_cliente;
        $this->id_cliente = $id_cliente;
        $this->direccion = $direccion;

        $this->rol = 101; //cliente
        //$this->tipo_tercero = 1 ; // 1 Cliente   -> 10 Funcionario

        $this->usuario = $this->numero_documento;
        $this->pass = md5($this->numero_documento);

        $this->estado = 1;
        $this->saldo_cartera = $saldo_cartera;


        if ($naturaleza == "PN") {
            $this->razon_social =  $this->nombre1 . " " . $this->nombre2  . " " . $this->apellido1  . " " . $this->apellido2;
        }

        $sql = "UPDATE `ct1_terceros` SET `ct1_id_asesora`= :id_asesora, `ct1_nombre_asesora`= :nombre_asesora, `ct1_id_sede`= :id_sede, `ct1_nombre_sede`= :nombre_sede,`ct1_naturaleza`= :naturaleza, `ct1_TipoTercero`= :tipo_tercero, `ct1_tipo_cliente`= :tipo_cliente, `ct1_nombre_tipo_cliente`= :nombre_tipo_cliente, `ct1_tipo_plan_maestro`= :tipo_plan_maestro,`ct1_TipoIdentificacion`= :tipo_identificacion, `ct1_NumeroIdentificacion`= :numero_identificacion, `ct1_dv`= :dv, `ct1_RazonSocial`= :razon_social, `ct1_Nombre1`= :nombre1,`ct1_Nombre2`= :nombre2, `ct1_Apellido1`= :apellido1, `ct1_Apellido2`= :apellido2, `ct1_usuario`= :usuario, `ct1_pass`= :pass, `ct1_Telefono`= :telefono, `ct1_Celular`= :cel, `ct1_CorreoElectronico`= :email, ct1_Direccion = :direccion WHERE `ct1_IdTerceros` = :id_cliente";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // $stmt->bindParam(':fecha_creacion', $this->sx, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_asesora', $id_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_asesora', $nombre_comercial, PDO::PARAM_STR);
        $stmt->bindParam(':id_sede', $id_sede, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_sede', $nombre_sede, PDO::PARAM_STR);
        $stmt->bindParam(':naturaleza', $this->naturaleza, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_cliente', $id_tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tipo_cliente', $nombre_tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_plan_maestro', $id_tipo_plan_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_identificacion', $this->tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(':numero_identificacion', $this->numero_documento, PDO::PARAM_STR);
        $stmt->bindParam(':dv', $this->dv, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2', $this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2', $this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->numero_documento, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':cel', $this->celular, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar primera SQL

            $sql3 = "SELECT * FROM `ct3_clientes` WHERE `ct3_IdTerceros` = :id_cliente";
            $stmt3 = $this->con->prepare($sql3);
            $stmt3->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
            if ($stmt3->execute()) { //  se busaca si
                $num_reg3 =  $stmt3->rowCount(); // Get Numero de Registros
                if ($num_reg3 > 0) {
                    $sql4 = "UPDATE `ct3_clientes` SET `ct3_TipoCliente`= :Tipo_cliente ,`ct3_ModalidadPago`= :Modalidad_pago,`ct3_Cupo`= :cupo_cli ,`ct3_SaldoCartera`= :saldo_cartera WHERE `ct3_IdTerceros` = :id_cliente";
                    $stmt4 = $this->con->prepare($sql4);
                    $stmt4->bindParam(':Tipo_cliente', $this->tipo_tercero, PDO::PARAM_INT);
                    $stmt4->bindParam(':Modalidad_pago', $this->formapago, PDO::PARAM_INT);
                    $stmt4->bindParam(':cupo_cli', $this->cupo, PDO::PARAM_STR);
                    $stmt4->bindParam(':saldo_cartera', $this->saldo_cartera, PDO::PARAM_STR);
                    $stmt4->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
                    if ($stmt4->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                } else { // Si no existe en la tabla cliente para crear
                    $sql2 = "INSERT INTO `ct3_clientes`(`ct3_IdTerceros`, `ct3_TipoCliente`, ct3_CupoEstado , `ct3_ModalidadPago`, ct3_Cupo, ct3_SaldoCartera) VALUES (:id_cliente, :Tipo_cliente , :cupo_estado , :Modalidad_pago, :cupo_cli, :saldo_cartera )";
                    $stmt2 = $this->con->prepare($sql2);
                    $stmt2->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
                    $stmt2->bindParam(':Tipo_cliente', $this->tipo_tercero, PDO::PARAM_INT);
                    $stmt2->bindParam(':cupo_estado', $this->estado, PDO::PARAM_INT);
                    $stmt2->bindParam(':Modalidad_pago', $this->formapago, PDO::PARAM_INT);
                    $stmt2->bindParam(':cupo_cli', $this->cupo, PDO::PARAM_STR);
                    $stmt2->bindParam(':saldo_cartera', $this->saldo_cartera, PDO::PARAM_STR);
                    if ($stmt2->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function crear_cliente($id_comercial, $nombre_comercial, $id_sede, $nombre_sede, $id_tipo_cliente, $nombre_tipo_cliente, $id_tipo_plan_maestro, $forma_pago, $naturaleza, $tipo_documento, $numero_documento, $dv, $nombre1, $nombre2, $apellido1, $apellido2, $razon_social, $email, $telefono, $celular, $cupo_cliente, $saldo_cartera,$direccion)
    {
        $this->tipo_cliente       = $id_tipo_cliente;
        $this->formapago          = $forma_pago;
        $this->naturaleza         = $naturaleza;
        $this->tipo_documento     = $tipo_documento;
        $this->numero_documento   = $numero_documento;
        $this->dv                 = $dv;
        $this->razon_social       = $razon_social;
        $this->nombre1            = $nombre1;
        $this->nombre2            = $nombre2;
        $this->apellido1          = $apellido1;
        $this->apellido2          = $apellido2;
        $this->email              = $email;
        $this->telefono           = $telefono;
        $this->celular            = $celular;
        $this->cupo               = $cupo_cliente;
        $this->direccion               = $direccion;

        $this->rol = 101; //cliente
        $this->tipo_tercero = 1; // 1 Cliente   -> 10 Funcionario

        $this->usuario = $this->numero_documento;
        $this->pass = md5($this->numero_documento);

        $this->estado = 1;
        $this->saldo_cartera = $saldo_cartera;


        if ($naturaleza == "PN") {
            $this->razon_social =  $this->nombre1 . " " . $this->nombre2  . " " . $this->apellido1  . " " . $this->apellido2;
        }


        $sql = "INSERT INTO `ct1_terceros`(`ct1_Estado`,`ct1_id_asesora`, `ct1_nombre_asesora`, `ct1_id_sede`, `ct1_nombre_sede`, `ct1_naturaleza`, `ct1_TipoTercero`, `ct1_tipo_cliente`, `ct1_nombre_tipo_cliente`, `ct1_tipo_plan_maestro`, `ct1_TipoIdentificacion`, `ct1_NumeroIdentificacion`, `ct1_dv`, `ct1_RazonSocial`, `ct1_Nombre1`, `ct1_Nombre2`, `ct1_Apellido1`, `ct1_Apellido2`, `ct1_usuario`, `ct1_pass`, `ct1_rol`,`ct1_Telefono`, `ct1_Celular`, `ct1_CorreoElectronico`, `ct1_Direccion`) VALUES  (:estado, :id_asesora, :nombre_asesora, :id_sede, :nombre_sede, :naturaleza, :tipo_tercero, :tipo_cliente, :nombre_tipo_cliente, :tipo_plan_maestro, :tipo_identificacion, :numero_identificacion, :dv, :razon_social, :nombre1, :nombre2, :apellido1, :apellido2, :usuario, :pass, :rol, :telefono, :cel, :email, :direccion)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // $stmt->bindParam(':fecha_creacion', $this->sx, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':id_asesora', $id_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_asesora', $nombre_comercial, PDO::PARAM_STR);
        $stmt->bindParam(':id_sede', $id_sede, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_sede', $nombre_sede, PDO::PARAM_STR);
        $stmt->bindParam(':naturaleza', $this->naturaleza, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_cliente', $this->tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tipo_cliente', $nombre_tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_plan_maestro', $id_tipo_plan_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_identificacion', $this->tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(':numero_identificacion', $this->numero_documento, PDO::PARAM_STR);
        $stmt->bindParam(':dv', $this->dv, PDO::PARAM_STR);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2', $this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2', $this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
        $stmt->bindParam(':cel', $this->celular, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $id_insert = $this->con->lastInsertId();
            $sql2 = "INSERT INTO `ct3_clientes`(`ct3_IdTerceros`, `ct3_TipoCliente`, ct3_CupoEstado , `ct3_ModalidadPago`, ct3_Cupo, ct3_SaldoCartera) VALUES (:id_cliente, :Tipo_cliente , :cupo_estado , :Modalidad_pago, :cupo_cli, :saldo_cartera)";

            $stmt2 = $this->con->prepare($sql2);
            $stmt2->bindParam(':id_cliente', $id_insert, PDO::PARAM_INT);
            $stmt2->bindParam(':Tipo_cliente', $this->tipo_cliente, PDO::PARAM_INT);
            $stmt2->bindParam(':cupo_estado', $this->estado, PDO::PARAM_INT);
            $stmt2->bindParam(':Modalidad_pago', $this->formapago, PDO::PARAM_INT);
            $stmt2->bindParam(':cupo_cli', $this->cupo, PDO::PARAM_STR);
            $stmt2->bindParam(':saldo_cartera', $this->saldo_cartera, PDO::PARAM_STR);

            if ($stmt2->execute()) {
                return $id_insert;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }













    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function buscar_nombre_conductor($conductor)
    {
        $this->conductor = $conductor;
        //$sql= "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :numero_identificacion";
        $sql2 = "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE `ct1_TipoTercero` = 10 AND  `ct1_RazonSocial` = :razon_social  ";

        //Preparar Conexion
        $stmt2 = $this->con->prepare($sql2);

        $stmt2->bindParam(':razon_social', $this->conductor, PDO::PARAM_STR);

        /////////////////////////////////////////////////////////////////
        if ($stmt2->execute()) { // Ejecutar
            $num_reg2 =  $stmt2->rowCount(); // Get Numero de Registros
            if ($num_reg2 > 0) { // Validar el numero de Registros
                while ($fila2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos2[] = $fila2;
                }
                foreach ($datos2 as $fila2) {
                    $id_conductor =  $fila2['ct1_IdTerceros'];
                }
                return $id_conductor;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //////////////////////////////////////////////////////////////////////////////
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function buscar_cliente_razon_social($razon_social)
    {
        $this->razon_social = $razon_social;
        //$sql= "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :numero_identificacion";
        $sql2 = "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE  `ct1_RazonSocial` = :razon_social ";

        //Preparar Conexion
        $stmt2 = $this->con->prepare($sql2);

        $stmt2->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);

        /////////////////////////////////////////////////////////////////
        if ($stmt2->execute()) { // Ejecutar
            $num_reg2 =  $stmt2->rowCount(); // Get Numero de Registros
            if ($num_reg2 > 0) { // Validar el numero de Registros
                while ($fila2 = $stmt2->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos2[] = $fila2;
                }
                foreach ($datos2 as $fila2) {
                    return $fila2['ct1_IdTerceros'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

        //////////////////////////////////////////////////////////////////////////////
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function buscar_cliente_nit($numero_identificacion)
    {
        $this->numero_identificacion = $numero_identificacion;

        $sql = "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :numero_identificacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        //Preparar Conexion

        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                foreach ($datos as $fila) {
                    return $fila['ct1_IdTerceros'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }


        //////////////////////////////////////////////////////////////////////////////

        //Cerrar Conexion
        $this->PDO->closePDO();
    }





    function tabla_terceros($tipo_tercero)
    {

        $tipo_tercero = "";
        $sql = "SELECT ct1_terceros.ct1_IdTerceros, ct1_terceros.ct1_Estado, ct1_terceros.ct1_TipoIdentificacion , ct1_terceros.ct1_NumeroIdentificacion , ct1_terceros.ct1_RazonSocial ,ct1_terceros.ct1_TipoTercero FROM ct1_terceros";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);


        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
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


    function select_tercero_id2($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_IdTerceros = :id_tercero";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
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
        return $stmt;
    }

    function select_tercero_id($id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_IdTerceros = :id_tercero";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }



    function select_user_cliente2()
    {
        $sql = "SELECT ct1_IdTerceros,ct1_NumeroIdentificacion,ct1_Nombre1,ct1_Apellido1,ct1_id_cliente1,ct1_RazonSocial,ct1_usuario FROM ct1_terceros WHERE ct1_TipoTercero = 3 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
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

    function select_user_cliente()
    {
        $sql = "SELECT ct1_IdTerceros,ct1_RazonSocial, ct1_usuario FROM ct1_terceros WHERE ct1_TipoTercero = 3 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            if ($data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                return $data;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        //return $stmt;
    }

    function eliminar_usuario($id)
    {

        $this->id = $id;

        $sql = "DELETE FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_tercero";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function eliminar_funcionario($id)
    {

        $this->id = $id;

        $sql = "DELETE FROM `ct1_terceros` WHERE `ct1_TipoTercero` = 10  AND `ct1_IdTerceros` = :id_tercero";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }




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


    function editar_user_cliente($numero_identificacion, $nombre1, $apellido1, $id)
    {
        $this->id = $id;


        $this->naturaleza = "PN";

        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->apellido1 = $apellido1;

        $this->razon_social = $nombre1 . " " . $apellido1;

        $this->usuario = $numero_identificacion;
        $sql = "UPDATE ct1_terceros SET ct1_NumeroIdentificacion= :numero_identificacion, ct1_RazonSocial= :razon_social, ct1_Nombre1= :nombre1, ct1_Apellido1= :apellido1, ct1_usuario= :usuario   WHERE ct1_IdTerceros = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        $result = $stmt->execute();
        $this->PDO->closePDO();
        return $result;
    }


    function editar_funcionario($id, $numero_identificacion, $nombre1, $nombre2, $apellido1, $apellido2, $rol)
    {
        date_default_timezone_set('America/Bogota');

        $this->id = $id;

        $this->estado = 1;
        $this->naturaleza = "PN";
        $this->tipo_tercero = 10;
        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->razon_social = $nombre1 . " " . $apellido1;

        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = $rol;



        $sql = "UPDATE ct1_terceros SET ct1_Estado= :estado ,ct1_NumeroIdentificacion= :numero_identificacion, ct1_RazonSocial= :razon_social, ct1_Nombre1= :nombre1, ct1_Nombre2= :nombre2, ct1_Apellido1= :apellido1, ct1_Apellido2= :apellido2,ct1_usuario= :usuario, ct1_pass= :pass, ct1_rol= :rol WHERE ct1_IdTerceros = :id";


        $stmt = $this->con->prepare($sql);




        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2', $this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2', $this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        $result = $stmt->execute();


        $this->PDO->closePDO();

        return $result;
    }



    function insertar_funcionario($numero_identificacion, $nombre1, $nombre2, $apellido1, $apellido2, $rol)
    {
        date_default_timezone_set('America/Bogota');

        $this->fecha_creacion = "" . date("Y-m-d H:i:s");

        $this->estado = 1;
        $this->naturaleza = "PN";
        $this->tipo_tercero = 10;
        $this->tipo_identificacion = "CC";
        $this->numero_identificacion = $numero_identificacion;
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->razon_social = $nombre1 . " " . $apellido1;

        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = $rol;




        $sql = "INSERT INTO `ct1_terceros`( `ct1_FechaCreacion`, `ct1_Estado`, `ct1_naturaleza`, `ct1_TipoTercero`, `ct1_TipoIdentificacion`, `ct1_NumeroIdentificacion`,  `ct1_RazonSocial`, `ct1_Nombre1`, `ct1_Nombre2`, `ct1_Apellido1`, `ct1_Apellido2`,  `ct1_usuario`, `ct1_pass`, `ct1_rol` ) VALUES (:fecha_creacion, :estado, :naturaleza, :tipo_tercero, :tipo_identificacion, :numero_identificacion, :razon_social ,:nombre1 , :nombre2 , :apellido1, :apellido2 ,:usuario ,:pass ,:rol )";
        $stmt = $this->con->prepare($sql);



        $stmt->bindParam(':fecha_creacion', $this->fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':naturaleza', $this->naturaleza, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_identificacion', $this->tipo_identificacion, PDO::PARAM_STR);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':nombre1', $this->nombre1, PDO::PARAM_STR);
        $stmt->bindParam(':nombre2', $this->nombre2, PDO::PARAM_STR);
        $stmt->bindParam(':apellido1', $this->apellido1, PDO::PARAM_STR);
        $stmt->bindParam(':apellido2', $this->apellido2, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_INT);
        //$stmt->bindParam(':estado',$this->estado, PDO::PARAM_INT);

        $result = $stmt->execute();


        $this->PDO->closePDO();

        return $result;
    }

    function select_funcionario_all()
    {
        $sql = "SELECT * FROM `ct1_terceros`  WHERE `ct1_TipoTercero` = 10 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC ";
        $stmt = $this->con->prepare($sql);

        $result = $stmt->execute();


        $this->PDO->closePDO();

        return $stmt;
    }

    function option_conductor_edit($id_conductor = null)
    {
        $id_conductor = intval($id_conductor);
        $option = "<option  selected='true' value='0'> Seleccione un Conductor</option>";
        $sql = "SELECT ct1_IdTerceros, ct1_NumeroIdentificacion, ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND ct1_Estado = 1 AND  `ct1_rol` IN (25,29)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_conductor == $fila['ct1_IdTerceros']) {
                $selection = "selected='true'";
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


    function option_cliente()
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function cliente_batch($Nit)
    {
        $this->nit = $Nit;
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql =  "SELECT `ct1_IdTerceros` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :Nit";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':Nit', $this->nit, PDO::PARAM_INT);
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }
        $this->PDO->closePDO();

        return $option;
    }




    function actualizar_cliente($id_cliente, $numero_identificacion, $razon_social)
    {
        $this->id = $id_cliente;
        $this->estado = 1;
        $this->numero_identificacion = $numero_identificacion;
        $this->razon_social = $razon_social;
        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = 101;

        $sql = "UPDATE `ct1_terceros` SET ct1_Estado = :estado, ct1_NumeroIdentificacion = :numero_identificacion, ct1_RazonSocial = :razon_social, ct1_usuario = :usuario, ct1_pass = :pass,ct1_rol= :rol WHERE `ct1_IdTerceros` = :id_cliente";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_INT);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);


        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $stmt;
    }

    function insertar_cliente($numero_identificacion, $razon_social)
    {
        $this->estado = 1;
        $this->tipo_tercero = 1;
        $this->numero_identificacion = $numero_identificacion;
        $this->razon_social = $razon_social;
        $this->usuario = $numero_identificacion;
        $this->pass = md5($numero_identificacion);
        $this->rol = 101;


        $sql = "INSERT INTO ct1_terceros( ct1_Estado, ct1_TipoTercero,ct1_NumeroIdentificacion, ct1_RazonSocial, ct1_usuario, ct1_pass, ct1_rol) VALUES (:estado,:tipo_tercero,:numero_identificacion,:razon_social,:usuario,:pass,:rol)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_tercero', $this->tipo_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':numero_identificacion', $this->numero_identificacion, PDO::PARAM_INT);
        $stmt->bindParam(':razon_social', $this->razon_social, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $this->usuario, PDO::PARAM_INT);
        $stmt->bindParam(':pass', $this->pass, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $this->rol, PDO::PARAM_INT);


        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    function select_conductor_remi($id_conductor = null)
    {
        $this->id_conductor = $id_conductor;
        $option = "<option> Seleccione un Conductor</option>";
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
                    $desabilitar = " ";
                    /**
                    if($fila['ct1_estado2'] == 2)
                    {
                        $desabilitar = " disabled='disabled' ";
                    }else{
                        $desabilitar = " ";
                    }
                     */
                    $option .= '<option value="' . $fila['ct1_IdTerceros'] . '"   ' . $selection .  $desabilitar . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
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

    function select_conductor($id_conductor = null)
    {
        $this->id_conductor = $id_conductor;
        $option = "<option> Seleccione un Conductor</option>";
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

    function select_clientes_3()
    {

        $sql = "SELECT ct1_IdTerceros,ct1_pass, ct1_NumeroIdentificacion, ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }


    function select_clientes_table()
    {

        $sql = "SELECT ct1_IdTerceros , ct1_NumeroIdentificacion, ct1_RazonSocial , ct1_Estado FROM ct1_terceros WHERE ct1_TipoTercero = 1 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }


    function select_clientes()
    {
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 1 ORDER BY `ct1_terceros`.`ct1_IdTerceros` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

    function search_conductor()
    {

        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 2 AND ct1_rol = 25 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }

    function search_tercero_custom_id_for_table($id)
    {
        $this->id = $id;

        $sql = "SELECT ct1_NumeroIdentificacion, ct1_RazonSocial  FROM ct1_terceros WHERE  ct1_IdTerceros = :id_tercero ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

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

    function search_tercero_custom_id($id)
    {
        $this->id = $id;

        $sql = "SELECT * FROM ct1_terceros WHERE  ct1_IdTerceros = :id_tercero ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $stmt;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function get_datos_terceros_user($id)
    {
        //asignacion Valores
        $this->vt1_id = (int)$id;
        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt1_id; // Seleccion
        $sql .= " , ";
        $sql .= $this->colt1_Estado; // Seleccion
        $sql .= " , ";
        $sql .= $this->colt1_tipo_tercero; // Seleccion
        $sql .= " , ";
        $sql .= $this->colt1_razon_social; // Seleccion
        $sql .= " , ";
        $sql .= $this->colt1_num_identificacion; // Seleccion
        $sql .= " , ";
        $sql .= $this->colt1_rol; // Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        $sql .= ' WHERE ';
        $sql .= $this->colt1_id; // CONDUCION
        $sql .= ' = :id'; // CONDUCION
        // Fin SQL
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        // Asignando Datos  SQL
        $stmt->bindParam(':id', $this->vt1_id, PDO::PARAM_INT);

        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg == 1) { // Validar el numero de Registros
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
        $this->PDO->closePDO(); // Cerrar Conexion       
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function autenticacion_tercero_email($usuario, $pass)
    {
        //asignacion Valores
        $this->vt1_correo_electronico = $usuario;
        $this->vt1_pass = md5($pass);
        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt1_id; // Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        $sql .= ' WHERE ';
        $sql .= $this->colt1_correo_electronico; // CONDUCION
        $sql .= ' = :email'; // CONDUCION
        $sql .= ' AND ';
        $sql .= $this->colt1_pass; // CONDUCION 2
        $sql .= ' = :pass '; // CONDUCION 2
        // Fin SQL

        $stmt = $this->con->prepare($sql); // Preparar la conexion

        // Asignando Datos  SQL
        $stmt->bindParam(':email', $this->vt1_correo_electronico, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->vt1_pass, PDO::PARAM_STR);


        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg == 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos = $fila['ct1_IdTerceros'];
                }
                return (int)$datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion       
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function autenticacion_tercero($usuario, $pass)
    {
        //asignacion Valores
        $this->vt1_num_identificacionuario = (int)$usuario;
        $this->vt1_pass = md5($pass);

        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt1_id; // Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        $sql .= ' WHERE ';
        $sql .= $this->colt1_num_identificacion; // CONDUCION
        $sql .= ' = :identificacion'; // CONDUCION
        $sql .= ' AND ';
        $sql .= $this->colt1_pass; // CONDUCION 2
        $sql .= ' = :pass '; // CONDUCION 2
        // Fin SQL

        $stmt = $this->con->prepare($sql); // Preparar la conexion

        // Asignando Datos  SQL
        $stmt->bindParam(':identificacion', $this->vt1_num_identificacionuario, PDO::PARAM_INT);
        $stmt->bindParam(':pass', $this->vt1_pass, PDO::PARAM_STR);

        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg == 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos = $fila['ct1_IdTerceros'];
                }
                return (int)$datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion       
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function select_tipo_documento($nombre = null)
    {
        $option = "<option  selected = 'true' value='NULL' disabled='true'> Seleccione... </option>";
        $sql = "SELECT * FROM `ct1_tipo_documento`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($nombre == $fila['descripcion']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['descripcion'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_forma_pago($id = null)
    {
        $option = "<option  selected = 'true' value='NULL' disabled='true'> Seleccione... </option>";
        $sql = "SELECT * FROM `ct1_forma_pago`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_naturaleza($id = null)
    {
        $option = "<option  selected = 'true' value = '0' disabled='true'> Seleccione... </option>";
        $sql = "SELECT * FROM `ct1_naturaleza`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['nombre']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['nombre'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        return $option;
    }
}
