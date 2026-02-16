<?php include '../../../layout/validar_session_cliente3.php' ?>
<?php

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

require '../../../include/conexion.php';
require '../../../include/LibreriasHR.php';
require '../../../include/get_datos.php';
require '../../../include/lib.php';

//$lib = new lib();

$get_datos = new get_datos();
$php_clases = new php_clases();
$conexion_bd = new conexion();
$conexion_bd->connect();
$HR_librerias = new LibreriasHR();
$t26_remisiones = new t26_remisiones();
$t5_obra = new t5_obras();

?>
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

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>


</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="../../../assets/images/usuarios/images.png" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"> <?php echo $_SESSION['nombre_usuario']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="../../../assets/images/usuarios/images.png" class="img-circle elevation-2" alt="User Image">

                            <p>
                                <?php echo $_SESSION['nombre_usuario']; ?>
                                <!-- <small></small> -->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- 
                            <li class="user-body">
                              <div class="row">
                                <div class="col-4 text-center">
                                  <a href="#">Followers</a>
                                </div>
                                <div class="col-4 text-center">
                                  <a href="#">Sales</a>
                                </div>
                                <div class="col-4 text-center">
                                  <a href="#">Friends</a>
                                </div>
                              </div>
                            
                            -->
                        <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    <a href="../../cerrar.php" class="btn btn-default btn-flat float-right">Cerrar Sesion</a>
                </li>
            </ul>
            </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-orange elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../../../assets/images/logos/Logo-v8.jpg" alt="Concretol Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">REMIWEB CONCRETOL</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                        <!-- Atras
                            <li class="nav-item">
                              <a href="index.php" class="nav-link">
                                <i class="fas fa-hand-point-left"></i>
                                <p>
                                  Atras
                                </p>
                              </a>
                            </li>
                            -->

                        <li class="nav-header">Entregas de Productos</li>



                        <li class="nav-item has-treeview">
                            <a href="index.php" class="nav-link active">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Explorar
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> <strong> <?php echo $nombre_usuario; ?> </strong> Bienvenido a <strong style="color:#ac4661"> REMIWEB CONCRETOL </strong> </h1>

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
                        <h3 class="card-title">Entregas de Productos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                        </div>
                    </div>
                    <div class="card-body">

                                 
                       
                       


                        <div id="contenido">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Selecciones una Obra Para filtrar Resultados en la tabla</label>
                                        <select name="txt_id_obra" id="txt_id_obra" class="form-control" >
                                            <?php echo $t5_obra->option_obras($_SESSION['id_cliente1']); ?>
                                        </select>
                                    </div>
                                </div>                            
                            </div>
                            <form id="form_aceptar_remi" name="form_aceptar_remi">
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-block bg-gradient-info btn-flat" id="b_aceptar_remi" name="b_aceptar_remi">Aceptar Remisiones</button>
                                    </div>
                                </div>
                                <br>
                                <table id="t_remisiones" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>check</th>
                                            <th>Fecha</th>
                                            <th>Obra</th>
                                            <th>Remision</th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                   
                                </table>
                            </form>
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

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 0.3
            </div>
            <strong>Copyright 2019-2020 <a href="#">HR</a>.</strong> Todos los derehos Reservados
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="../../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>

    <script src="../../../plugins/datatables/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



    <script>
        $(document).ready(function() {
            var id_cliente = '<?php echo $_SESSION['id_cliente1']; ?>';
            var id_obra = '<?php echo $_SESSION['id_obra']; ?>';

            table_remisiones = datatable_remisiones(id_cliente, id_obra,null);

            $('#txt_id_obra').on('change', function() {
                console.log("se selecciono una nueva Obra");
                var id_cliente = '<?php echo $_SESSION['id_cliente1']; ?>';
                var id_obra =  $('#txt_id_obra').val();
                if ($.fn.dataTable.isDataTable('#t_remisiones')) {
                    table_remisiones = $('#t_remisiones').DataTable();
                    table_remisiones.destroy();
                }
                table_remisiones = datatable_remisiones(id_cliente, id_obra,1);
            });


       // tabla de cliente y obras
       function datatable_remisiones(id_cliente, id_obra, opcion) {
            var table_remisiones = $('#t_remisiones').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_remisiones.php",
                    'data': {
                        'id_cliente': id_cliente,
                        'id_obra': id_obra,
                        'opcion': opcion
                    },
                    'type': 'post',
                    "dataSrc": "",
                },
                "columns": [
                    {
                        "data": "id"
                    },
                    {
                        "data": "check",
                    },
                    {
                        "data": 'fecha_remi',
                    },
                    {
                        "data": "nombre_obra"
                    },
                    {
                        "data": "codigo_remi"
                    },
                    {
                        "data": "estado"
                    },
                    {
                        "data":"botones"
                    }
                  


                ],


                //"scrollX": true,
            });

            table_remisiones.on('order.dt search.dt', function() {
                table_remisiones.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table_remisiones.ajax.reload();
            return table_remisiones;
        } //  fin de la funcion




            $("#form_aceptar_remi").on('submit', (function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '',
                    text: "",
                    icon: 'info',
                    html: "Desea firmar las remisiones seleccionadas ?",

                    confirmButtonText: 'Aceptar',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    //CancelButtonText: 'salir'
                    //confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "ajax_detalle_Remi.php",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {

                                if (data.estado) {
                                    //toastr.success('La remision fue guardada correctamente');
                                    alert('La remision fue guardada correctamente');
                                    console.log(data.result);
                                    location.reload();
                                } else {
                                    alert(data.result);
                                }
                            },
                            error: function(respuesta) {
                                alert(JSON.stringify(respuesta));
                            },
                        });

                    }
                })

            }));


            /*
            $('#formulario input[type=checkbox]').each(function() {
                if (this.checked) {
                    selected[] = $(this).val() ;

                }
            });
            */




        });
    </script>
</body>

</html>