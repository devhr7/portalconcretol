<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>


<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



// $get_datos = new get_datos();

$t10_vehiculo = new t10_vehiculo();
$t1_terceros = new t1_terceros();
$t5_obras = new t5_obras();
$php_clases = new php_clases();
     ?>  
       

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Factura e</h1>
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


            
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Crear Factura</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box" id="pageContent">
                    <form id="buscadorfacturas1" name ="buscadorfacturas1" action="" method="post">
                        <div class="row gtr-uniform gtr-50">
                            <div class="col-12">
                                <h3> <i class="fa fa-hashtag" aria-hidden="true"></i> Paso 1</h3>
                                <p>Seleccinar cliente y despues la obra.</p>
                           
                                <hr>
                            </div>
                            <div class="col-6 col-12-mobilep">
                                <select class="js-example-basic-single select2 form-control" id="C_IdTerceros" name="C_IdTerceros" required>
                               <?php echo $t1_terceros->option_cliente(); ?>
                                
                                </select>
                            </div>
                            <div class="col-6 col-12-mobilep" >                         
                                <select id="C_Obras" name="C_Obras" class="js-example-basic-single select2 form-control" required></select>
                             
                            </div>

                            
                        </div>
                        <br>
                        
                        <div class="row">
                        <div class='col'>
                       

                                <button type="submit" name="Buscar" value="Continuar" id="Consulta" class="btn btn-block btn-success"> Continuar</button>
                                
                           
                        </div>
                        </div>
                    </form>

                    <br>
                    <br>
                    <hr>
                    <br>

                    <div class="row">
                    <div class="col">
                        <div id="contenedor_boton"></div>
                    </div>
                    </div>                    
                </div>  
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer-->
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include '../../../layout/footer/footer3.php' ?>

        <script>
            $(document).ready( function () {
    $('#example').DataTable();
} );
        </script>


<script>
    $(document).ready(function () {
    
        $('#C_IdTerceros').on('change', function () {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data:
                        {
                            idCliente: ($('#C_IdTerceros').val()),
                            task: "1",
                        },
                success: function (response)
                {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    })



</script>
<script src="ajax_crear.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2();

    });

    </script>
</body>

</html>