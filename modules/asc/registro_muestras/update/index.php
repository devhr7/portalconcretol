<?php include '../../../../layout/validar_session4.php' ?>

<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$cls_laboratorio = new cls_laboratorio();
$cls_productos = new t4_productos();

$datos_muestra = $cls_laboratorio->get_data_muestras_for_id($_GET['id']);

$op_cementante = $cls_laboratorio->get_dataCementante($datos_muestra['id_remision']);
$TotalRegistroCargue = $cls_laboratorio->get_TotalRegistroCargue($datos_muestra['id_remision']);


fb($op_cementante, FirePHP::LOG);
fb($TotalRegistroCargue, FirePHP::LOG);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Inicio</a></li>
                        <!--<li class="breadcrumb-item active">Legacy User Menu</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"> <button class='btn btn-danger btn-sm' id="btn_eliminar_muestra"> <i class='fas fa-trash-alt'></i> </button> EDITAR MUESTRA <B><?PHP echo $_GET['id'] ?></B> </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="form_update_muestra" name="form_update_muestra" method="post">
                    <input type="hidden" name="txt_id_muestra" id="txt_id_muestra" value="<?php echo $_GET['id'] ?>">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Fecha de Toma</label>
                                <?php switch ($rol_user) {
                                    case 1:
                                    case 9:
                                    case 10:
                                    case 11:

                                ?>
                                        <input type="date" name="txt_fecha_muestra" id="txt_fecha_muestra" class="form-control" value="<?php echo $datos_muestra['fecha_muestra'] ?>" />
                                    <?php break;
                                    default:
                                    ?>
                                        <h6><span id="htfecha_muestra"> <?php echo $datos_muestra['fecha_muestra']; ?> </span></h6>
                                <?php break;
                                } ?>

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Hora de Toma</label>
                                <?php switch ($rol_user) {
                                    case 1:
                                    case 9:
                                    case 10:
                                    case 11:

                                ?>
                                        <input type="text" name="txt_hora_muestra" id="txt_hora_muestra" class="form-control" value="<?php echo $datos_muestra['hora_muestra'] ?>" required="true">
                                    <?php break;
                                    default:
                                    ?>
                                        <h6><span id="hthora_muestra"> <?php echo $datos_muestra['hora_muestra']; ?> </span></h6>
                                <?php break;
                                } ?>

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Temperatura</label>
                                <?php switch ($rol_user) {
                                    case 1:
                                    case 9:
                                    case 10:
                                    case 11:

                                ?>
                                        <input type="text" name="txt_temperatura" id="txt_temperatura" class="form-control" value="<?php echo $datos_muestra['temperatura'] ?>" required="true">
                                    <?php break;
                                    default:
                                    ?>
                                        <h6><span id="httempetatura"> <?php echo $datos_muestra['temperatura']; ?> </span></h6>
                                <?php break;
                                } ?>

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Asentamiento</label>

                                <?php switch ($rol_user) {
                                    case 1:
                                    case 9:
                                    case 10:    

                                ?>
                                        <input type="text" name="txt_asentamiento" id="txt_asentamiento" class="form-control" value="<?php echo $datos_muestra['asentamiento'] ?>" required="true">
                                    <?php break;
                                    default:
                                    ?>
                                        <h6><span id="htasentamiento"> <?php echo $datos_muestra['asentamiento']; ?> </span></h6>
                                <?php break;
                                } ?>

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Codigo Remision</label>

                                <h6><span id="htcod_remi"> <?php echo $datos_muestra['cod_remi']; ?> </span></h6>
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                                <label for="">Cliente</label>
                                <h6><span id="htnombre_cliente"><?php echo $datos_muestra['cliente']; ?></span></h6>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Obra</label>
                                <h6><span id="htnombre_obra"><?php echo $datos_muestra['obra']; ?></span></h6>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Sede</label>
                                <select name="txt_sede" id="txt_sede" class="form-control select2" required="true">
                                    <?php echo $cls_laboratorio->option_sede($datos_muestra['sede']) ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label>Consecutivo Interno</label>
                                <input type="text" name="txt_consecutivo_interno" id="txt_consecutivo_interno" class="form-control" value="<?php if ($datos_muestra['consecutivo_interno']) {
                                                                                                                                                echo $datos_muestra['consecutivo_interno'];
                                                                                                                                            } else {
                                                                                                                                                echo $datos_muestra['sede'] . "26";
                                                                                                                                            } ?>">

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Diseño</label>
                                <?php if ($datos_muestra['id_remision'] > 0) : ?>
                                    <h6><span id="htdiseño"><?php echo $datos_muestra['codigo_producto'] . " - " . $datos_muestra['descripcion_producto'] ?></span></h6>
                                <?php else : ?>
                                    <select name="txt_producto" id="txt_producto" class="select2 form-control">
                                        <?php echo $cls_productos->option_producto_edit($datos_muestra['id_producto']); ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Metros Cubicos</label>
                                <h6><span id="htmetros"><?php echo $datos_muestra['metros_cubicos']; ?></span> M3</h6>

                            </div>
                        </div>
                        <div class="col-1">

                            <div class="form-group">
                                <label for="">Mixer</label>
                                <h6><span id="htplaca"><?php echo $datos_muestra['placa']; ?></span></h6>
                            </div>

                        </div>
                        <div class="col-2">

                            <div class="form-group">
                                <label for="">Tomada Por:</label>
                                <select name="txt_tomada_muestra" id="txt_tomada_muestra" class="form-control select2" required="true">
                                    <?php echo $cls_laboratorio->option_responsablemuestra($datos_muestra['id_responsable']) ?> ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-2">

                            <div class="form-group">
                                <label for="">Tomada Por:</label>
                                <input type="text" name="txt_nombre_tomada_muestra" id="txt_nombre_tomada_muestra" class="form-control" value="<?php echo $datos_muestra['nombre_responsable'] ?>">
                            </div>

                        </div>



                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Cementante</label>
                                <select name="txt_tipocementante" id="txt_tipocementante" class="form-control select2" required="true">
                                    <?php echo $cls_laboratorio->option_cementantes($datos_muestra['id_nombre_cementante']); ?> </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Cementante (KG/M3)(<?php echo $op_cementante ?>)</label>
                                <input type="text" name="txt_cementante" id="txt_cementante" class="form-control" value="<?php
                                                                                                                            if (is_null($datos_muestra['cementante_kg'])) {
                                                                                                                                echo $op_cementante;
                                                                                                                            } else {
                                                                                                                                echo $datos_muestra['cementante_kg'];
                                                                                                                            }
                                                                                                                            ?>" />



                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Ceniza(%)</label>
                                <input type="text" name="txt_ceniza" id="txt_ceniza" class="form-control" value="<?php echo $datos_muestra['ceniza'] ?>" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Resistencia(<?php echo  substr($datos_muestra['codigo_producto'], 2, 3); ?>) </label>
                                <input type="text" name="txt_resistencia" id="txt_resistencia" class="form-control" placeholder="" value="<?php echo $datos_muestra['resistencia'] ?>" required="true" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Aire(%)</label>
                                <input type="text" name="txt_aire" id="txt_aire" class="form-control" value="<?php echo $datos_muestra['aire'] ?>" />

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Rendimiento Volumetrico</label>
                                <h6><span id="htrend_vol"> <?php echo $datos_muestra['rend_volumetrico']; ?> </span></h6>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for=""></label>
                                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#mo"><i class="fas fa-mountain"></i>Arena</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for=""> </label>
                                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal_registrar_manejeabilidad"><i class="fas fa-mountain"></i>Manejabilidad</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for=""> </label>
                                <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal_registrar_rendimiento_volumentro"><i class="fas fa-mountain"></i>Rendimiento Volumetrico</button>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="">Diametro probeta(cm)</label>
                                <select name="txt_diametro_probeta" id="txt_diametro_probeta" class="form-control select2" required="true">
                                    <?php echo $cls_laboratorio->option_probeta($datos_muestra['id_probeta']) ?> ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <input type="text" name="txt_observaciones_muestra" id="txt_observaciones_muestra" class="form-control" value='<?php echo $datos_muestra['observaciones']; ?>'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="card-header card-outline card-secondary">
                <h3 class="card-title"> PROGRAMACION DE LA MUESTRA <B><?PHP echo $_GET['id'] ?></B> </h3>
                <div class="card-tools">
                    <div class="form-group">
                        <button type="button" id="btn_cargar_programacion" class=" btn btn-secondary"> <i class="fas fa-calendar-alt"></i> Cargar</button>
                        <button type="button" class=" btn btn-warning " data-toggle="modal" data-target="#modal_programar_fallos"> <i class="fas fa-calendar-alt"></i> Programar Fallos</button>
                    </div>

                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <table id="table_resumen_prog_resultados" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha Programada</th>
                                        <th>1 Dia</th>
                                        <th>3 Dias</th>
                                        <th>7 Dias</th>
                                        <th>14 Dias</th>
                                        <th>28 Dias</th>
                                        <th>56 Dias</th>

                                    </tr>
                                </thead>
                                <tbody></tbody>

                            </table>
                        </div>
                    </div>
                </div>




            </div>
            <!-- /.card-body -->
            <div>
                <div class="modal fade" id="modal_programar_fallos">
                    <div class="modal-dialog  modal-xl">
                        <div class="modal-content">
                            <form name="form_crear_programar_fallos" id="form_crear_programar_fallos" method="post">
                                <input type="hidden" name="txt_id_muestra1" id="txt_id_muestra1" value="<?php echo $_GET['id']; ?>" />
                                <div class="modal-header">
                                    <h4 class="modal-title">Programar Fallos</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Seleccione el periodo</label>
                                                <select name="txt_periodo_fallo" id="txt_periodo_fallo" value="" class="form-control select2" required>
                                                    <<?php echo $cls_laboratorio->option_periodos(); ?> </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Numero de Cilindros</label>
                                                <input type="number" name="txt_num_cilindros" id="txt_num_cilindros" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" id="btn_eliminar_cotizacion">Adicionar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <table id="table_prog_resultados" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>N</th>
                                                    <th>Periodo</th>
                                                    <th>Fecha Programada</th>
                                                    <th>Numero Cilindros</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


                <div class="modal fade" id="modal_registrar_fallo">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form name="form_crear_resultado_fallos" id="form_crear_resultado_fallos" method="post">
                                <input type="hidden" name="txt_id_muestra2" id="txt_id_muestra2" value="<?php echo $_GET['id']; ?>" />

                                <div class="modal-header">
                                    <h4 class="modal-title">Registrar Resultados de Fallos</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Fallo</label>
                                                <select name="txt_registrar_fallo" id="txt_registrar_fallo" class="form-control" required>
                                                    <?php echo $cls_laboratorio->option_tipo_fallo(); ?> </select>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Tipo Fallo</label>
                                                <select name="txt_registrar_tipo_fallo" id="txt_registrar_tipo_fallo" class="form-control">
                                                    <option value="0">seleccione</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Seleccione el periodo</label>
                                                <select name="txt_registrar_periodo" id="txt_registrar_periodo" class="form-control">
                                                    <?php echo $cls_laboratorio->option_periodos(); ?> </select>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Fecha de Resultado</label>
                                                <input type="date" name="txt_fecha_resultado" id="txt_fecha_resultado" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Resultado (Kn)</label>
                                                <input type="text" name="txt_resultadokn" id="txt_resultadokn" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Observaciones</label>
                                                <input type="text" name="txt_obs_resultado" id="txt_obs_resultado" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Crear</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!--- ARENA --->
                <div class="modal fade" id="modal_registrar_arena">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form name="form_registrar_arena" id="form_registrar_arena" method="post">
                                <input type="hidden" name="txt_id_muestra3" id="txt_id_muestra3" value="<?php echo $_GET['id']; ?>" />
                                <div class="modal-header">
                                    <h4 class="modal-title">Registrar Resultados de Fallos</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Fallo</label>
                                                <select name="txt_registrar_fallo" id="txt_registrar_fallo" class="form-control">
                                                    <?php echo $cls_laboratorio->option_tipo_fallo(); ?> </select>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Tipo Fallo</label>
                                                <select name="txt_registrar_tipo_fallo" id="txt_registrar_tipo_fallo" class="form-control">
                                                    <option value="0">seleccione</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Seleccione el periodo</label>
                                                <select name="txt_registrar_periodo" id="txt_registrar_periodo" class="form-control">
                                                    <?php echo $cls_laboratorio->option_periodos(); ?> </select>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Fecha de Resultado</label>
                                                <input type="date" name="txt_fecha_resultado" id="txt_fecha_resultado" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Resultado (Kn)</label>
                                                <input type="text" name="txt_resultadokn" id="txt_resultadokn" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Observaciones</label>
                                                <input type="text" name="txt_obs_resultado" id="txt_obs_resultado" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Crear</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!----- REGISTRAR MANEJEABILIDAD -->
                <div class="modal fade" id="modal_registrar_manejeabilidad">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Registrar Manejeabilidad</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="form_registrar_manejeabilidad" id="form_registrar_manejeabilidad" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Hora</label>
                                            <input type="time" name="txt_registrar_hora_manejeabilidad" id="txt_registrar_hora_manejeabilidad" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="">Asentamiento</label>
                                            <input type="text" name="txt_registrar_asentamiento_manejeabilidad" id="txt_registrar_asentamiento_manejeabilidad" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="">Temperatura</label>
                                            <input type="text" name="txt_registrar_temp_manejeabilidad" id="txt_registrar_temp_manejeabilidad" class="form-control">
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for=""> </label>
                                                <button type="submit" class="btn btn-success form-control">Crear</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col">
                                        <table id="tabla_manejeabilidad">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Hora</th>
                                                    <th>Asentamiento</th>
                                                    <th>Temperatura</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!------ RENDIMIENTO VOLUMETRICO --->
                <div class="modal fade" id="modal_registrar_rendimiento_volumentro">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Rendimiento Volumentrico</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="form_registrar_rend_vol" id="form_registrar_rend_vol" method="post">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">TOTAL (KG) VIAJE EN REGISGRO DE CARGUE (<?php echo $TotalRegistroCargue ?>)</label>
                                                <input type="text" name="txt_rendvol_total_reg_viaje" id="txt_rendvol_total_reg_viaje" class="form-control" value="<?php

                                                                                                                                                                    if (is_null(null)) {
                                                                                                                                                                        echo $TotalRegistroCargue;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo 0;
                                                                                                                                                                    }
                                                                                                                                                                    ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">PESO OLLA + CONCRETO (kg) [B]:</label>
                                                <input type="text" name="txt_rendvol_pesoollamasconcreto" id="txt_rendvol_pesoollamasconcreto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="button" class="form-control btn btn-info" id="btn_calcular_rend_vol">Calcular</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <small><b>VOLUMEN OLLA (m3):</b></small>
                                                <input type="text" name="txt_vol_olla" id="txt_vol_olla" value="0.007" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small><b>PESO OLLA (kg) [A]:</b></small>
                                                <input type="text" name="txt_peso_olla" id="txt_peso_olla" value="2830" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small><b>PESO NETO (kg) : [B-A] :</b></small>
                                                <span id="html_rendvol_pesoneto">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-gorup">
                                                <small><b>Masa unitaria (kg/m3) :</b> [peso neto (kg)) /( volumen olla (m3)]</small>
                                                <span id="html_rendvol_masaunitaria">0.00</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <small><b>Volumen real (m3) : </b>[Registro de cargue (kg) / masa unitaria (kg/m3]</small>
                                                <span id="html_rendvol_volumen_real">0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label><b>Rendimiento Volumetrico </b> : [ volumen real (m3)) / (volumen remision (m3)]</label>
                                                <h3><span id="html_rendvol_rst">00</span></h3>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success" id="btn_guardar_rend_vol"> Guardar Rendimiento Volumetrico</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>

            <div class="card-header card-outline card-secondary">
                <h3 class="card-title"> RESULTADOS DE LA MUESTRA <B><?PHP echo $_GET['id'] ?></B> </h3>
                <div class="card-tools">
                    <button class="btn btn-secondary " id="btn_registrar_resultado" data-toggle="modal" data-target="#modal_registrar_fallo"> <i class="fas fa-flask"></i> Registrar Resultado</button>
                </div>
            </div>
            <div class="card-body">
                <table id="table_resultado_cilindro" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Fecha Ensayo</th>
                            <th>Periodo</th>
                            <th>Resultado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="card-header card-outline card-secondary">
                <h3 class="card-title"> CONSOLIDADO DE LOS RESULTADOS DE LA MUESTRA <B><?PHP echo $_GET['id'] ?></B> </h3>
                <div class="card-tools">
                    <span id="alert_html"><?php echo $cls_laboratorio->alert_resultado_consolidado($_GET['id']);
                                            ?></span>

                </div>
            </div>
            <div class="card-body">
                <table id="table_resultado_consolidado" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Periodo</th>
                            <th>promediokgcm2</th>
                            <th>porcentaje</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- MODALES -->


<!------->
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    /** FORMULARIO CREAR MUESTRA */
    $(document).ready(function(e) {
        $('.select2').select2();

        $("#txt_registrar_tipo_fallo").attr("disabled", true)

        $('#txt_registrar_fallo').on('change', function() {
            if ($("#txt_registrar_fallo").val() == "2") {
                $("#txt_registrar_tipo_fallo").attr("disabled", true)
            } else {
                $("#txt_registrar_tipo_fallo").attr("disabled", false)
            }
        });

        $('#txt_tomada_muestra').on('change', function() {
            if ($("#txt_tomada_muestra").val() == "externo") {
                $("#txt_nombre_tomada_muestra").attr("disabled", false)
            } else {
                $("#txt_nombre_tomada_muestra").attr("disabled", true)
            }
        });




        $('#txt_registrar_periodo').on('change', function() {

            let formData2 = new FormData();
            formData2.append('fecha_muestra', '<?php echo $datos_muestra['fecha_muestra'] ?>');
            formData2.append('id_periodo', $('#txt_registrar_periodo').val());
            $.ajax({
                url: "php_get_fecha_programada.php",
                type: "POST",
                data: formData2,
                processData: false,
                contentType: false,

                success: function(data) {
                    //console.log(data);
                    $("#txt_fecha_resultado").val(data.rst);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $("#form_update_muestra").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_update_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        /*** CREAR MANEJEABILIDAD*/
        $("#form_registrar_manejeabilidad").on('submit', (function(e) {
            e.preventDefault();
            const FormDatos = new FormData(this);
            FormDatos.append('id_muestra', '<?php echo $_GET['id'] ?>');
            //FormDatos.append('DATOSP', this);
            console.log(FormDatos);
            $.ajax({
                url: "php_crear_manejeabilidad.php",
                type: "POST",
                data: FormDatos,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        /** CREAR  */
        $("#form_crear_programar_fallos").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_prog_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        /** CREAR RESULTADO MUESTRA */
        $("#form_crear_resultado_fallos").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_resultado_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                        $("#alert_html").html(data.post.alerta);
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));


        /** CREAR RENDIMIENTO VOLUMETRICO */
        $("#form_registrar_rend_vol").on('submit', (function(e) {
            e.preventDefault();
            const FormDatos = new FormData(this);

            var id_muestra = <?php echo $_GET['id']; ?>;
            var metroscubicos = '<?php echo $datos_muestra['metros_cubicos'] ?>';
            var peso_olla = $("#txt_peso_olla").val();

            var volumen_olla = $("#txt_vol_olla").val();
            FormDatos.append('id_muestra', id_muestra);
            FormDatos.append('totalkgcargue', $("#txt_rendvol_total_reg_viaje").val());
            FormDatos.append('pesoolla_mas_concreto', $("#txt_rendvol_pesoollamasconcreto").val());
            FormDatos.append('metroscubicos', metroscubicos);
            FormDatos.append('peso_olla', peso_olla);
            FormDatos.append('volumen_olla', volumen_olla);
            $.ajax({
                url: "php_crear_rend_volumetrico.php",
                type: "POST",
                data: FormDatos,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                        window.location.reload()

                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));


        $("#btn_cargar_programacion").click(function() {
            let formDatos = new FormData();
            formDatos.append('id_muestra', <?php echo $_GET['id']; ?>);
            $.ajax({
                url: "php_cargar_prog.php",
                type: "POST",
                data: formDatos,
                processData: false,
                contentType: false,

                success: function(data) {
                    //console.log(data);
                    $("#html_rendvol_pesoneto").html(data.rst.rendvol_peso_neto);
                    $("#html_rendvol_masaunitaria").html(data.rst.rendvol_masaunitaria);
                    $("#html_rendvol_volumen_real").html(data.rst.rendvol_volumenreal);
                    $("#html_rendvol_rst").html(data.rst.rend_volumetrico);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $("#btn_calcular_rend_vol").click(function() {
            let formDatosf = new FormData();
            var id_muestra = <?php echo $_GET['id']; ?>;
            var metroscubicos = '<?php echo $datos_muestra['metros_cubicos'] ?>';
            var peso_olla = $("#txt_peso_olla").val();

            var volumen_olla = $("#txt_vol_olla").val();
            formDatosf.append('id_muestra', id_muestra);
            formDatosf.append('totalkgcargue', $("#txt_rendvol_total_reg_viaje").val());
            formDatosf.append('pesoolla_mas_concreto', $("#txt_rendvol_pesoollamasconcreto").val());
            formDatosf.append('metroscubicos', metroscubicos);
            formDatosf.append('peso_olla', peso_olla);
            formDatosf.append('volumen_olla', volumen_olla);
            $.ajax({
                url: "php_calcular_rend_vol.php",
                type: "POST",
                data: formDatosf,
                processData: false,
                contentType: false,

                success: function(data) {
                    //console.log(data);
                    $("#html_rendvol_pesoneto").html(data.rst.rendvol_peso_neto);
                    $("#html_rendvol_masaunitaria").html(data.rst.rendvol_masaunitaria);
                    $("#html_rendvol_volumen_real").html(data.rst.rendvol_volumenreal);
                    $("#html_rendvol_rst").html(data.rst.rend_volumetrico);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });




    });

    /** TABLA REMISIONES */
    $(document).ready(function() {
        var n = 1;
        // Declarar funcion destruir tabla

        //*** TALA RESUMEN MANEJEABILIDAD */
        function datatable_manejeabilidad(id_muestra) {
            var table_manejeabilidad = $('#tabla_manejeabilidad').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_manejeabilidad.php",
                    'data': {
                        'id_muestra': id_muestra
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "hora"
                    },
                    {
                        "data": "asentamiento"
                    },
                    {
                        "data": "temperatura"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger btn-sm btn_delete'> <i class='fas fa-trash-alt'></i> </button>"
                    }

                ],

                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table_manejeabilidad.ajax.reload();
            return table_manejeabilidad;
        }

        if ($.fn.dataTable.isDataTable('#tabla_manejeabilidad')) {
            table_manejeabilidad = $('#tabla_manejeabilidad').datatable_manejeabilidad();
            table_manejeabilidad.destroy();
        }
        table_manejeabilidad = datatable_manejeabilidad(<?php echo $_GET['id'] ?>);
        setInterval(function() {

            table_manejeabilidad.ajax.reload(null, false);
        }, 2000);

        $('#tabla_manejeabilidad tbody').on('click', 'button.btn_delete', function() {
            var data = table_manejeabilidad.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: 'Esta seguro de eliminar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar_manejeabilidad.php",
                        type: "POST",
                        data: {
                            'id': data['id']
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Elininado Correctamente!',
                            )
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                    )
                }
            })
        });

        //*** TALA RESUMEN PROGRAMACION */
        function datatable_resumen_prog(id_muestra) {
            var table_resumen_prog = $('#table_resumen_prog_resultados').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_resumen_prog.php",
                    'data': {
                        'id_muestra': id_muestra
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "fecha_programada"
                    },
                    {
                        "data": "dia1"
                    },
                    {
                        "data": "dia3"
                    },
                    {
                        "data": "dia7"
                    },
                    {
                        "data": "dia14"
                    },
                    {
                        "data": "dia28"
                    },
                    {
                        "data": "dia56",

                    }
                ],
                rowCallback: function(row, data) {
                    var f = new Date();
                    fecha = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
                    var f2 = new Date(data['fecha_programada']);
                    fecha2 = f2.getFullYear() + "-" + (f2.getMonth() + 1) + "-" + (f2.getDate() + 1);
                    if (fecha2 == fecha) {
                        $($(row).find("td")).css("background-color", "#fef8a5");
                    }
                },
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table_resumen_prog.ajax.reload();
            return table_resumen_prog;
        }

        if ($.fn.dataTable.isDataTable('#table_resumen_prog_resultados')) {
            table_resumen_prog = $('#table_resumen_prog_resultados').datatable_resumen_prog();
            table_resumen_prog.destroy();
        }
        table_resumen_prog = datatable_resumen_prog(<?php echo $_GET['id'] ?>);
        setInterval(function() {

            table_resumen_prog.ajax.reload(null, false);
        }, 2000);

        /**  TABLA PROGRAMACION */
        function datatable_prog(id_muestra) {
            var table_prog = $('#table_prog_resultados').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_programacion.php",
                    'data': {
                        'id_muestra': id_muestra
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "nombre_periodo"
                    },
                    {
                        "data": "fecha_programada"
                    },
                    {
                        "data": "numerocilindros"
                    },

                    {
                        "data": null,
                        "defaultContent": "<button type='button' class='btn btn-danger btn-sm btn_delete'> <i class='fas fa-trash-alt'></i> </button>"

                    }
                ],
                rowCallback: function(row, data) {
                    var f = new Date();
                    fecha = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
                    var f2 = new Date(data['fecha_programada']);
                    fecha2 = f2.getFullYear() + "-" + (f2.getMonth() + 1) + "-" + (f2.getDate() + 1);
                    if (fecha2 == fecha) {
                        $($(row).find("td")).css("background-color", "#fef8a5");
                    }
                },
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table_prog.ajax.reload();
            return table_prog;
        }

        if ($.fn.dataTable.isDataTable('#table_prog_resultados')) {
            table_prog = $('#table_prog_resultados').datatable_prog();
            table_prog.destroy();
        }
        table_prog = datatable_prog(<?php echo $_GET['id'] ?>);
        setInterval(function() {
            table_prog.ajax.reload(null, false);
        }, 2000);

        $('#table_prog_resultados tbody').on('click', 'button.btn_delete', function() {
            var data = table_prog.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: 'Esta seguro de eliminar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar_prog.php",
                        type: "POST",
                        data: {
                            'id': data['id']
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Elininado Correctamente!',
                            )
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                    )
                }
            })

        });

        /***  RESULTADO CILINDROS*/
        function datatable_resultados(id_muestra) {
            var table_resultado = $('#table_resultado_cilindro').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_resultado_ensayo.php",
                    'data': {
                        'id_muestra': id_muestra
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "fecha_muestra"
                    },
                    {
                        "data": "nombre_periodo"
                    },
                    {
                        "data": "reultadokn"
                    },

                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger btn-sm btn_delete'> <i class='fas fa-trash-alt'></i> </button>"

                    }
                ],
                'paging': true,
                'searching': false,
                //"scrollX": true,
            });
            table_resultado.ajax.reload();
            return table_resultado;
        }

        if ($.fn.dataTable.isDataTable('#table_resultado_cilindro')) {
            table_resultado = $('#table_resultado_cilindro').datatable_resultados();
            table_resultado.destroy();
        }
        table_resultado = datatable_resultados(<?php echo $_GET['id'] ?>);
        setInterval(function() {
            table_resultado.ajax.reload(null, false);
        }, 2000);



        $('#table_resultado_cilindro tbody').on('click', 'button.btn_delete', function() {
            var data = table_resultado.row($(this).parents('tr')).data();
            var id = data['id'];

            Swal.fire({
                title: 'Esta seguro de eliminar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar_rst_muestra.php",
                        type: "POST",
                        data: {
                            id_resultado: data['id'],
                            id_muestra: <?php echo $_GET['id'] ?>,
                            id_periodo: data['id_periodo']
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Elininado Correctamente!',
                            )
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                    )
                }
            })


        });



        /***  RESULTADO CONSOLIDADO*/
        function datatable_resultados_consolidado(id_muestra) {
            var table_resultado_consolidado = $('#table_resultado_consolidado').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_resultado_consolidado.php",
                    'data': {
                        'id_muestra': id_muestra
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id_periodo"
                    },
                    {
                        "data": "nombre_periodo"
                    },
                    {
                        "data": "promediokgcm2"
                    },
                    {
                        "data": "porcentaje"
                    },


                ],
                rowCallback: function(row, data) {
                    if (data['id'] == 4) {
                        $($(row).find("td")).css("background-color", "#fef8a5");
                    }
                },
                'paging': false,
                'searching': false,
                //"scrollX": true,
            });
            table_resultado_consolidado.ajax.reload();
            return table_resultado_consolidado;
        }

        if ($.fn.dataTable.isDataTable('#table_resultado_consolidado')) {
            table_resultado_consolidado = $('#table_resultado_consolidado').datatable_resultados_consolidado();
            table_resultado_consolidado.destroy();
        }
        table_resultado_consolidado = datatable_resultados_consolidado(<?php echo $_GET['id'] ?>);
        setInterval(function() {
            table_resultado_consolidado.ajax.reload(null, false);
        }, 2000);


        $("#btn_eliminar_muestra").click(function() {
            var id_muestra = <?php echo $_GET['id'] ?>;
            Swal.fire({
                title: 'Esta seguro de eliminar la muesta ' + id_muestra,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar_muestra.php",
                        type: "POST",
                        data: {
                            id_muestra: <?php echo $_GET['id'] ?>,
                        },
                        success: function(data) {
                            window.location = "../index.php";

                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                    )
                }
            })

        });
    });

    $("#txt_sede").on('change', function() {
        if ($("#txt_sede").val() == "RMI") {
            $("#txt_consecutivo_interno").val("RMI2023");
        }
        if ($("#txt_sede").val() == "RMT") {
            $("#txt_consecutivo_interno").val("RMT2023");
        }
        if ($("#txt_sede").val() == "HND") {
            $("#txt_consecutivo_interno").val("HND2023");
        }
    });
</script>



</body>

</html>