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
    <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../plugins/datatables/datatables.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <link href="../../../custom/remi.css" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css" rel="stylesheet" />
    <!-- Calendario -->
    <link href='../../../plugins/fullcalendar/main.css' rel='stylesheet' />

    <link href="../../../plugins/fullcalendar/main.min.css" rel='stylesheet' />
    <link href="../../../plugins/fullcalendar-timegrid/main.min.css" rel='stylesheet' />
    <link href="../../../plugins/fullcalendar-daygrid/main.min.css" rel='stylesheet' />

    <script type="text/javascript" src="../../../plugins/fullcalendar/main.js"></script>
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
                    <a href="../../../menu/dashboard.php" class="nav-link">Inico</a>
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
                        <img src="../../../assets/images/usuarios/images.png" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"><?php echo $nombre_usuario; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="../../../assets/images/usuarios/images.png" class="img-circle elevation-2" alt="User Image">
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
                            <!-- <a href="#" class="btn btn-default btn-flat">Perfil</a>-->
                            <a href="../../../cerrar.php" class="btn btn-default btn-flat float-right">Cerrar Sesion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
    </div>
</body>