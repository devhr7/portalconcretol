<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CONCRE TOLIMA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icono del titulo del documento-->
    <link href="../../../assets/images/logos/LogoConcretol.png" rel="icon" type="image">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <!--- sweetalert2.css---->
    <link href="../../../plugins/sweetalert2/dist/sweetalert2.css" rel="stylesheet" />
    <!-- Toastr -->
    <link href="../../../plugins/toastr/toastr.css" rel="stylesheet" />
    <link href="../../../plugins/select2/css/select2.css" rel="stylesheet" />

    <link href="../../../plugins/datatables/datatables.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../plugins/ekko-lightbox/ekko-lightbox.css" />
    <link rel="stylesheet" type="text/css" href="../../../plugins/DataTables/datatables.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <link href="../../../custom/remi.css" rel="stylesheet" />

</head>

<body class="sidebar-collapse layout-top-nav" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->

        <!-- /.navbar -->



        <?php require '../../../librerias/autoload.php';
        require '../../../modelos/autoload.php';
        require '../../../vendor/autoload.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Elecciones CONCRE TOLIMA SA</h1>
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
                        <h3 class="card-title"> </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="contenido">
                            <form name="F_crear" id="F_crear" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Numero Cedula</label>
                                            <input type="text" name="txt_cedula" id="txt_cedula" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nombres Completos</label>
                                            <input type="text" class="form-control"  name="txt_nombres" id="txt_nombres"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> Cargo </label>
                                            <input type="text" class="form-control"  name="txt_cargo" id="txt_cargo" required >
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block bg-gradient-info">Ir</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>



            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '../../../layout/footer/footer3.php' ?>

<script>



$(document).ready(function (e) {
        $("#F_crear").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_votante.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    if(data.estado){
                        location.href = "elecciones_concre.php?id_votante="+data.ultimo;
                        
                    }else{
                        toastr.warning(data.errores);               
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
</script>


</body>

</html>