<?php
class cls_requisiciones extends conexionPDO
{
    public $con; // variable de conexion a la base de datos
    public $PDO;

    // Conexcion y a la base de datos
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }

    public function conexionsql()
    {
        return $this->con;
    }


    public function consolidado_datatable_items($id_usuario, $rol_user, $cod_requisiciones, $fecha_solicitante, $area_solicitante, $estatus)
    {
        $sql = "SELECT `id_item`, ct67_requsicion.fecha_solicitud,`status`, `nombre_producto`, `descripcion`, `cantidad`, `id_lugar_entrega`, `lugar_entrega`, `id_prioridad`, `prioridad`, `posible_proveedor`, `file_item`, `medida` FROM `ct67_detalle_item` INNER JOIN ct67_requsicion ON ct67_detalle_item.id_requisicion = ct67_requsicion.id_requisicion WHERE year(`fecha_solicitud`) =2024 and ct67_requsicion.fecha_solicitud LIKE '%" . $fecha_solicitante . "%' AND ct67_requsicion.id_area LIKE '%" . $area_solicitante . "%'  ";

        $stmt = $this->con->prepare($sql);


        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $datos['id'] = $fila['id_item'];
                    //$estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
                    switch ($fila['status']) {
                        case 1:
                            $status = "<small class='badge badge-warning'>PENDIENTE </small>";
                            break;
                        case 2:
                            $status = "<small class='badge badge-primary'>COTIZADO</small>";
                            break;
                        case 3:
                            $status = "<small class='badge badge-success'>APROBADO</small>";
                            break;
                        case 4:
                            $status = "<small class='badge badge-danger'>NO APROBADO</small>";
                            break;
                        case 5:
                            $status = "<small class='badge badge-primary'>COMPRADO</small>";
                            break;
                        case 6:
                            $status = "<small class='badge  badge-info'>ENTREGADO</small>";
                            break;

                        default:
                            # code...
                            break;
                    }


                    $datos['status'] = $status;
                    $datos['nombre_producto'] = $fila['nombre_producto'];
                    $datos['descripcion'] = $fila['descripcion'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['lugar_entrega'] = $fila['lugar_entrega'];
                    switch ($fila['id_prioridad']) {
                        case 1:
                            $prioridad = "<small class='badge badge-warning'>ALTO</small>";
                            break;
                        case 2:
                            $prioridad = "<small class='badge badge-info'>MEDIO</small>";
                            break;
                        case 3:
                            $prioridad = "<small class='badge badge-secondary'>BAJO</small>";
                            break;
                        default:

                            $prioridad = "<small class='badge badge-secondary'>NN</small>";
                            break;
                    }

                    $datos['prioridad'] = $prioridad;
                    $datos['posible_proveedor'] = $fila['posible_proveedor'];
                    $datos['medida'] = $fila['medida'];
                    $datos['file_item'] = $fila['file_item'];
                    $pdf_cotizacion = $fila['file_item'];
                    $datos['botonPDF'] = "<a href='" . $pdf_cotizacion . "' style='color:red'><i class='fas fa-file-pdf fa-lg'></i></a>";
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

    public function verificar_estatus($id) // 
    {
        $datos_requisicion = $this->get_data_requiscion($id);

        while ($fila_requi = $datos_requisicion->fetch(PDO::FETCH_ASSOC)) {
            $fecha_estatus = $fila_requi['fecha_estatus'];
            $id_estatus = $fila_requi['id_estatus'];
        }

        if ($id_estatus == 1) {
            // Permisos de estatus
            $fecha_estatus = new DateTime($fecha_estatus);
            $fecha_actual = new DateTime();
            $interval = $fecha_estatus->diff($fecha_actual);
            $diffdia = intval($interval->format('%d'));
            $diffhora = intval($interval->format('%H'));

            if ($diffdia == 0) {
                if ($diffhora <=  1) {
                    $bq = true;
                    $this->actualizar_estado_requisiciones($id, 1);
                } else {
                    $bq = false;
                    $this->actualizar_estado_requisiciones($id, 3);
                }
            } else {
                $bq = false;
                $this->actualizar_estado_requisiciones($id, 3);
            }
            return $bq;
        }
    }



    public function get_data_infor_requisicion($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT ct67_requsicion.id_requisicion,  ct67_requsicion.id_estatus as status_req ,ct67_requsicion.area, ct67_requsicion.fecha_solicitud, ct67_requsicion.nombre_usuario, ct67_detalle_item.status as status_item  ,`nombre_producto` ,`descripcion`, `cantidad`, ct67_detalle_item.prioridad, ct67_detalle_item.medida, `ct67_detalle_item`.`observaciones`  FROM `ct67_detalle_item`  INNER JOIN ct67_requsicion ON ct67_detalle_item.id_requisicion = ct67_requsicion.id_requisicion WHERE ct67_requsicion.fecha_solicitud BETWEEN :fecha_inicio AND :fecha_fin ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) { // 
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $datos['id_requisicion'] = $fila['id_requisicion'];
                    $datos['area'] = $fila['area'];
                    //$estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
                    switch (intval($fila['status_item'])) {
                        case 1:
                            $status = "PENDIENTE";
                            break;
                        case 2:
                            $status = "COTIZADO";
                            break;
                        case 3:
                            $status = "APROBADO";
                            break;
                        case 4:
                            $status = "NO APROBADO";
                            break;
                        case 5:
                            $status = "COMPRADO";
                            break;
                        case 6:
                            $status = "ENTREGADO";
                            break;

                        default:
                            # code...
                            break;
                    }
                    $datos['status_item'] = $status;
                    switch (intval($fila['status_req'])) {
                        case 1:
                            $statusrq = "ABIERTO";
                            break;
                        case 2:
                            $statusrq = "CERRADO";
                            break;
                        default:
                            # code...
                            break;
                    }
                    $datos['status_req'] = $statusrq;
                    $datos['fecha_solicitud'] = $fila['fecha_solicitud'];
                    $datos['nombre_usuario'] = $fila['nombre_usuario'];
                    $datos['nombre_producto'] = $fila['nombre_producto'];
                    $datos['descripcion'] = $fila['descripcion'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['prioridad'] = $fila['prioridad'];
                    $datos['medida'] = $fila['medida'];
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
public function get_data_infor_requisicion1($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT ct67_requsicion.id_requisicion,  ct67_requsicion.id_estatus as status_req ,ct67_requsicion.area, ct67_requsicion.fecha_solicitud, ct67_requsicion.nombre_usuario, ct67_detalle_item.status as status_item  ,`nombre_producto` ,`descripcion`, `cantidad`, ct67_detalle_item.prioridad, ct67_detalle_item.medida, `ct67_precios_item`.`observaciones`  FROM `ct67_precios_item` ,`ct67_detalle_item`  INNER JOIN ct67_requsicion ON ct67_detalle_item.id_requisicion = ct67_requsicion.id_requisicion WHERE `ct67_precios_item`.`id_item` = `ct67_detalle_item`.`id_item` AND ct67_requsicion.fecha_solicitud BETWEEN :fecha_inicio AND :fecha_fin ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) { // 
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $datos['id_requisicion'] = $fila['id_requisicion'];
                    $datos['area'] = $fila['area'];
                    //$estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
                    switch (intval($fila['status_item'])) {
                        case 1:
                            $status = "PENDIENTE";
                            break;
                        case 2:
                            $status = "COTIZADO";
                            break;
                        case 3:
                            $status = "APROBADO";
                            break;
                        case 4:
                            $status = "NO APROBADO";
                            break;
                        case 5:
                            $status = "COMPRADO";
                            break;
                        case 6:
                            $status = "ENTREGADO";
                            break;

                        default:
                            # code...
                            break;
                    }
                    $datos['status_item'] = $status;
                    switch (intval($fila['status_req'])) {
                        case 1:
                            $statusrq = "ABIERTO";
                            break;
                        case 2:
                            $statusrq = "CERRADO";
                            break;
                        default:
                            # code...
                            break;
                    }
                    $datos['status_req'] = $statusrq;
                    $datos['fecha_solicitud'] = $fila['fecha_solicitud'];
                    $datos['nombre_usuario'] = $fila['nombre_usuario'];
                    $datos['nombre_producto'] = $fila['nombre_producto'];
                    $datos['descripcion'] = $fila['descripcion'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['prioridad'] = $fila['prioridad'];
                    $datos['medida'] = $fila['medida'];
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
    public function get_data_requiscion($id)
    {
        $sql = "SELECT `id_requisicion`, `id_estatus`, `id_area`, `area`, `id_usuario`, `nombre_usuario`, `fecha_solicitud`,fecha_estatus FROM `ct67_requsicion` WHERE `id_requisicion` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {

            return $stmt;
        } else {
            return false;
        }
    }


    public static function actualizar_estado_cotizaciones($con, $id_item, $id_cotizacion, $estado)
    {

        $sql1 = "UPDATE `ct67_precios_item` SET `status`= :estado WHERE `id_item` =:id_item";
        $sql2 = "UPDATE `ct67_precios_item` SET`status`= :estado  WHERE `id` = :id_cotizacion";
        $stmt1 = $con->prepare($sql1);
        $stmt2 = $con->prepare($sql2);

        if (intval($estado) == 3) {
            $estado_noaprobado = 4;
            $stmt1->bindParam(':estado', $estado_noaprobado, PDO::PARAM_INT);
            $stmt1->bindParam(':id_item', $id_item, PDO::PARAM_INT);
            $stmt2->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt2->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);

            $result = $stmt1->execute();
            $result = $stmt2->execute();
        } elseif (intval($estado) == 4) {
            $stmt2->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt2->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            if ($result = $stmt2->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function actualizar_estado_items($con, $id_item, $estado)
    {
        $sql = "UPDATE `ct67_detalle_item` SET`status`= :estado  WHERE `id_item` = :id_item";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function eliminar_requisicion($id)
    {
        $sql = "DELETE FROM `ct67_requsicion` WHERE `id_requisicion` = :id_req";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_req', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar_cotizacion($id_item)
    {
        $sql = "DELETE FROM `ct67_precios_item` WHERE `id` = :id_item";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function eliminar_items($id_item)
    {
        $sql = "DELETE FROM `ct67_detalle_item` WHERE `id_item` = :id_item";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function datatable_items_cotizaciones($id_item)
    {
        $datosf = array();
        $sql = "SELECT ct67_precios_item.id, ct67_precios_item.id_item, ct67_precios_item.status, ct67_precios_item.file_item_cotizacion, ct67_precios_item.precio, ct67_precios_item.proveedor, ct67_detalle_item.cantidad,ct67_precios_item.observaciones, ct67_precios_item.tipo_pago FROM `ct67_precios_item` INNER JOIN ct67_detalle_item ON ct67_precios_item.id_item = ct67_detalle_item.id_item WHERE ct67_precios_item.id_item = :id_item";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $datos['id'] = $fila['id'];
                    $datos['id_item'] = $fila['id_item'];
                    //$estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
                    switch (intval($fila['status'])) {
                        case 1:
                            $status = "<small class='badge badge-warning'>PENDIENTE </small>";
                            break;
                        case 2:
                            $status = "<small class='badge badge-primary'>COTIZADO</small>";
                            break;
                        case 3:
                            $status = "<small class='badge badge-success'>APROBADO</small>";
                            break;
                        case 4:
                            $status = "<small class='badge badge-danger'>NO APROBADO</small>";
                            break;
                        case 5:
                            $status = "<small class='badge badge-primary'>COMPRADO</small>";
                            break;
                        case 6:
                            $status = "<small class='badge badge-Olive'>ENTREGADO</small>";
                            break;

                        default:
                            # code...
                            break;
                    }

                    $datos['Item'] = "Item";
                    $datos['descripcion'] = "descripcion";
                    $datos['cantidad'] = doubleval($fila['cantidad']);
                    $datos['status'] = $status;
                    $datos['precio'] = "$ " .  number_format($fila['precio'], 0, ',', '.');

                    $datos['preciototal'] = "$ " .  number_format(doubleval($fila['cantidad']) * doubleval($fila['precio']), 0, ',', '.');
                    $datos['proveedor'] = $fila['proveedor'];


                    $datos['file_item'] = $fila['file_item_cotizacion'];
                    $pdf_cotizacion = $fila['file_item_cotizacion'];
                    $datos['botonPDF'] = "<a href='" . $pdf_cotizacion . "' style='color:red'><i class='fas fa-file-pdf fa-lg'></i></a>";
                    $datos['observaciones'] = $fila['observaciones'];

                    switch ($fila['tipo_pago']) {
                        case 1:
                            $tipo_pago = "CREDITO";
                            break;
                        case 2:
                            $tipo_pago = "ANTICIPADO";
                            break;

                        default:
                            $tipo_pago = "<small class='badge badge-primary'></small>";
                            break;
                    }
                    $datos['tipo_pago'] = $tipo_pago;

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


    public function actualizar_pdf_cotizacion($id, $php_tempfoto1 = null,  $file_item = null, $ruta_file = null)
    {
        $date = "" . date('Y/m/d h:i:s', time());

        if (is_null($php_tempfoto1)) {
            $php_fileexten = strrchr($file_item, ".");
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/requisiciones/cotizaciones/';
            $php_serial = strtoupper(substr(hash('sha1', $file_item . $date), 0, 40)) . $php_fileexten;
            $php_tempfoto = ('/internal/requisiciones/cotizaciones/' . $php_serial);
        } else {
            $php_tempfoto = $php_tempfoto1;
        }
        $sql = "UPDATE `ct67_precios_item` SET `file_item_cotizacion`= :file_item_cotizacion WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':file_item_cotizacion', $php_tempfoto, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            if (is_null($php_tempfoto1)) {
                $php_movefile = move_uploaded_file($ruta_file, $carpeta_destino . $php_serial);
            }

            return true;
        } else {
            return false;
        }
    }

    public function crear_cotizacion_item($id_item, $proveedor, $precio, $observacion_precio, $tipo_pago)
    {

        $estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.

        $date = "" . date('Y/m/d h:i:s', time());
        $estatus = 2;

        $sql = "INSERT INTO `ct67_precios_item`( `id_item`,proveedor, `status`, `precio`,observaciones,tipo_pago) VALUES (:id_item, :proveedor , :estatus, :precio, :observacion, :tipo_pago)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        $stmt->bindParam(':proveedor', $proveedor, PDO::PARAM_STR);
        $stmt->bindParam(':estatus', $estatus, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $observacion_precio, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $id_cotizacion =  $this->con->lastInsertId();;

            self::actualizar_estado_items($this->con, $id_item, 2);
            return $id_cotizacion;
        } else {
            return false;
        }
    }




    public function datatable_items($id_requisicion)
    {
        $sql = "SELECT `id_item`, `status`, `nombre_producto`, `descripcion`, `cantidad`, `id_lugar_entrega`, `lugar_entrega`, `id_prioridad`, `prioridad`, `posible_proveedor`, `file_item`, `medida` FROM `ct67_detalle_item` WHERE `id_requisicion` = :id_requisicion";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_requisicion', $id_requisicion, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $datos['id'] = $fila['id_item'];
                    //$estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
                    switch ($fila['status']) {
                        case 1:
                            $status = "<small class='badge badge-warning'>PENDIENTE </small>";
                            break;
                        case 2:
                            $status = "<small class='badge badge-primary'>COTIZADO</small>";
                            break;
                        case 3:
                            $status = "<small class='badge badge-success'>APROBADO</small>";
                            break;
                        case 4:
                            $status = "<small class='badge badge-danger'>NO APROBADO</small>";
                            break;
                        case 5:
                            $status = "<small class='badge badge-primary'>COMPRADO</small>";
                            break;
                        case 6:
                            $status = "<small class='badge  badge-info'>ENTREGADO</small>";
                            break;

                        default:
                            # code...
                            break;
                    }


                    $datos['status'] = $status;
                    $datos['nombre_producto'] = $fila['nombre_producto'];
                    $datos['descripcion'] = $fila['descripcion'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['lugar_entrega'] = $fila['lugar_entrega'];
                    switch ($fila['id_prioridad']) {
                        case 1:
                            $prioridad = "<small class='badge badge-warning'>ALTO</small>";
                            break;
                        case 2:
                            $prioridad = "<small class='badge badge-info'>MEDIO</small>";
                            break;
                        case 3:
                            $prioridad = "<small class='badge badge-secondary'>BAJO</small>";
                            break;
                        default:

                            $prioridad = "<small class='badge badge-secondary'>NN</small>";
                            break;
                    }

                    $datos['prioridad'] = $prioridad;
                    $datos['posible_proveedor'] = $fila['posible_proveedor'];
                    $datos['medida'] = $fila['medida'];
                    $datos['file_item'] = $fila['file_item'];
                    $pdf_cotizacion = $fila['file_item'];
                    $datos['botonPDF'] = "<a href='" . $pdf_cotizacion . "' style='color:red'><i class='fas fa-file-pdf fa-lg'></i></a>";
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

    public function crear_item_has_requisicion($id_requisicion, $nombre_producto, $descripcion, $cantidad, $id_lugar_entrega, $id_prioridad, $posible_proveedor, $file_item, $ruta_file, $medida)
    {

        $estatus = 1; // 1 = Pendiente , 2= Cotizado , 3= Aprobado, 4 = No aprobado, 5 = Comprado , 6 = Entregado.
        $lugar_entrega = SELF::get_name_lugar_entrega($this->con, $id_lugar_entrega);
        $prioridad = SELF::get_name_prioridad($this->con, $id_prioridad);
        $date = "" . date('Y/m/d h:i:s', time());
        $php_fileexten = strrchr($file_item, ".");
        $php_serial = strtoupper(substr(hash('sha1', $file_item . $date), 0, 40)) . $php_fileexten;
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/requisiciones/productos/';
        $php_tempfoto = ('/internal/requisiciones/productos/' . $php_serial);
        $sql = "INSERT INTO `ct67_detalle_item`(`id_requisicion`, `status`, `nombre_producto`, `descripcion`, `cantidad`, `id_lugar_entrega`, `lugar_entrega`, `id_prioridad`, `prioridad`, `posible_proveedor`, `file_item`, `medida`) VALUES (:id_requisicion, :estatus, :nombre_producto,:descripcion,:cantidad,:id_lugar_entrega, :lugar_entrega,:id_prioridad,:prioridad,:posible_proveedor,:file_item,:medida)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_requisicion', $id_requisicion, PDO::PARAM_INT);
        $stmt->bindParam(':estatus', $estatus, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':id_lugar_entrega', $id_lugar_entrega, PDO::PARAM_INT);
        $stmt->bindParam(':lugar_entrega', $lugar_entrega, PDO::PARAM_STR);
        $stmt->bindParam(':id_prioridad', $id_prioridad, PDO::PARAM_INT);
        $stmt->bindParam(':prioridad', $prioridad, PDO::PARAM_STR);
        $stmt->bindParam(':posible_proveedor', $posible_proveedor, PDO::PARAM_STR);
        $stmt->bindParam(':file_item', $php_tempfoto, PDO::PARAM_STR);
        $stmt->bindParam(':medida', $medida, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $php_movefile = move_uploaded_file($ruta_file, $carpeta_destino . $php_serial);

            return true;
        } else {
            return false;
        }
    }


    function datatable_requisiciones($id_usuario, $id_rol, $cod_requisiciones, $fecha_solicitud, $area_solicitante, $estatus)
    {

        $id_area = SELF::get_area($this->con, $id_usuario);



        if ($id_rol == 1  || $id_rol == 23) {
            $sql = "SELECT `id_requisicion`, `id_estatus`, `id_area`, `area`, `id_usuario`, `nombre_usuario`, `fecha_solicitud` FROM `ct67_requsicion`  WHERE `id_requisicion` LIKE '%" . $cod_requisiciones . "%' AND`fecha_solicitud` LIKE '%" . $fecha_solicitud . "%' AND `id_area` LIKE '%" . $area_solicitante . "%' AND `id_estatus` LIKE '%" . $estatus . "%' ";
            $stmt = $this->con->prepare($sql);
        } else {
            $sql = "SELECT `id_requisicion`, `id_estatus`, `id_area`, `area`, `id_usuario`, `nombre_usuario`, `fecha_solicitud` FROM `ct67_requsicion`  WHERE `id_requisicion` LIKE '%" . $cod_requisiciones . "%' AND`fecha_solicitud` LIKE '%" . $fecha_solicitud . "%' AND `id_area` LIKE '%" . $area_solicitante . "%' AND `id_estatus` LIKE '%" . $estatus . "%'  AND id_area = " . $id_area;
            $stmt = $this->con->prepare($sql);
        }

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    switch ($fila['id_estatus']) {
                        case 1:
                            $status = "<small class='badge badge-warning'>ABIERTO</small>";
                            break;

                        case 2:
                            $status = "<small class='badge badge-success'>COMPLETADO</small>";

                            break;
                        case 3:
                            $status = "<small class='badge badge-info'>CERRADO</small>";

                            break;
                        default:
                            $status = "";

                            break;
                    }
                    $datos['id'] = $fila['id_requisicion'];
                    $datos['status'] = $status;
                    $datos['Area_Solicitante'] = SELF::get_name_area($this->con, $fila['id_area']);
                    $datos['responsable'] = SELF::get_name_user_responsable($this->con, $fila['id_usuario']);
                    $datos['fecha_solicitud'] = $fila['fecha_solicitud'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                $datos['id'] = "#";
                $datos['status'] = "";
                $datos['Area_Solicitante'] = "";
                $datos['responsable'] = "";
                $datos['fecha_solicitud'] = "";
                $datosf[] = $datos;
                return $datosf;
            }
        } else {
            $datos['id'] = "#";
            $datos['status'] = "";
            $datos['Area_Solicitante'] = "";
            $datos['responsable'] = "";
            $datos['fecha_solicitud'] = "";
            $datosf[] = $datos;
            return $datosf;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function option_estado_requisicion($id = null)
    {
        $option = "<option  disabled='disabled' value=''> Seleccione un estatus</option>";

        if ($id == 1) {
            $selection1 = " selected='true' ";
            $selection2 = " ";
        } elseif ($id == 2) {
            $selection1 = "";
            $selection2 = " selected='true' ";
        } elseif ($id == 3) {
            $selection1 = "";
            $selection2 = " selected='true' ";
        } else {
            $selection1 = "";
            $selection2 = " ";
        }
        $option .= "<option value='1'  " . $selection1 . " > ABIERTO </option>";
        $option .= "<option value='2' " . $selection2 . " > COMPLETADO </option>";
        $option .= "<option value='3' " . $selection2 . " > CERRADO </option>";
        return $option;
    }

    function option_areas($id_area = null)
    {
        $option = "<option  selected='true' value=''> Seleccione un area</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct64_areas`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_area == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }



    // Update 3  Resultado visita Forma de Contacto
    public function crear_requisiciones($id_usuario, $id_area)
    {
        $id_estatus = 1;
        $fecha_solicitud = "" . date('Y/m/d');
        $fecha_actual = new DateTime();
        $fecha_estatus = $fecha_actual->format('Y-m-d H:i:s');
        $area = SELF::get_name_area($this->con, $id_area);
        $nombre_user = SELF::get_name_user_responsable($this->con, $id_usuario);
        $sql = "INSERT INTO `ct67_requsicion`(`id_estatus`, `id_area`, `area`, `id_usuario`, `nombre_usuario`, `fecha_solicitud`, fecha_estatus) VALUES (:id_status, :id_area, :area, :id_usuario, :nombre_usuario, :fecha_solicitud , :fecha_estatus)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_status', $id_estatus, PDO::PARAM_INT);
        $stmt->bindParam(':id_area', $id_area, PDO::PARAM_INT);
        $stmt->bindParam(':area', $area, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_usuario', $nombre_user, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_solicitud', $fecha_solicitud, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_estatus', $fecha_estatus, PDO::PARAM_STR);


        if ($stmt->execute()) { // Ejecutar   
            return $id_insert = $this->con->lastInsertId();;
        } else {
            return false;
        }
    }


    public static function get_area($con, $id_user)
    {
        $sql = "SELECT ct12_rolesu.id_area FROM ct1_terceros INNER JOIN ct12_rolesu ON ct1_terceros.ct1_rol = ct12_rolesu.ct12_IdRoles WHERE ct1_terceros.ct1_IdTerceros = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id_user, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['id_area'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_name_area($con, $id)
    {
        $sql = "SELECT `id`, `descripcion` FROM `ct64_areas` WHERE `id` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_name_user_responsable($con, $id)
    {
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_name_lugar_entrega($con, $id)
    {
        $sql = "SELECT `descripcion` FROM `ct67_lugar_entrega` WHERE `id` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function option_lugar_entrega($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un lugar entrega</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct67_lugar_entrega`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    public static function get_name_prioridad($con, $id)
    {
        $sql = "SELECT `id`, `descripcion` FROM `ct67_prioridad` WHERE `id` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_ubicacion_filepfd($id)
    {
        $sql = "SELECT `file_item_cotizacion` FROM `ct67_precios_item` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['file_item_cotizacion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function option_prioridad($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un prioridad</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct67_prioridad`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function actualizar_estado_requisiciones($id_requisicion, $estado)
    {
        $fecha_actual = new DateTime();
        $fecha_estatus = $fecha_actual->format('Y-m-d H:i:s');
        $sql = "UPDATE `ct67_requsicion` SET `id_estatus`= :estado , fecha_estatus = :fecha_estatus  WHERE `id_requisicion` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_estatus', $fecha_estatus, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id_requisicion, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function option_tipo_pago($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione Tipo de Pago</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct67_tipo_pago` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function option_file_cotizaciones($id_requisicion)
    {
        $option = "<option  selected='true'value='subir_cotizacion' > Subir Cotizacion </option>";
        $sql = "SELECT ct67_precios_item.id, ct67_precios_item.file_item_cotizacion, ct67_precios_item.proveedor FROM `ct67_precios_item` INNER JOIN ct67_detalle_item ON ct67_precios_item.id_item = ct67_detalle_item.id_item WHERE ct67_detalle_item.id_requisicion = :id_requisicon ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_requisicon', $id_requisicion, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $option .= '<option value="' . $fila['id'] . '"  >' . $fila['proveedor'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
}
