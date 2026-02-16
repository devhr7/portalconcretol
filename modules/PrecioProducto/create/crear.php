<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
$t4_productos = new t4_productos();
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Asignar Precios</h1>
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
                <h3 class="card-title">Crear</h3>

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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Seleccione Cliente </label>
                                    <select class="form-control select2 " style="width: 100%;" id="Txb_IdTercero" name="Txb_IdTercero"  required tabindex="-1" aria-hidden="true"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Seleccione la Obra </label>
                                    <select class="form-control select2 " style="width: 100%;" id="Txb_IdObras" name="Txb_IdObras" required tabindex="-1" aria-hidden="true"></select>
                                </div>
                            </div>

                        </div>
                        <br>
                        <hr>
                    
                         

                        <hr>

                        <div class="row">
                            <div class="col-2">
                                <label>filas</label>
                                <input type="number" class="form-control" name="nfilas" id="nfilas" min=1 required>
                            </div>
                        </div>

                        <div id="listPrecios">
                        </div>
                        <br>
                        <hr>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

<?php include '../../../layout/footer/footer3.php' ?>




<script type="text/javascript">
			
			function format(input){
				var num = input.value.replace(/\./g,'');
				if(!isNaN(num)){
					num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
					num = num.split('').reverse().join('').replace(/^[\.]/,'');
					input.value = num;
					document.getElementById("h2valor").innerHTML  = "$ "+num;
				}

				else{ 

					input.value = input.value.replace(/[^\d\.]*/g,'');
				}
			}			
	
		</script>

<script>
    $(function() {



        $('.select2').select2();
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });


        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<script>
    $(function() {

        $(document).ready(function(e) {


            $.ajax({
                url: "getdatos.php",
                type: "POST",
                data: {

                    tipo: "Get_Cliente",
                    task: "1",
                },
                success: function(response) {

                    if (response.estado) {
                        $('#Txb_IdTercero').html(response.cliente);
                        //$('#cupocliente').html(response.cupclient);
                    } else {
                        //alert("Error al cargar terceros.");
                        //console.log(response.msg);
                    }
                },
                error: function(respuesta) {

                    //alert(JSON.stringify(respuesta));

                }
            });
            /**********************************************************************************************************************************/
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // LISTA PRODUCTOS
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


            /**********************************************************************************************************************************/

        });
    });


    /* -------------------------------- OBRA EXTRA ------------------------------------------ */


    /**********************************************************************************************************************************/
    // TRAER SELECT OBRA - CHEKE
    /**********************************************************************************************************************************/
    $('#Txb_IdTercero').on('change', function() {
        $.ajax({
            url: "getdatos.php",
            type: "POST",
            data: {
                id_cliente: ($('#Txb_IdTercero').val()),
                tipo: "Get_Obra",
                task: "3",
            },
            success: function(response) {

                if (response.estado) {
                    $('#Txb_IdObras').html(response.Obra);
                    //$('#CupoObra').html(response.cupclient);
                } else {
                    //alert("Error al cargar terceros.");
                    console.log(response.msg);
                }
            },
            error: function(respuesta) {

                alert(JSON.stringify(respuesta));

            }
        });

    });
    /**********************************************************************************************************************************/
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /**********************************************************************************************************************************/
</script>


<script type="text/javascript">
    $("#nfilas").change(function() {
        $.ajax({
            url: "nfilas.php",
            type: "POST",
            data: {
                nfilas: ($('#nfilas').val()),
            },
            success: function(response) {

                if (response.estado) {
                    $('#listPrecios').html(response.contenido);
                      $('.select2').select2();
                    //$('#CupoObra').html(response.cupclient);
                } else {
                    //alert("Error al cargar terceros.");
                    //console.log(response.msg);
                }
            },
            error: function(respuesta) {

                alert(JSON.stringify(respuesta));

            }
        });
    });
</script>

<script>
    $("#F_crear").on('submit', (function(e) {
        e.preventDefault();

        $.ajax({
            url: "php_crear.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.estado) {
                    toastr.success('Guardado Correctamente');
                    console.log(data.msg);
                } else {
                    alert(data.result);
                }
                // toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
                // toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
                // toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
                // toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
                location.reload();
            }
        });
    }));
</script>



</head>


</body>

</html>