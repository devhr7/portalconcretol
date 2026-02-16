<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

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
                    <h1>Votaciones</h1>
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
                <h3 class="card-title">Crear Participantes de la <span><?php echo ($_GET['camp']); ?></span></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_crear" id="F_crear" method="POST">
                        <input type="hidden" name="txt_id_campana" id="txt_id_campana" value="<?php echo $_GET['id']; ?> ">
                        <hr>
                        <div class="callout callout-warning">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nombres Completos del participante</label>
                                        <input type="text" class="form-control" name="txt_nombreParticipante_principal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" class="form-control" name="foto_participante" id="foto_participante">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Cedula</label>
                                        <input type="text" class="form-control" name="cedulaParticipante_principal" id="cedulaParticipante_principal">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" name="cargoParticipante_principal" id="cargoParticipante_principal">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-info">Guardar y Agregar participartes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Participantes <span></span></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="t_participantes" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N </th>
                            
                            <th>Nombres completos</th>
                            <th>Cargo </th>
                            <th>Numero Votos</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfooter>
                        <tr>
                            <th>N </th>
                            
                            <th>Nombres completos</th>
                            <th>Cargo </th>
                            <th>Numero Votos</th>
                        </tr>
                    </tfooter>
                </table>
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

<script>
    $(document).ready(function() {

        var n = 1;
        var id_camp = <?php echo $_GET['id']; ?>;
        var table = $('#t_participantes').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table.php",
                "dataSrc": "",
                'data' : { 'id_camp' : id_camp },
                'type' : 'post'
            },
            "order": [
                
            ],
            "columns": [{
                    "data": "ct41_idparticipantes"
                },
                
                {
                    "data": "ct41_nombreparticipante"
                },
                {
                    "data": "ct41_cargo_participante"
                },
                {
                    "data": "ct41_votos"
                },


            ],
            //"scrollX": true,

        });


        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();



        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);



    });
</script>


<script src="ajax_crear.js">

</script>



</body>

</html>