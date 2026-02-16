<?php include '../../../layout/validar_session_cliente3.php' ?>
<?php include '../../../include/model/autoload3.php'; ?>
<?php include '../../../layout/head/headcliente3.php'; ?>
<?php include 'sidebar.php' ?>
<?php 
switch($rol_user)
{
    case 101:
     
        $php_class = new php_class();
        $t27_factura = new t27_factura();
        $t1_terceros = new t1_terceros(); 
        $t5_obras = new t5_obras();

    break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');
    
    break;
}
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Facturacion Electronica</h1>
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
                            <h3 class="card-title">Explorar</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="contenido">
                                <div class="row justify-content-center">

                                    <div class="col-7">
                                        <!-- form-group --> 
                                        <div class="form-group">
                                            <label for="obra"> Seleccione una Obra</label>
                                            <select class="form-control select2"   id="obra" name="obra" style="width: 100%;" >
                                            </select>
                                        </div>
                                        <!-- /.form-group --> 
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <div class="form-group">
                                            <i class="fas fa-search"></i>
                                            <label> Buscar Por... </label>
                                            <select name="categoria" id="categoria" class="form-control select2" style="width: 100%;">
                                                <option value="0" selected="selected">Todos</option>
                                                <option value="1">Numero de la Factura </option>
                                                <option value="2">Valor Total de la Factura </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <i class="fas fa-search"></i>
                                            <label> Que desea Buscar </label>
                                            <br>
                                            <input type="text" class="form-control" name="contenido" id="contenido"  placeholder="Buscar..">
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <div class="form-group">
                                             <li class="far fa-calendar-alt"></li>
                                            <label> fecha de subida </label>
                                            <select name="fechatip" id="fechatip" class="form-control " style="width: 100%; visibility: hidden;">								
                                                <option value="2">De subida entre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'"   name="fechaini" id="fechaini" data-mask>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <i class="far fa-calendar-alt"></i>
                                            <label> Hasta</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" type="date" name="fechafin" id="fechafin" data-mask>
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <input type="hidden" id="buscadorpage" name="page" value="1">
                                        <input type="hidden" id="buscadororder" name="order" value="id">
                                        <input type="hidden" id="buscadorby" name="by" value="asc">	
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="btn btn-block bg-gradient-orange" ame="Buscar" value="Buscar" id="Buscar">
                                    </div>
                                    <div class="col-3"></div>
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
                            <h3 class="card-title">Explorar</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="pageAnimation" align="center">
                                <h2><i class="fa fa-spinner fa-spin"></i></h2>
                            </div>
                          
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Numero Factura</th>
                                        <th>Fecha de subida </th>
                                        <th> Obra </th>
                                        <th> valor Factura </th>
                                        <th> Detalles </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                    
                                    $i = 0;

                                        $datos_factura = $t27_factura->select_factura_cliente($id_cliente);
                                        while($fila_factura = $datos_factura->fetch(PDO::FETCH_ASSOC)){
                                            $i++;
                                            $id = $fila_factura['ct27_id_factura'];
                                            $nombre_factura = $fila_factura['ct27_nombre_factura'];
                                            $fecha_subda = $fila_factura['ct27_fecha_subda'];
                                            $valor_factura = $fila_factura['ct27_valorfact'];
                                           
                                            $id_obra = $fila_factura['ct27_id_obra'];
                                            //$valor_factura = $fila_factura['ct27_valorfact'];

                                            $datos_obras = $t5_obras->select_obras_id($id_obra);
                                            while($fila_obra = $datos_obras->fetch(PDO::FETCH_ASSOC)){
                                                $NombreObra = $fila_obra['ct5_NombreObra'];                                            
                                            }

                                            ?>
                                            <tr>
                                                <td><?php echo $i;  ?></td>
                                                <td><?php echo $nombre_factura; ?></td>
                                                <td><?php echo $fecha_subda; ?></td>
                                              
                                                <td><?php echo $NombreObra; ?></td>
                                                <td><?php echo $valor_factura; ?></td>
                                                                                 
                                                <td><a href="update/editar.php?id='<?php echo $php_class->HR_Crypt($id,1) ;?>"><button>ver</button></a></td>
                                            </tr>
                                            <?php
                                        }
?>                                    
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>No</th>
                                        <th>Numero Factura</th>
                                        <th>Fecha de subida </th>
                                        <th> Obra </th>
                                        <th> valor Factura </th>

                                        <th> Detalles </th>
                                    </tr>
                                </tfooter>


                            </table>
                            
                        </div>
                    </div>


                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php include '../../../layout/footer/footercliente3.php' ?>
<script>
$(document).ready(function() {
    
    $('#example').DataTable();
});
</script>



    </body>
</html>
