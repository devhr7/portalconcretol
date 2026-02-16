<?php include '../../layout/validar_session2.php' ?>

<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aseguramiento de Calidad</h1>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Modulos</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php

                    switch ($rol_user) {
                        case 1:
                        case 9:
                        case 11:
                        case 10:
                        case 20:
                        case 22:
                        case 33:



                    ?>
                            <div class="col-4" id="">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Productos</H3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-truck-moving"></i>
                                    </div>
                                    <a class="small-box-footer" href="../Productos/">
                                        Ir <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                    <?php
                            break;
                    }
                    ?>

                    <?php

                    switch ($rol_user) {
                        case 1:
                        case 9:
                        case 11:
                        case 10:
                        case 20:
                        case 22:
                        case 33:    

                    ?>
                            <div class="col-4" id="">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>Muestras</H3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-truck-moving"></i>
                                    </div>
                                    <a class="small-box-footer" href="registro_muestras/">
                                        Ir <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                    <?php
                            break;
                    }
                    ?>
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



<?php include '../layout/footer/footer1.php' ?>
</body>

</html>