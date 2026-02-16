<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php

switch ($rol_user) {
    case 1:
    case 8:
    case 15:
    case 16:
    case 20:
    case 29:
    case 22:
    case 26:
        $t1_terceros = new t1_terceros();
        $t4_productos = new t4_productos();
        $t5_obras = new t5_obras();
        $t26_remisiones = new t26_remisiones();
        $php_clases = new php_clases();
        $t10_vehiculo = new t10_vehiculo();
        break;

    default:
        print('<script> window.location = "../index.php"</script>');

        break;
}
              
                $id_remision  = $_GET['id'];
                $datos_remision = $t26_remisiones->get_remision_id($id_remision);

                while ($fila_remi = $datos_remision->fetch(PDO::FETCH_ASSOC)) {

                    $hora_remi = $fila_remi['ct26_hora_remi'];
                    $id_obra = $fila_remi['ct26_idObra'];
                    $nombre_obra = $fila_remi['ct26_nombre_obra'];
                    $id_cliente = $fila_remi['ct26_idcliente'];
                    $nombre_cliente = $fila_remi['ct26_razon_social'];
                    $codigo_remi = $fila_remi['ct26_codigo_remi'];
                    $img_remi = $fila_remi['ct26_imagen_remi'];
                    $id_conductor = $fila_remi['ct26_conductor'];
                    $id_placa = $fila_remi['ct26_id_vehiculo'];
                    $placa = $fila_remi['ct26_vehiculo'];
                    $id_producto = $fila_remi['ct26_id_producto'];
                    $sello =$fila_remi['ct26_sello'];
                    $m3 = $fila_remi['ct26_metros'];
                    $asentamiento = htmlspecialchars($fila_remi['ct26_asentamiento']);
                    $estado = $fila_remi['ct26_estado'];
                    $hora_salida_planta = $fila_remi['ct26_hora_salida_planta'];
                    $hora_llegada_obra = $fila_remi['ct26_hora_llegada_obra'];
                    $hora_inicio_descargue = $fila_remi['ct26_hora_inicio_descargue'];
                    $hora_teminada_descargue = $fila_remi['ct26_hora_terminada_descargue'];
                    $hora_llegada_planta = $fila_remi['ct26_hora_llegada_planta'];
                }
                //$firephp->fb($t1_terceros->option_conductor_edit($id_conductor) ,FirePHP::LOG);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Remision</h1>
                </div>
                <div class="col-sm-6">
                    <!--
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Actual</li>
                              </ol>
                                -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href='editar_avanzado.php?id=<?php print_r($id_remision); ?>'><i
                            class="fas fa-tools"></i></a> Remision <strong> <?php print_r($codigo_remi); ?> </strong>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_update" id="form_update" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id_remision ?>" />
                        <div class="row">
                            <?php 
                            $firephp->fb($rol_user ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_hora = " ";
                                    break;
                                    default:
                                        $permisos_hora = "disabled = 'true'";
                                    break;
                                }
                            ?>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_habilitar_hremision"
                                            id="check_habilitar_hremision" <?php print_r($permisos_hora); ?>>
                                        <label for="check_habilitar_hremision">
                                            Hab Hora
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Numero de Remision -->
                            <?php 
                            $firephp->fb($rol_user ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_num_hora = " ";
                                    break;
                                    default:
                                        $permisos_num_hora = "disabled = 'true'";
                                    break;
                                }
                            ?>
                            <div class="col-md-2">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_habilitar_nremision"
                                            id="check_habilitar_nremision" <?php print_r($permisos_num_hora); ?>>
                                        <label for="check_habilitar_nremision">
                                            Hab Numero
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <?php 
                            $firephp->fb($rol_user ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_cli_obra = " ";
                                    break;
                                    default:
                                        $permisos_cli_obra = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_habilitar_cli_obra"
                                            id="check_habilitar_cli_obra" <?php print_r($permisos_cli_obra); ?>>
                                        <label for="check_habilitar_cli_obra">
                                            Habilitar Cliente y Obra
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="txt_nremi"> Hora Remision</label>
                                    <input type="text" class="form-control" id="txt_hremi" name="txt_hremi"
                                        value="<?php print_r($hora_remi); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="txt_nremi"> Numero Remision</label>
                                    <input type="text" class="form-control" id="txt_nremi" name="txt_nremi"
                                        value="<?php print_r($codigo_remi); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_cliente">Cliente</label>
                                    <select id="txt_cliente" name="txt_cliente" class="form-control select2"
                                        disabled="disabled">
                                        <?php print_r($t1_terceros->option_cliente_edit($id_cliente)); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_obra">Obra</label>
                                    <select id="txt_obra" name="txt_obra" class="form-control select2"
                                        disabled="disabled">
                                        <?php echo $t5_obras->option_obra($id_cliente, $id_obra); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <!-- Conductor y Mixer -->
                                        <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                    
                                            case 8:
                                            case 15:
                                            case 16:
                                            case 20:
                                            case 29:
                                            case 22:
                                        $permisos_conductor_mix = " ";
                                    break;
                                    default:
                                        $permisos_conductor_mix = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="check_hab_mix_cond" name="check_hab_mix_cond"
                                                    value="1" <?php print_r($permisos_conductor_mix); ?>>
                                                <label for="check_hab_mix_cond">
                                                    Habilitar Conductor y Mixer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="txt_vehiculo"> Mixer</label>
                                            <select id="txt_vehiculo" name="txt_vehiculo" class="form-control select2"
                                                disabled="disabled">
                                                <?php echo $t10_vehiculo->select_vehiculo_edit($placa); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="txt_conductor"> Conductor</label>
                                            <select id="txt_conductor" name="txt_conductor" class="form-control select2"
                                                disabled="disabled">
                                                <?php echo $t1_terceros->option_conductor_edit($id_conductor); ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                    case 8:
                                    case 15:
                                    case 16:
                                    case 20:
                                    case 29:
                                    case 22:
                                            $permisos_m3 = " ";
                                    break;
                                    default:
                                        $permisos_m3 = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="check_hab_m3" name="check_hab_m3" value="1"
                                                    <?php print_r($permisos_m3); ?>>
                                                <label for="check_hab_m3">
                                                    Habilitar m3
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_producto = " ";
                                    break;
                                    default:
                                        $permisos_producto = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="check_hab_producto" name="check_hab_producto"
                                                    value="1" <?php print_r($permisos_producto); ?>>
                                                <label for="check_hab_producto">
                                                    Habilitar producto
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_sello = " ";
                                    break;
                                    default:
                                        $permisos_sello = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="check_hab_sello" name="check_hab_sello"
                                                    value="1" <?php print_r($permisos_sello); ?>>
                                                <label for="check_hab_sello">
                                                    Habilitar
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="txt_m3"> M3</label>
                                            <input type="text" class="form-control" id="txt_m3" name="txt_m3"
                                                value="<?php print_r($m3); ?>" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="txt_producto"> Producto</label>
                                            <select id="txt_producto" name="txt_producto" class="form-control select2"
                                                disabled="disabled">
                                                <?php echo $t4_productos->option_producto_edit($id_producto); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="txt_asentamiento"> Asentamiento</label>
                                            <input type="text" class="form-control" id="txt_asentamiento"
                                                name="txt_asentamiento" value="<?php print_r($asentamiento); ?>"
                                                disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="txt_sello"> Sello de Seguridad</label>
                                        <input type="text" class="form-control" id="txt_sello" name="txt_sello"
                                            value="<?php print_r($sello); ?>" disabled="disabled">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-6">
                                        <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_std = " ";
                                    break;
                                    default:
                                        $permisos_std = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="check_hab_std" name="check_hab_std" value="1"
                                                    <?php print_r($permisos_std); ?>>
                                                <label for="check_hab_std">
                                                    Habilitar Estado
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="txt_estado"> Estado</label>
                                            <select id="txt_estado" name="txt_estado" class="form-control select2"
                                                disabled="disabled">
                                                <option value="1"> Facturada</option>
                                                <option value="2"> Pendiente de Facturacion</option>
                                                <option value="3"> Falta Firma Cliente</option>
                                                <option value="4"> Error de Sincronizacion</option>
                                                <option value="5"> CONSUMO INTERNO</option>
                                                <option value="10"> Anulada</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <?php
                            switch ($estado) {
                                case 1:
                                    $clase_status = "bg-gradient-success";
                                    $text_status = "FACTURADA";
                                    break;
                                case 2:
                                    $clase_status = "bg-gradient-info";
                                    $text_status = "POR FACTURAR";
                                    break;
                                case 3:
                                    $clase_status = "bg-gradient-warning";
                                    $text_status = "FALTA FIRMA";
                                    break;
                                case 4:
                                    $clase_status = "bg-gradient-navy";
                                    $text_status = "POR SINCRONIZAR";
                                    break;
                                    case 5:
                                    $clase_status = "bg-gradient-navy";
                                    $text_status = "CONSUMO INTERNO";
                                    break;
                                case 10:
                                    $clase_status = "bg-gradient-danger";
                                    $text_status = "ANULADA";
                                    break;
                                default:
                                    $clase_status = "bg-gradient-gray";
                                    $text_status = "ERROR";
                                    break;
                            }

                            ?>
                                        <div class="info-box <?php print_r($clase_status); ?>">
                                            <div class="info-box-content" align="center">
                                                <span class="info-box-text">
                                                    <h3> <strong><?php print_r($text_status) ?></strong> </h3>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <hr>
                        <hr>

                        <!------------------------------------------------------->

                        <!------------------------------------------------------->


                        <hr>
                        <div class="row">
                            <div class="col">
                                <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_arch = " ";
                                    break;
                                    default:
                                        $permisos_arch = "disabled = 'true'";
                                    break;
                                }
                            ?>
                                <div class="form-group">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="check_habilitar" name="check_habilitar" value="1"
                                                <?php print_r($permisos_arch); ?>>
                                            <label for="check_habilitar">
                                                Seleccione Subir Remision fisica
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Subir Imagen</label>
                                    <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                        value="image/x-png,image/jpeg" required checked="">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Subir PDF</label>
                                    <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                        value="application/pdf" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <?php
                                    if (empty($img_remi)) {
                                        $img_remi = "../ver_remision/remision.php?id=" .  $php_clases->HR_Crypt($id_remision, 1);
                                    }
                                    ?>
                                    <a target="_blank" href="<?php echo $img_remi ?>" class="btn btn-info"> <i
                                            class="fas fa-eye"></i> Ver Remision</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div>
                                        <input type="file" class="form-control" name="imgfiles" id="imgfiles"
                                            accept="image/x-png,image/jpeg" disabled="disabled" required="required" />
                                        <label class="" for="imgfiles">Seleccionar Archivo</label>
                                    </div>
                                    <!-- <input class="form-control" type="file" name="imgfiles2" id="imgfiles2" accept="image/x-png,image/jpeg" disabled="disabled" />
                                    <label class="custom-file-label" for="imgfiles2">Choose file</label> !-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        case 20:
                                            case 22:
                                            case 26:
                                        $disabled_horas = " ";
                                    break;
                                    default:
                                        $disabled_horas = "disabled = 'true'";
                                    break;
                                }
                            ?>

                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" value="1" name="check_habilitar_horas"
                                                id="check_habilitar_horas" <?php print_r($disabled_horas);  ?>
                                                <?php print_r($disabled_horas); ?>>
                                            <label for="check_habilitar_horas">
                                                Seleccione para editar Horas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_salida_mix_planta">HORA DE SALIDA MIXER DE PLANTA</label>

                                    <input type="time" name="h_salida_mix_planta" id="h_salida_mix_planta"
                                        value='<?php echo $hora_salida_planta ?>' disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_llegada_mix_obra">HORA DE LLEGADA MIXER A OBRA</label>
                                    <input type="time" name="h_llegada_mix_obra" id="h_llegada_mix_obra"
                                        value="<?php echo $hora_llegada_obra ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_inicio_descargue">HORA DE INICIO DE DESCARGUE</label>
                                    <input type="time" name="h_inicio_descargue" id="h_inicio_descargue"
                                        value="<?php echo $hora_inicio_descargue ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_terminacion_descargue">HORA DE TERMINACION DE DESCARGUE</label>
                                    <input type="time" name="h_terminacion_descargue" id="h_terminacion_descargue"
                                        value="<?php echo $hora_teminada_descargue ?>" disabled="disabled">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="h_llegada_mix_planta">HORA DE LLEGADA MIXER EN PLANTA</label>
                                    <input type="time" name="h_llegada_mix_planta" id="h_llegada_mix_planta"
                                        value="<?php echo  $hora_llegada_planta ?>" disabled="disabled">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php 
                            $firephp->fb('' ,FirePHP::LOG);
                                switch ($rol_user) {
                                    case 1:
                                        case 8:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 29:
                                        case 22:
                                        $permisos_btn = " ";
                                    break;
                                    default:
                                        $permisos_btn = "disabled = 'true'";
                                    break;
                                }
                            ?>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-success"
                                        name="btn_actualizar_remi" id="btn_actualizar_remi"> Actualizar</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-orange" data-toggle="modal"
                                        data-target="#modal-anular" <?php echo $permisos_btn ?>> <i
                                            class="fas fa-ban"></i>
                                        Anular</button>
                                </div>
                            </div>

                            <!-- /.modal -->
                            <div class="col-5"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-danger" data-toggle="modal"
                                        data-target="#modal-eliminar" <?php echo $permisos_btn ?>> <i
                                            class="fas fa-trash"></i> Eliminar Remision</button>
                                </div>
                            </div>


                            <!---------------------------------------------------------------------------------  -->

                    </form>




                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="modal fade" id="modal-anular">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de anular la remision </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Escriba la Razon de anular la remision</label>
                                <input type="text" name="txt_rz_anular" id="txt_rz_anular" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn-anular">anular</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-eliminar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de eliminar la remision </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Escriba la Razon de eliminar la remision</label>
                                <input type="text" name="txt_rz_eliminar" id="txt_rz_eliminar" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn-eliminar">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
</div>

</section>
</div>



<?php include '../../../layout/footer/footer3.php' ?>

<script>
$(document).ready(function() {
    $('.select2').select2();

});
$(document).ready(function() {
    $('.tipoarchivo').change(function() {
        $('#imgfiles').attr("accept", $('input[name=subirtipo]:checked').val());
    });
});
</script>

<script>
$(document).ready(function() {
    $("#form_update").on('submit', (function(e) {
        e.preventDefault();

        $.ajax({
            url: "php_editar_avanzado.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('exitoso');

                } else {
                    for (let index = 0; index < datos_errores.length; index++) {

                        toastr.warning(data.errores[index]);
                    }
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));
});

$(document).ready(function() {

    $("#btn-eliminar").click(function() {
        var id_remi = "<?php echo $_GET['id'] ?>";
        var url = "../index.php";
        var txt_rz_eliminar = $('#txt_rz_eliminar').val();
        $.ajax({
            url: "php_eliminar.php",
            type: "POST",
            data: {
                id_remi: id_remi,
                txt_rz_eliminar: txt_rz_eliminar,
            },
            success: function(response) {
                console.log(response.estado);
                if (response.estado) {
                    window.window.location = url;
                } else {
                    toastr.warning("Error al eliminar la remision");
                    toastr.warning("Contactar con el Administrador");
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
                window.window.location = url;
            },

        });
    });

    $("#btn-anular").click(function() {

        //var url = "../index.php";
        $.ajax({
            url: "php_anular.php",
            type: "POST",
            data: {
                'id_remi': <?php echo $_GET['id'] ?>,
                'rz_anular': $('#txt_rz_anular').val()
            },
            success: function(response) {
                if (response.estado) {
                    toastr.success("Anulo Exitosamente la remision");
                    location.reload();

                } else {
                    toastr.warning("Error al anular la remision");
                    toastr.warning("Contactar con el Administrador");
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },

        });
    });

    $('#txt_cliente').on('change', function() {

        $.ajax({
            url: "get_data.php",
            type: "POST",
            data: {
                idCliente: ($('#txt_cliente').val()),
                task: "1",
            },
            success: function(response) {

                $('#txt_obra').html(response.obras);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });
})
</script>

<script>
$(document).ready(function() {

    $('#check_habilitar_nremision').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_nremi").attr('disabled', true);

        } else {
            $("#txt_nremi").attr('disabled', false);

        }
    });

    $('#check_habilitar_hremision').click(function() {
        if (!$(this).is(':checked')) {
            $('#txt_hremi').attr('disabled', true);
        } else {
            $('#txt_hremi').attr('disabled', false);
        }
    });



    $('#check_hab_m3').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_m3").attr('disabled', true);
        } else {
            $("#txt_m3").attr('disabled', false);
        }
    });

    $('#check_hab_std').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_estado").attr('disabled', true);
        } else {
            $("#txt_estado").attr('disabled', false);
        }
    });

    $('#check_hab_sello').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_asentamiento").attr('disabled', true);
            $("#txt_sello").attr('disabled', true);
        } else {
            $("#txt_asentamiento").attr('disabled', false);
            $("#txt_sello").attr('disabled', false);
        }
    });

    $('#check_hab_producto').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_producto").attr('disabled', true);
        } else {
            $("#txt_producto").attr('disabled', false);
        }
    });


    $('#check_hab_mix_cond').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_vehiculo").attr('disabled', true);
            $("#txt_conductor").attr('disabled', true);
        } else {
            $("#txt_vehiculo").attr('disabled', false);
            $("#txt_conductor").attr('disabled', false);
        }
    });



    $('#check_habilitar_cli_obra').click(function() {
        if (!$(this).is(':checked')) {
            $("#txt_cliente").attr('disabled', true);
            $("#txt_obra").attr('disabled', true);
        } else {
            $("#txt_cliente").attr('disabled', false);
            $("#txt_obra").attr('disabled', false);
        }
    });


    $('#check_habilitar').click(function() {
        if (!$(this).is(':checked')) {

            $("#imgfiles").attr('disabled', true);
        } else {
            $("#imgfiles").attr('disabled', false);
        }
    });


    $('#check_habilitar_horas').click(function() {
        if (!$(this).is(':checked')) {
            $("#h_salida_mix_planta").attr('disabled', true);
            $("#h_llegada_mix_obra").attr('disabled', true);
            $("#h_inicio_descargue").attr('disabled', true);
            $("#h_terminacion_descargue").attr('disabled', true);
            $("#h_llegada_mix_planta").attr('disabled', true);
        } else {
            $("#h_salida_mix_planta").attr('disabled', false);
            $("#h_llegada_mix_obra").attr('disabled', false);
            $("#h_inicio_descargue").attr('disabled', false);
            $("#h_terminacion_descargue").attr('disabled', false);
            $("#h_llegada_mix_planta").attr('disabled', false);
        }
    });



});
</script>








</body>

</html>