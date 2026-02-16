<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<!-- Content Wrapper. Contains page content -->


<?php


$t8_programacion = new t8_programacion();


$last_id_programacion = $t8_programacion->generar_code_prog();



?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Programacion</h1>

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
                <h3 class="card-title">Crear Programacion</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div id="contenido">
                    <form method="POST" name="crear_prog" id="crear_prog">

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Linea de Despacho </label>
                                    <select class="form-control select2" name="txb_linea" id="txb_linea">
                                        <option disabled selected> Seleccione Linea de Despacho </option>
                                        <option value="Linea1"> Linea 1 </option>
                                        <option value="Linea2"> Linea 2 </option>
                                        <option Value="CiudadTorreon"> Ciudad Torreon </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label> Fecha </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input class="form-control" type="date" name="txb_fechaprog" id="txb_fechaprog" />
                                    </div>

                                </div>
                            </div>
                            <div class="col">
                                <div clasS="form-group">
                                    <label>Codigo de Programacion</label>
                                    <br>
                                    <h5>
                                        <?php
                                        print_r($last_id = $t8_programacion->link_prog());

                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="container">
                            <div class="row ">
                                <div class="col align-self-center">
                                    <button class="btn btn-block btn-info swalDefaultSuccess" name="btn_crear_prog" id="btn_crear_prog" type="submit"> CREAR PROGRAMACION </button>
                                </div>
                            </div>
                            <br><br>
                        </div>


                    </form>

                    <hr>

                    <div id="pageMessage"></div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>

<script type="text/javascript">
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function(e) {


        $("#crear_prog").on('submit', (function(e) {
            e.preventDefault();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            var form = new FormData(this);
            $.ajax({
                url: "crearprog_step1.php",
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.success('Programacion Creada Satisfactoriamente');
                    $("#pageMessage").html(data);
                },
                error: function(respuesta) {
                    console.log(JSON.stringify(respuesta));
                    alert(JSON.stringify(respuesta));

                }
            });
            /*
             $(function() {
             
             })
             */

        }))
    })
</script>



</body>

</html>