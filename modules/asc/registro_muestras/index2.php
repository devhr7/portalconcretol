<?php include '../../../layout/validar_session3.php' ?>

<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_laboratorio = new cls_laboratorio();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modulos de Laboratorio</h1>
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

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Sede</label>
                            <select name="txt_sede" id="txt_sede" class="form-control">
                                <?php echo $cls_laboratorio->option_sede() ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="button" id="btn_sede">Seleccionar Sede</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col">
                        <table id="tabla_registro_muestras">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Muestra</th>
                                    <th>Consecutivo Interno</th>
                                    <th>Remision</th>
                                    <th>Periodo</th>
                                    <th>Promedio KG/CM2</th>
                                    <th>%</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
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

        <!-- Default box -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">REGISTRO DE MUESTRAS CON STATUS</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col">
                        <table id="tabla_reg_muestras_preview">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod Muestra</th>
                                    <th>Consecutivo Interno</th>
                                    <th>Estatus</th>
                                    <th>Remision</th>
                                    <th>Fecha Programada</th>
                                    <th>Periodo</th>
                                    <th>Muestras Programadas</th>
                                    <th>Muestras Ejecutadas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Cod Muestra</th>
                                    <th>Consecutivo Interno</th>
                                    <th>Estatus</th>
                                    <th>Remision</th>
                                    <th>Fecha Programada</th>
                                    <th>Periodo</th>
                                    <th>Muestras Programadas</th>
                                    <th>Muestras Ejecutadas</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
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


<!-- MODALES -->

<!------->
<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function(e) {
        $("#form_crear_requisicion").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_requi.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');

                        window.location = "update/editar.php?id=" + data.id_requi;

                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
    $(document).ready(function() {
        var n = 1;
        var sede = $("#txt_sede").val();

        // funcion tabla registro de muestras
        function datatable_muestras(sede) {
            var table = $('#tabla_registro_muestras').DataTable({
                "paging": "false",
                "searching": "false",
                "processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_reg_muestras.php",
                    'data': {
                        "sede": sede,

                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "fecha_muestra" // Fecha
                    },
                    {
                        "data": "id" // Muestra
                    },
                    {
                        "data": "consecutivo_interno"
                    },
                    {
                        "data": "cod_remi" // Remision
                    },
                    {
                        "data": "periodo" // Remision
                    },
                    {
                        "data": "promediokgcm2" // Remision
                    },
                    {
                        "data": "porcentaje" // Remision
                    },

                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> </button>"
                    }


                ],
                'paging': true,
                'searching': true
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
            table.ajax.reload();
            return table;
        }

        //
        if ($.fn.dataTable.isDataTable('#tabla_registro_muestras')) {
            table = $('#tabla_registro_muestras').datatable_muestras(sede);
            table.destroy();
        }
        var sede = $("#txt_sede").val();
        table = datatable_muestras(sede);

        setInterval(function() {
            table.ajax.reload(null, false);
        }, 15000);


        $('#tabla_registro_muestras tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];

            window.location = "update/index.php?id=" + id;
        });





        var n = 1;
        // Declarar funcion destruir tabla
        function destruir_tabla() {
            var table_preview = $('#tabla_reg_muestras_preview').DataTable({});
            table_preview.destroy();
        }

        function datatable_preview(sede) {
            var myCallback = function() {
                this.api().columns(1).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            //table_preview.ajax.reload();
                        }
                    });
                });
                this.api().columns(2).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            //table_preview.ajax.reload();
                        }
                    });
                });
                this.api().columns(3).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            //table_preview.ajax.reload();
                        }
                    });
                });
                this.api().columns(4).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            //table_preview.ajax.reload();
                        }
                    });
                });
                this.api().columns(5).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.setAttribute("type", "date");
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('change', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            //table_preview.ajax.reload();
                        }
                    });
                });
                this.api().columns(6).every(function() {
                    let column = this;
                    //console.log(column['column']);
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement('input');
                    input.placeholder = title;
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener('keyup', () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                            table_preview.ajax.reload();
                        }
                    });
                });
            };
            var myrowCallback = function(row, data) {
                var f = new Date();
                fecha = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();
                var f2 = new Date(data['fecha_programada']);
                fecha2 = f2.getFullYear() + "-" + (f2.getMonth() + 1) + "-" + (f2.getDate() + 1);
                if (fecha2 == fecha) {
                    $($(row).find("td")).css("background-color", "#fef8a5");
                }
            };
            var sede = $("#txt_sede").val();

            var table_preview = $('#tabla_reg_muestras_preview').DataTable({
                "paging": "false",

                "processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_muestras_programadas.php",
                    'data': {
                        //'sede': $("#txt_sede").val()
                        'sede': sede
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "id_muestra"
                    },
                    {
                        "data": "consecutivo_interno"
                    },

                    {
                        "data": "estatus" // Fecha
                    },
                    {
                        "data": "remision" // Fecha
                    },
                    {
                        "data": "fecha_programada" // Muestra
                    },
                    {
                        "data": "nombre_periodo" // Remision
                    },
                    {
                        "data": "muestras_programadas" // Remision
                    },
                    {
                        "data": "muestras_ejecutadas" // Remision
                    },

                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> </button>"
                    }


                ],

                "initComplete": myCallback,
                "rowCallback": myrowCallback,
                //"scrollX": true,
            });
            return table_preview;
        }
        //



        if ($.fn.dataTable.isDataTable('#tabla_reg_muestras_preview')) {
            table_preview = $('#tabla_reg_muestras_preview').datatable_preview();
            table_preview.destroy();
        }
        table_preview = datatable_preview();
        setInterval(function() {
            table_preview.ajax.reload();
        }, 3000);

        $('#tabla_reg_muestras_preview tbody').on('click', 'button', function() {
            var data = table_preview.row($(this).parents('tr')).data();
            var id_muestra = data['id_muestra'];

            window.location = "update/index.php?id=" + id_muestra;
        });


        $("#btn_sede").click(function() {
            var sede = $("#txt_sede").val();
            table.destroy();
            table = datatable_muestras(sede);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 15000);

            ///////////////////////////
            table_preview.destroy();

            table_preview = datatable_preview(sede);
            setInterval(function() {
                table_preview.ajax.reload();
            }, 15000);

        });



    });
</script>



</body>

</html>