<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>


<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
require '../../../include/LibreriasHR.php';

$LibreriasHR = new LibreriasHR();
$t5_obras = new t5_obras();
$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t26_remisiones = new t26_remisiones();
$t27_factura = new t27_factura();



$id_cliente  = $LibreriasHR->HR_Crypt($_GET['cliente'], 2);
$id_obra   = $LibreriasHR->HR_Crypt($_GET['obra'], 2);

$datos_terceros = $t1_terceros->search_tercero_custom_id($id_cliente);
while ($fila_terceros = $datos_terceros->fetch(PDO::FETCH_ASSOC)) {
    $nit = $fila_terceros['ct1_NumeroIdentificacion'];
    $razon_social = $fila_terceros['ct1_RazonSocial'];
}
$datos_obras = $t5_obras->select_obras_id($id_obra);
while ($fila_obra = $datos_obras->fetch(PDO::FETCH_ASSOC)) {
    $NombreObra = $fila_obra['ct5_NombreObra'];
}





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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>

                </div>
            </div>
            <div class="card-body">
                <form name="crear_factura" id="crear_factura" method="POST">


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h5>cliente</h5>
                                <br>
                                <h4> <?php echo $razon_social ?> </h4>
                                <input type="hidden" name="cliente" value="<?php echo $id_cliente; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <h5>Obra</h5>
                                <br>
                                <h4><?php echo $NombreObra ?></h4>
                                <input type="hidden" name="obra" value="<?php echo $id_obra; ?>">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Titulo de la Factura</label>
                                <br>
                                <input type="text" class="form-control" name="titulo" id="titulo">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>valor de la factura</label>
                                <br>
                                <input type="text" class="form-control" name="valor" id="valor" onkeyup="format(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h4 id="h2valor">$-0</h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col">
                            <div class="form-group">
                                <label> <input type="radio" class="form-control tipoarchivo" name="subirtipo" value="image/x-png,image/jpeg" required checked=""> Subir Imagen </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label> <input type="radio" class="form-control tipoarchivo" id="subirpdf" name="subirtipo" value="application/pdf" required> Subir PDF </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Subir Imagen o PDF Seleccione el Archivo</label>
                                <input type="file" class="form-control" name="imgfactura" id="imgfactura" accept="image/x-png,image/jpeg" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h4> Tabla de Remisiones </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <table id="tabla_remi" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Codigo Remision</th>
                                            <th>Imagen </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $datos_remi = $t26_remisiones->select_remisiones_obra($id_obra);
                                        while ($fila_remi = $datos_remi->fetch(PDO::FETCH_ASSOC)) {
                                            $i++;
                                            $id_remi = $fila_remi['ct26_id_remision'];
                                            $codigo_remi = $fila_remi['ct26_codigo_remi'];
                                            $archivo = $fila_remi['ct26_imagen_remi'];
                                        ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>

                                                <td><input type="checkbox" name="remision[]" id="<?php echo $id_remi; ?>" value="<?php echo $id_remi; ?>"><label for="<?php echo $id_remi; ?>"> <?php echo "  " . $codigo_remi; ?></label> </td>

                                                <?php

                                                if (empty($archivo)) {

                                                    $archivo = "../ver_remision/remision.php?id=" .  $php_clases->HR_Crypt($id_remi, 1);
                                                }
                                                ?>
                                                <td><a target="_blank" href="<?php echo $archivo; ?>" class="btn btn-block btn-success btn-sm"> <i class="far fa-eye"></i> ver </a></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Codigo Remision</th>
                                            <th>Imagen </th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                    <br><hr><br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h4> Tabla de Anexos </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <table id="tabla_anexos" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre Anexos</th>
                                            <th>Archivos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $datos_anexo = $t27_factura->select_anexo_factura($id_cliente);
                                        foreach ($datos_anexo as $fila_remi) {
                                  
                                            $i++;
                                            $id = $fila_remi['id'];
                                            $nombre_doc = $fila_remi['nombre_doc'];
                                            $archivo_doc = $fila_remi['archivo_doc'];
                                        ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>

                                                <td><input type="checkbox" name="anexo[]" id="<?php echo $id; ?>" value="<?php echo $id; ?>"><label for="<?php echo $id; ?>"> <?php echo "  " . $nombre_doc; ?></label> </td>


                                                <td><a target="_blank" href="<?php echo $archivo_doc; ?>" class="btn btn-block btn-success btn-sm"> <i class="far fa-eye"></i> ver </a></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre Anexos</th>
                                            <th>Archivos</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="../../../plugins/datatables/datatables.js"></script>



<script type="text/javascript">
    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
            document.getElementById("h2valor").innerHTML = "$ " + num;
        } else {

            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
    $(document).ready(function() {
        $('.tipoarchivo').change(function() {
            $('#imgfactura').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script>
<script src="ajax_crear.js"></script>
<script>
    $(document).ready(function() {
        $('#tabla_remi').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false
        });
        $('#tabla_anexos').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false
        });
    });
</script>
</body>

</html>