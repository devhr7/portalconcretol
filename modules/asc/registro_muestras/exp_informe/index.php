<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>
<?php

$t1_terceros = new t1_terceros();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exportar BASE DE DATOS REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h1>
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
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form id="form-informe" name="form-informe" method="POST" action="excel.php">
                    <div id="contenido">

                        <div class="row">
                            <div class="col">
                                <h5>Seleccionar Rango Fecha</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Selecciona Sede</label>
                                <select name="sede" id="sede" class="form-control">
                                    <option value="IBG">Ibague</option>
                                    <option value="HND">Honda</option>
                                    <option value="RMI">Mirolindo</option>
                                    <option value="RMT">Torreon</option>
                                    <option value="NO">Sin Remision</option>

                                </select>
                            </div>
                            <div class="col">
                                <label for="">Selecciona Cliente</label>
                                 <select id="txt_cliente" name="txt_cliente" class="form-control select2" >
                                        <?php print_r($t1_terceros->option_cliente_edit($id_cliente)); ?>
                                    </select>
                            </div>
                            <div class="col">
                                <label>Fecha inicio: </label>
                                <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" required>
                            </div>

                            <div class="col">
                                <label>Fecha fin: </label>
                                <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required>
                            </div>

                        </div>

                        <HR>

                        <div class="row">
                            <div class="col-2">
                                <button class="btn btn-block bg-gradient-success"> <i class="fas fa-file-excel"></i> Exportar </button>
                            </div>
                        </div>
                    </div>
                </form>

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

<?php include '../../../../layout/footer/footer4.php' ?>


<script>
 $(document).ready(function() {
        $('.select2').select2();

    });
    </script>

</body>

</html>