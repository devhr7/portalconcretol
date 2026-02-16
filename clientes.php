<!DOCTYPE html>
<html>

<head>
    <!--- Compatible con los Navegadores-->
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1,user-scalable=no" name="viewport">
    <!------->
    <!-- Titulo del Documento-->
    <title>
        CONCRE TOLIMA SA
    </title>
    <!-- Icono del titulo del documento-->
    <link href="assets/images/Logos/LogoConcretol.png" rel="icon" type="image" />
    <!------------>
    <!-- Iconos-->
    <!--Font Awesome-->
    <link href="plugins/fontawesome-free/css/all.css" rel="stylesheet" />
    <!-- Ionicons-->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" />
    <!--Tema-->
    <link href="dist/css/adminlte.css" rel="stylesheet" />
    <!--- sweetalert2.css---->
    <link href="plugins/sweetalert2/dist/sweetalert2.css" rel="stylesheet" />
    <!-- Toastr -->
    <link href="plugins/toastr/toastr.css" rel="stylesheet" />
    <!----Fuentes de letra---->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>

    <style>
    .fondo-index {
        background: url("assets/images/fondos/fond1.gif");
        background-size: 100% 100%;
        background-repeat: no-repeat;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    </style>




</head>

<body class="hold-transition login-page fondo-index">
    <!--Body-->
    <div class="login-box">
        <!----Logo------>
        <section id="banner">
            <div class="login-logo">
                <div class="">
                    <a href="#">
                        <img width="50%"
                            style="border-radius:5%; -webkit-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);-moz-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75); box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);"
                            src="assets/images/logos/logo.concretol-v7.png">
                    </a>
                </div>
            </div>
        </section>
        <!-- /.login-logo -->


        <section id="main">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">INICIAR SESION COMO CLIENTE</p>
                    <div id="pageMessage">Ingrese su nit o cedula y contraseña</div>
                    <br>
                    <!---    --->
                    <form id="Login" name="Login" method="POST">
                        <!---  Animacion Cargando -->
                        <div id="pageAnimation" align="center">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </div>
                        <!--- /.Animacion cargando -->

                        <div class="input-group mb-3">

                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="contrasenia" name="contrasenia"
                                placeholder="Contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="social-auth-links text-center mb-3">
                            <button class="btn btn-block btn-secondary" type="submit">Ingresar</button>

                        </div>
                    </form>



                    <p class="mb-0">
                        <i class="fas fa-arrow-left"></i><a href="index.php" class="text-center"> Atras</a>
                        <!--- enlace ---->
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </section>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="build/js/AdminLTE.js"></script>
    <script src="plugins/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="plugins/sweetalert2/dist/sweetalert2.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="ajax_clientes.js"></script>

    <script>
    $('#pageAnimation').hide();
    </script>

</body>


</html>