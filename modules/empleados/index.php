<?php include '../../layout/validar_session2.php' ?>
<?php include '../../include/LibreriasHR.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>
<?php

$php_clases = new php_clases();


switch ($rol_user) {
    case 1:
    case 5:
    case 16:
        $t1_terceros = new t1_terceros();
        $LibreriasHR = new LibreriasHR();

        break;
    default:
        print('<script> window.location = "../index.php"</script>');
        break;
}

    

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
        <link href="../../assets/images/logos/LogoConcretol.png" rel="icon" type="image">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../dist/css/adminlte.min.css" />
        <link rel="stylesheet" href="../../plugins/select2/css/select2.css" />
        <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.css" />
        <link rel="stylesheet" href="../../plugins/datatables/datatables.css" />
        <link rel="stylesheet" href="../../plugins/toastr/toastr.css" />


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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="dashboard.php" class="nav-link">Inico</a>
                    </li>

                </ul>



                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">0 Notficaciones</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 0 Notificaciones
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <a href="#" class="dropdown-item dropdown-footer">Ver Todas las Notificaciones</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="../../assets/images/usuarios/images.png" class="user-image img-circle elevation-2"
                                 alt="User Image">
                            <span class="d-none d-md-inline"><?php echo $nombre_usuario; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="../../assets/images/usuarios/images.png" class="img-circle elevation-2"
                                     alt="User Image">

                                <p>
<?php echo $nombre_usuario; ?>

                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <a href="#">Cambiar Contraseña</a>
                                    </div>

                                </div>
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
<?php include 'sidebar.php' ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Bienvenido</h1>
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
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <a href="create/crear.php" class="btn btn-block btn-info"> Crear </a>
                                    </div>
                                </div>
                            </div><br>
                            <div id="contenido">
                                <table id="t_empleados" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>N Identificacion</th>
                                            <th>Nombres y apellidos</th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$datos_funcionario = $t1_terceros->select_funcionario_all();

while ($fila_func = $datos_funcionario->fetch(PDO::FETCH_ASSOC)) {
    
    $id  = $fila_func['ct1_IdTerceros'];
    $numero_identificacion = $fila_func['ct1_NumeroIdentificacion'];
    $razon_social  = $fila_func['ct1_RazonSocial'];
    $Estado  = $fila_func['ct1_Estado'];

    if ($Estado == 1) {
        $s_clase = " badge-success ";
        $status = "Aprovado";
    }
    if ($Estado == 0) {
        $s_clase = " badge-info ";
        $status = "";
    }
    if ($Estado == 3) {
        $s_clase = " badge-warning ";
        $status = "Pendiente ";
    }
    if ($Estado == 2) {
        $s_clase = " badge-danger";
        $status = "Desabilitado";
    }

    
    ?>
                                        <tr>
                                            <td><?php echo $numero_identificacion ?></td>
                                            <td><?php echo $razon_social ?></td>
                                            
                                            <td><span class='badge <?php echo $s_clase; ?> float-right'> <?php echo $status ?> </span> </td>
                                            <td class="project-actions">
                                            <a class="btn btn-info btn-sm" href=''><i class="far fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm" href="update/editar.php?id='<?php echo $LibreriasHR->HR_Crypt($id, 1);?>"><i class="fas fa-edit"></i></a>
                                            </td>
                                         

                                        </tr>

<?php } ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>N Identificacion</th>
                                                <th>Nombres y apellidos</th>
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

    <?php include '../../layout/footer/footer2.php' ?>

            <script>
                $(document).ready(function () {
                $('#t_empleados').DataTable({});
                });
            </script>

    </body>
</html>
