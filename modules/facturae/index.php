<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>



<?php

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

switch($rol_user)
{
    case 1:
        case 12:
    case 19:
    case 26:
    case 20:
    case 22:
    case 27:

       
        $php_clases = new php_clases();
        $t27_factura = new t27_factura();
        $t1_terceros = new t1_terceros(); 
        $t5_obras = new t5_obras();

    break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');
    
    break;
}
?>
<?php 

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

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Buscador</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="b_contenido" style="display:none" >
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Seleccionar Cliente</label><br>
                                        <select class="" name="buscadorcliente" id="buscadorcliente">>
                                        <?php 
                                                        echo $t1_terceros->select_conductor();
                                                    ?>

                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Seleccionar Obra</label><br>
                                        <select class="" name="buscadorobra" id="buscadorobra">

                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Seleccionar Busqueda por: </label><br>
                                        <select class="" name="buscadorcategoria" id="buscadorcategoria">
                                        <option value="0">Todo</option>
									<option value="1">Titulo</option>
									<option value="2">Valor</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                       <label> ¿Que deseas Buscar ?</label><br>
                                       <input type="text"  name="buscadornombre" id="buscadornombre" value="TODO"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Fecha </label><br>
                                        <select class=""  name="fechatip" id="fechatip">
                                            <option> De subida entre </option>
                                        </select>
                                    </div>    
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label> Inicial </label> <br>
                                        <input type="date" name="fechaini" id="fechaini">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label> Inicial </label> <br>
                                        <input type="date" name="fechafin" id="fechafin" >
                                    </div>
                                </div>
                            </div>
                            <div>
                            <input type="hidden" id="buscadorpage" name="page" value="1">
								<input type="hidden" id="buscadororder" name="order" value="id">
								<input type="hidden" id="buscadorby" name="by" value="asc">
								<input type="submit" name="BUSCAR" value="BUSCAR" id="Consulta" class="button primary fit" >
                            </div>

                            <div class="row"> 
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" > Busacar</button>
                                    </div>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Explorar</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <a href="create/crear_factura.php" class="btn btn-block btn-info">Crear Factura</a>
                            </div>
                        </div>
                        <div id="b-tabla">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Titulo</th>
                                        <th>subida </th>
                                        <th> cliente </th>
                                        <th> obra </th>
                                        <th style="width:105px"> valor </th>
                                        <th> Detalles </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                    
                                    $i = 0;

                                        $datos_factura = $t27_factura->select_factura();
                                        while($fila_factura = $datos_factura->fetch(PDO::FETCH_ASSOC)){
                                            $i++;

                                            $id_factura = $fila_factura['ct27_id_factura'];
                                            $nombre_factura = $fila_factura['ct27_nombre_factura'];
                                            $fecha_subda = $fila_factura['ct27_fecha_subda'];
                                            $valor_factura = $fila_factura['ct27_valorfact'];
                                            $id_cliente = $fila_factura['ct27_id_cliente'];
                                            $id_obra = $fila_factura['ct27_id_obra'];
                                            //$valor_factura = $fila_factura['ct27_valorfact'];
                                            

                                            $datos_terceros= $t1_terceros->search_tercero_custom_id($id_cliente);
                                            while($fila_terceros = $datos_terceros->fetch(PDO::FETCH_ASSOC)){
                                                $nit = $fila_terceros['ct1_NumeroIdentificacion'];
                                                $razon_social = $fila_terceros['ct1_RazonSocial'];
                                            }

                                            $datos_obras = $t5_obras->select_obras_id($id_obra);
                                            while($fila_obra = $datos_obras->fetch(PDO::FETCH_ASSOC)){
                                                $NombreObra = $fila_obra['ct5_NombreObra'];                                            
                                            }

                                            ?>
                                            <tr>
                                                <td><?php echo $i;  ?></td>
                                                <td><?php echo $nombre_factura; ?></td>
                                                <td><?php echo $fecha_subda; ?></td>
                                                <td><?php echo $razon_social; ?></td>
                                                <td><?php echo $NombreObra; ?></td>
                                                <td><?php echo "$ ".  number_format($valor_factura, 2, ',', ' '); ?></td>
                                  

                                                
                                                <td><a href="update/editar_facturae.php?id=<?php echo $id_factura ;?>" class="btn btn-block btn-info">Editar</a></td>
                                            </tr>
                                            <?php
                                        }
?>                                    
                                </tbody>

                            </table>

                        </div>
                        <div id="tableMessage"></div>						

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


        <?php include '../../layout/footer/footer2.php' ?>

        <script>
            $(document).ready( function () {
    $('#example').DataTable();
} );
        </script>

        <script>
        
       

        $('#fechaini').val(<?php echo json_encode("2020-01-01");?>);
        $('#fechafin').val(<?php echo json_encode("".date("Y-m-d"));?>);


        
        </script>
</body>

</html>