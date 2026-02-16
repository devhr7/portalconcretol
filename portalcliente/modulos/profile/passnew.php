<?php
session_start();



$tipoTercero = 3;
$id_Usuario = $_SESSION['id_usuario'];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                            <span class="d-none d-md-inline">Usuario</span>
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
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-light-orange elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <img src="../../../assets/images/logos/Logo-v8.jpg"
                         alt="Concretol Logo"
                         class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">CONCRETOL</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->

                            <li class="nav-item Active">
                                <a href="#" class="nav-link active">

                                    <p>
                                        Cambio de Contraseña
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
                                <h1></h1>
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
                            <h3 class="card-title">Cambiar Contraseña</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="contenido">
                                <form id="F_cambiarPass" name="F_cambiarPass" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col">
                                                <label> Nueva Contraseña</label>
                                                <input name="C_Newpass1" id="C_Newpass1" type="text" class="form-control">        
                                            </div>
                                            <div class="col-4"></div>


                                        </div>

                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col">
                                                <label> Confirmacion de Contraseña</label>
                                                <input name="C_Newpass2" id="C_Newpass2" type="text" class="form-control">        
                                            </div>
                                            <div class="col-4"></div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <p>
                                                    <input type="checkbox"  name="validar" id="validar" value="" class="form-control" style="width: 15px" required="required">
                                                    Acepta el TRATAMIENTO DE DATOS PERSONALES. Cada una de LAS PARTES manifiesta expresamente su autorizacion para que LA OTRA PARTE efectue el tratamiento de sus datos personales de conformidad con lo establecido en la Ley 1581 de 2012 y el Decreto Reglamentario 1377 del 2013 y el capitulo 25 del Decreto Reglamentario 1074
                                                </p>
                                            </div>
                                        </div>
                                        <div id="msg"></div>
                                        <div class="row">
                                            <div class="col-7"></div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                            </div>
                                            <div class="col-1"></div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->

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

        <!-- jQuery -->
        <script src="../../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../../dist/js/demo.js"></script>
        <script src="../../../dist/sweetalert2.all.js"></script>
        <script src="../../../dist/sweetalert2.js"></script>
        <script src="../../../select2.js"></script>
        <script src="../../../plugins/datatables/datatables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>

            $(document).ready(function (e) {
                $("#C_Newpass2").change(function () {

                    var pass1 = $("#C_Newpass1").val();
                    var pass2 = $("#C_Newpass2").val();
                    if (pass1 != pass2) {

                        $("#C_Newpass1").addClass(" is-invalid ");
                        $("#C_Newpass2").addClass(" is-invalid ");
                        $("#msg").html("Las contraseñas no coinciden");
                    } else {
                        $("#C_Newpass1").addClass(" is-valid ");
                        $("#C_Newpass2").addClass(" is-valid ");
                        $("#msg").html("Las contraseñas  coinciden");
                    }
                });

                $("#F_cambiarPass").on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "php_changepass.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data)
                        {
                            console.log(data.estado);
                            switch (data.estado) {
                                case 1:
                                    Swal.fire({
                                        title: '',
                                        text: "",
                                        icon: 'success',
                                        html: "La contraseña fue guardada correctamente <br> \n\
                                        Por favor dar clic en el boton aceptar y <br> \n\
                                        Vuelva iniciar sesion con su nueva contaseña",

                                        confirmButtonText: 'Aceptar'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "../../../index.php";

                                        }
                                    })





                                    break;
                                case 2:
                                    alert("Faltan campos requeridos");
                                    break;
                                case 3:
                                    alert("Error en la consulta");
                                    break;
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



