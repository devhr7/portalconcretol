<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php //include '../../include/lib.php'; 
?>
<script>
    $("#resultado").hide();
    //$("#bloque-boton1").hide();
    $("#bloque-boton2").hide();
</script>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
?>


<?php
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();

$id_conductor = (int)$php_clases->HR_Crypt($_SESSION['id_usuario'], 2);


$t26_remisiones->validar_falta_horas_remi_conductor($id_conductor);

switch ($rol_user) {
    case 1:
    case 8:
    case 14:
    case 15:
    case 16:
    case 29:
    case 20:
    case 22:
    case 33:

    case '1':


        $t29_batch = new t29_batch();
        $php_clases = new php_clases();
        $t5_obras = new t5_obras();
        $t1_terceros = new t1_terceros();
        $t26_remisiones = new t26_remisiones();
        // $lib = new lib();

        if (isset($_GET['id'])) {
            $id_batch = $_GET['id'];
        }

        include 'datos_batch.php';


        break;

    default:
        //print('<script> window.location = "../../../cerrar.php"</script>');

        var_dump($rol_user);
        break;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DETALLE BATCH</h1>
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
                <h3 class="card-title"> Baches Anexada a la remision <span>
                        <strong><?php echo $remision_batch; ?> </strong>
                    </span></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div id="seccion2">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <form name="form_anular_batch" id="form_anular_batch" method="POST">
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-block btn-warning" id="anular">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;"> Desabilitar Batches</font>
                                                </font>
                                            </button>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="table-responsive p-0">
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>N</th>
                                                        <th> Estado </th>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>cliente</th>
                                                        <th>Obra</th>
                                                        <th>Metros</th>
                                                        <th>Producto</th>
                                                        <th>Asentamiento</th>
                                                        <th>Mixer</th>
                                                        <th>Conductor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $datos_batch = $t29_batch->select_batch_remi($remision_batch);

                                                    

                                                    foreach ($datos_batch as $datos) {
                                                        $planta = $datos['ct29_IdPlanta'];
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="id_batch[]" value="<?php echo $datos['ct29_Id'] ?>"> </td>
                                                            <td><?php echo $php_clases->estado_batch($datos['ct29_estado']); ?> </td>
                                                            <td><?php echo $datos['ct29_Fecha']; ?></td>
                                                            <td><?php echo $datos['ct29_Hora']; ?></td>
                                                            <td><?php echo $datos['ct29_IdCliente']; ?></td>
                                                            <td><?php echo $datos['ct29_IdObra']; ?></td>
                                                            <td><?php echo $datos['ct29_MetrosCubicos']; ?></td>
                                                            <td><?php echo $datos['ct29_NombreFormula'] . " - " . $datos['ct29_DescripcionFormula']; ?></td>
                                                            <td><?php echo $datos['ct29_Asentamiento']; ?></td>
                                                            <td><?php echo $datos['ct29_IdMixer']; ?></td>
                                                            <td><?php echo $datos['ct29_MixerDriver']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <span id="resultado">
                    <div class="callout callout-info">
                        <h5>Remision Generada!</h5>
                        <div class="row">
                            <div class="col">
                                <ul id="lista">
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <span id="boton_siguiente"></span>
                            </div>
                        </div>
                    </div>
                </span>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <a href="../ver_remision/remision.php?id=<?php echo $php_clases->HR_Crypt($remision_batch, 1);  ?>" class="btn btn-block btn-info" target="_blank"> <i class="fas fa-eye"></i> Vista Previa</a>
                        </div>

                    </div>
                    <div class="col-7"></div>
                    <?php
                    $id_remision = $t26_remisiones->get_remision_numero($remision_batch, $planta);
                    if ($id_remision) :
                    ?>

                        <div class="col-3">
                            <div class="form-group">
                                <a class="btn btn-block btn-success" href="../../remisiones/generar_remi/generate.php?id=<?php echo $php_clases->HR_Crypt($id_remision, 1)   ?>"><i class="fas fa-hand-point-right"></i> Siguiente</a>
                            </div>
                        </div>

                    <?php else : ?>
                        <div class="col-3">
                            <form name="form_generar" id="form_generar" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="txt_remision_batch" id="txt_remision_batch" value="<?php echo $php_clases->HR_Crypt($remision_batch, 1); ?>">
                                    <button type="submit" id="generar" class="btn btn-block btn-success">Guardar y Generar Remision</button>
                                </div>
                            </form>
                        </div>
                    <?php endif ?>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <!-- Large modal -->
                            <button type="button" class="btn btn-default " data-toggle="modal" data-target="#modal-xl" disabled="disabled">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        Vista Preliminar de la Remision
                                    </font>
                                </font>
                            </button>
                            <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
                            <div class="modal fade" id="modal-xl">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!---------------------------------------------------------------------------------------------------->
                                            <div id="remision">
                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <!-- Logo -->
                                                        <img src="../ver_remision/Logo.jpeg" class="img-thumbnail" width="90" height="100">
                                                    </div>

                                                    <div class="col-md-6 " style="justify-content: center;">
                                                        <!-- Titulo -->

                                                        <div class="row">
                                                            <div class="col-12" align="center">
                                                                <h5> CONCRE TOLIMA <h5>
                                                                        <h5>SUMINISTRO DE CONCRETO<h5>
                                                            </div>

                                                            <div class="col-md-12" align="center">
                                                                <small>NIT.900.180.449-9 - Regimen Comun <small>
                                                            </div>


                                                            <div class="col-md-12" align="center">
                                                                <h6>Avda. Mirolindo No. 77-56 </h6>
                                                                <h6>Tel:268 50 61 - Cels: 317 368 66 41 - 314 230 45 93 </h6>
                                                                <h6>concretolima@gmail.com Ibague - Tolima </h6>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-3 ">
                                                        <!-- Numero Remision -->
                                                        <div class="row">
                                                            <div id="titulo">
                                                                <h4>REMISION <h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div id="n_rem"><?php echo $remision_batch; ?></div>
                                                        </div>

                                                    </div>

                                                </div> <!--  /Encabezado -->
                                                <!---------------------------------------------------------------------------------------------------->

                                                <div class="row " id="estilo_t">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-md-1 col-sm-1 ">Fecha: </div>
                                                            <div class="col-md-5 col-sm-4"> viernes, 23 Octubre del 2020</div>
                                                            <div class="col-md-1 col-sm-2">Hora: </div>
                                                            <div class="col-md-5 col-sm-2"> 00 : 00 </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-1 col-sm-2 ">Cliente: </div>
                                                            <div class="col-5 col-sm-6"> CONCRETOLIMA</div>
                                                            <div class="col-1 col-sm-2">Mixer: </div>
                                                            <div class="col-5 col-sm-2"> WOZ335 </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-1 ">Obra: </div>
                                                            <div class="col-5 "> PLANTA TORREON</div>
                                                            <div class="col-1 ">Conductor: </div>
                                                            <div class="col-5 ">FABIAN FIERRO </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>

                                                <div class="row" id="estilo_t1">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-1 ">PLANTA:</div>
                                                            <div class="col-5 ">Linea 1 </div>
                                                            <div class="col-3 ">Sello de seguridad: </div>
                                                            <div class="col-3 ">
                                                                <div id="estilo_t"> 745254 </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row" id="estilo_t">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">Metros: </div>
                                                            <div class="col"> 8.00</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">Producto: </div>
                                                            <div class="col"> 245PC - 3500 PSI PLASTICO COMUN</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">Asentamiento: </div>
                                                            <div class="col"> 6" +/-1</div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row  justify-content-around ">
                                                            <div class="col-md-2" id="estilo_t">
                                                                <div class="row ">
                                                                    <div class="col centrado">
                                                                        Hora salida:
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        00:00
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-2" id="estilo_t">
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        Hora salida:
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        00:00
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1"></div>

                                                            <div class="col-md-2" id="estilo_t">
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        Hora salida:
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        00:00
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-2" id="estilo_t">
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        Hora salida:
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col centrado">
                                                                        00:00
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row" id="estilo_t">
                                                    <div clas="col-md-12">
                                                        <div class="row">
                                                            <div class="row" id="estilo_t2">Observaciones</div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

                        </div>
                    </div>





                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>
<script src="ajax_crear.js"></script>
<script src="ajax_anular.js"></script>
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });

</script>

</body>

</html>