<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>INVENTARIOS EPP</h1>
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
        <?php
        $elementos = new elementos();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">INVENTARIOS EPP</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                     
                    </div>
                </div>
                <table id="table_inventario_epp" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>EPP</th>
                            <th>Inventario Inicial</th>
                            <th>Entradas</th>
                            <th>Salidas</th>
                            <th>Ajuste</th>
                            <th>Saldo</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
       
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../../layout/footer/footer2.php' ?>
<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function() {
        $("#form_crear_salida_epp").on('submit', (function(e) {
            $('#crear_salida_epp').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        var n = 1;
        var table = $('#table_inventario_epp').DataTable({
            "ajax": {
                "url": "data_table_Inventarios.php",
                "dataSrc": ""
            },
            "paging": false,
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "nombre_elemento_epp"
                },
                {
                    "data": "inventario_inicial" // TIPO MOVIMIENTO
                },
                {
                    "data": "entradas"
                },
                {
                    "data": "salidas"
                },
                {
                    "data": "ajustes"
                },
                {
                    "data": "saldo"
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
        $('#table_salidas_epp tbody').on('click', 'button.btn_editar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            $("#editar_movimiento_epp").modal("show");
        });
        $('#table_salidas_epp tbody').on('click', 'button.btn_eliminar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            $("#eliminar_movimiento_epp").modal("show");
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });
</script>
</body>

</html>