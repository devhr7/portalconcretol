<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CONCRE TOLIMA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!------->
    <!-- Titulo del Documento-->
    <title>
        CONCRE TOLIMA SA
    </title>
    <!-- Icono del titulo del documento-->
    <link href="../assets/images/logos/LogoConcretol.png" rel="icon" type="image">

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
            background: url("assets/images/fondos/fondo.jpg");
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
                        <img src="assets/images/logos/logo.concretol-v7.png" style="border-radius:5%; -webkit-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);-moz-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75); box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);" width="50%">
                        </img>
                    </a>
                </div>
            </div>
        </section>
        <!-- /.login-logo -->
        <section id="main">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">
                        INICIAR SESION COMO FUNCIONARIOS
                    </p>
                    <div id="pageMessage">
                        Ingrese su nit o cedula y contraseña
                    </div>
                    <br>
                    <!---    --->
                    <form id="Login" method="POST" name="Login">
                        <!---  Animacion Cargando -->
                        <div align="center" id="pageAnimation">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px">
                            </i>
                        </div>
                        <!--- /.Animacion cargando -->
                        <div class="input-group mb-3">
                            <input class="form-control" id="usuario" name="usuario" placeholder="Usuario" type="text">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user">
                                    </span>
                                </div>
                            </div>
                            </input>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" id="contrasenia" name="contrasenia" placeholder="Contraseña" type="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock">
                                    </span>
                                </div>
                            </div>
                            </input>
                        </div>
                        
                        <div class="social-auth-links text-center mb-3">
                            <button class="btn btn-block btn-secondary" type="submit" id="ingresar">
                                Ingresar
                            </button>
                        </div>
                        <hr>
                        
                        <div class="social-auth-links text-center mb-3">
                            <!-- <a href="restabler_pass.php"> ¿Has olvidado tu contraseña ?</a> -->
                        </div>
                        
                    </form>
                    <p class="mb-0">
                        <i class="fas fa-arrow-left">
                        </i>
                        <a class="text-center" href="index.php">
                            Atras
                        </a>
                        <!--- enlace ---->
                    </p>


                </div>
                <!-- /.login-card-body -->
            </div>
        </section>
    </div>
    <!-- /.login-box -->
    <!---/body -->
    <!-- Scripts-->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="build/js/AdminLTE.js"></script>
    <script src="plugins/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="plugins/sweetalert2/dist/sweetalert2.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="ajax_funcionarios.js">

    </script>

    <!-- /animaciones-->
    <script>
        $('#pageAnimation').hide();
    </script>
</body>

</html>