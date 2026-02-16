<?php
session_start();
if ($_SESSION['tipo'] == 3 || $_SESSION['tipo'] == 4) {
    if ($_SESSION['rol'] == 101 || $_SESSION['rol'] == 102) {
        $k = true;
    } else {
        $k = false;
    }
} else {
    $k = false;
}

if ($k) {
    require '../../../includes/LibreriasHR.php';
    $HR_librerias = new HR_librerias();

    require '../../../includes/conexion.php';


    $conexion_bd = new conexion();
    $conexion_bd->connect();

    $id_cliente1 = $_SESSION['id_cliente1'];
} else {
    @session_unset();
    echo"<script> window.location = '../../../../index.php';</script>";
    //echo"<script>alert('mal');</script>"; 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CONCRETOL</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../../assets/images/logos/LogoConcretol.png" rel="icon" type="image">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css">

        <link rel="stylesheet" href="../../../node_modules/select2/select2.css">

        <link rel="stylesheet" href="../../../node_modules/sweetalert2/dist/sweetalert2.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="../../../node_modules/datatables.net-dt/css/jquery.dataTables.css">
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
                            <img src="../../../dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline"><?php echo $_SESSION['nombre_usuario']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

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
                        <a href="../profile/passnew.php" class="btn btn-default btn-flat">Perfil</a>
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

                            <li class="nav-item">
                                <a href="../../index.php" class="nav-link">
                                    <i class="fas fa-hand-point-left"></i>
                                    <p>
                                        Atras
                                    </p>
                                </a>
                            </li>


                            <li class="nav-header">Menu</li>
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Usuarios
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview menu-open">
                                    <li class="nav-item active">
                                        <a href="index.php" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>explorar</p>
                                        </a>
                                    </li>
                                </ul>
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
                                <h1>Usuarios</h1>
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
                            <h3 class="card-title">Explorar</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <a href="create/crear_usuario.php"><button > Crear Usuario</button></a>
                            </div>
                            <div id="contenido">
                                <table id="t_usuarios2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $datosTabla = $HR_librerias->get_ct1_usuariosclientes2($conexion_bd, $id_cliente1);
                                        if ($datosTabla):
                                            while ($fila = $datosTabla->fetch_assoc()) {
                                                $id = $fila['ct1_IdTerceros'];
                                                ?>
                                                <tr>
                                                    <td> <?php echo $fila['ct1_Nombre1'] ?></td>
                                                    <td> <?php echo $fila['ct1_Apellido1'] ?></td>
                                                    <td> <?php echo $fila['ct1_usuario'] ?></td>
                                                    <td> <?php echo $fila['ct1_Estado'] ?></td>
                                                    <td> <a href="u/editar_usuario.php?id='<?php echo $HR_librerias->HR_Crypt($id, 1); ?>"> <button>Editar</button> </a></td>
                                                </tr>
                                                <?php
                                            }
                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="5">No hay datos </td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?> 


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
        <script src="../../../vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../../vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../../vendor/almasaeed2010/adminlte/dist/js/demo.js"></script>
        <script src="../../../node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
        <script src="../../../node_modules/sweetalert2/dist/sweetalert2.js"></script>
        <script src="../../../node_modules/select2/select2.js"></script>
        <script src="../../../node_modules/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
        <script src="../../../node_modules/datatables.net/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function () {
                $('#t_usuarios2').DataTable({

                });
            });
        </script>
    </body>
</html>


