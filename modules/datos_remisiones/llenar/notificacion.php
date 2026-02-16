<?php
$notificacion;

if ($notificacion >= 7) {
    ?>

    <div>
        <i class="fas fa-clipboard-check bg-blue"></i>

        <div class="timeline-item">
            <!-- Time -->

            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <?php if (!empty($nombre_recibido)):
                ?>
                <h4>La Remision Fue aceptada el dia <b><?php echo $fecha_recibido ?></b>. Por <b><?php echo $nombre_recibido; ?></b></h4>

                <?php
            else:
                ?>
                <h3 class="timeline-header">Aceptacion del Producto</h3>
                <!-- Body -->



                <div class="timeline-body">

                    Dar clic para Aceptar la Remision 
                </div>
                <div class="timeline-footer">

                    <a class="btn btn-primary btn-sm disabled" href="#ActualizarRMI" data-toggle="modal" data-target="#modal-default">Aceptar</a>


                </div>


            <?php
            endif;
            ?>

            <!-- Placement of additional controls. Optional -->



            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form name="f_recibido2" id="f_recibido" method="POST">
                            <div class="modal-header">
                                <h4 class="modal-title">Esta seguro de aceptar esta remision</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <input type="checkbox"  name="validar" id="validar" value="" class="form-control" style="width: 15px" required="required">
                                    Acepta el TRATAMIENTO DE DATOS PERSONALES. Cada una de LAS PARTES manifiesta expresamente su autorizacion para que LA OTRA PARTE efectue el tratamiento de sus datos personales de conformidad con lo establecido en la Ley 1581 de 2012 y el Decreto Reglamentario 1377 del 2013 y el capitulo 25 del Decreto Reglamentario 1074
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="btn_fin" name="btn_fin" class="btn btn-success disabled">Recibido</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>

    <?php
}




if ($notificacion >= 7) {
    ?>


    <!--------------------------------------------------------------------------->
    <div>
        <i class="fas fa-clock bg-blue"></i>
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header">Observaciones </h3>
            <!-- Body -->
            <div class="timeline-body">

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Digite una Observacion </label>
                            <br>
                            <input type="text" class="form-control" name="c_observaciones" id="c_observaciones" value="<?php echo $observaciones ?>" maxlength="100" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">

                <button id="b_observaciones" class="btn btn-primary btn-sm">Guardar</button>

            </div>
        </div>
    </div>

    <?php
}

if ($notificacion >= 7) {
    ?>


    <!--------------------------------------------------------------------------->
    <div>
        <i class="fas fa-clock bg-blue"></i>
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header">Servicio de Bomba </h3>
            <!-- Body -->
            <div class="timeline-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label> Tiene Servicio de Bomba </label>
                        </div>
                    </div>
                </div>

                <?php
                if ($servicio_bomba) {
                    $check_si = "checked='checked'";
                    $check_no = " ";
                } else {
                    $check_si = " ";
                    $check_no = "checked='checked'";
                }
                
                switch ($tipo_bomba) {
                    case 1:
                        $check_bomb_est = "checked='checked'";
                        $check_bomb_auto = "";
                        break;
                    case 2:
                        $check_bomb_est = "";
                        $check_bomb_auto = "checked='checked'";
                    break;
                
                    default:
                        $check_bomb_est = "";
                        $check_bomb_auto = "";
                        break;
                }
                
                ?>
                <div class="row">
                    <div class="col">
                        <label>SI </label>
                    </div>
                    <div class="col">
                        <input type="radio" class="form-control r_bomba"  id="check_si" name="c_servicio_bomba" value="1"  <?php echo $check_si ?> /> 
                    </div>
                    <div class="col">
                        <div class="">
                            <label>NO </label>
                        </div>
                    </div>
                    <div class="col" >
                        <input type="radio" class="form-control r_bomba"  id="check_no" name="c_servicio_bomba"  value="0" <?php echo $check_no ?> /> 
                    </div>

                    <div class="col-1"> </div>
                    <div class="col-3" style=" border-left: 1px solid gray;">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Tipo de Bombeo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="radio" class="form-control r_bomba"  id="check_bomba_est" name="tipo_bomba" value="1"  <?php echo $check_bomb_est ?> /> 
                            </div>
                            <div class="col">
                                <label for="check_bomba_est">Bomba Estacionaria </label>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <input type="radio" class="form-control r_bomba"  id="check_bomba_auto" name="tipo_bomba"  value="2" <?php echo $check_bomb_auto ?> /> 
                            </div>
                            <div class="col">
                                <label for="check_bomba_auto">Auto Bomba </label>
                            </div>

                        </div>





                    </div >

                    <div class="col-1"></div>


                    <div class="col" style=" border-left: 1px solid gray;">
                        <div class="form-group">
                            <label> Cantidad Bombeada </label>
                            <br>
                            <input type="text" name="c_cantidad_bombeada" id="c_cantidad_bombeada" value="<?php echo $cantidad_bombeada ?>"  />
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>




            </div>
            <div class="timeline-footer">

                <button id="b_bomba" class="btn btn-primary btn-sm">Guardar</button>

            </div>
        </div>
    </div>

<?php
}

    if ($notificacion >= 6) {
    ?>
    <div>
        <i class="fas fa-clock bg-blue"></i>
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header">Hora de llegada Mixer en planta</h3>
            <!-- Body -->
            <div class="timeline-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Hora de llegada Mixer en planta</label>
                            <br>
                            <input type="time" id="ch_llegada_planta" name="ch_llegada_planta" value='<?php echo $Hora_llegada_planta ?>'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">

                <button id="b_llegada_planta" class="btn btn-primary btn-sm">Guardar</button>

            </div>
        </div>
    </div>

    <?php
}
//////////////////////////






//////////////////////////////////////////////////
if ($notificacion >= 6) {
    ?>
    <div>
        <i class="fas fa-clock bg-blue"></i>
        <div class="timeline-item">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header">hora de Teminacion de descargue</h3>
            <!-- Body -->
            <div class="timeline-body">

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            <label>Seleccione la hora de Teminacion de descargue</label>
                            <br>
                            
                            <input type="time" id="ch_terminacion" name="ch_terminacion" value='<?php echo $Hora_terminacion_descargue ?>'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">

                <button id="b_terminacion_descargue" class="btn btn-primary btn-sm">Guardar</button>

            </div>
        </div>
    </div>

    <?php
}



if ($notificacion >= 5) {
    ?>

    <!--  Hora de llegada del vehiculo -->
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-clock bg-blue"></i>
        <!-- Timeline item -->
        <div class="timeline-item" id="">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"> Hora de Inicio de descargue del producto </h3>
            <!-- Body -->
            <div class="timeline-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Seleccione la hora de Inicio de descargue del producto</label>
                            <br>
                            <input type="time" id="h_descargueProduct" name="h_descargueProduct" value='<?php echo $Hora_inicio_descargue ?>'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">               
                <button id="b_descargueProduct" class="btn btn-primary btn-sm">Guardar</button>
            </div>
        </div>
    </div>

    <?php
}










if ($notificacion >= 4) {
    ?>

    <!--  Hora de llegada del vehiculo -->
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-clock bg-blue"></i>
        <!-- Timeline item -->
        <div class="timeline-item" id="">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"> Hora de llegada del Vehiculo en obra </h3>
            <!-- Body -->
            <div class="timeline-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Seleccione la hora de llegada del vehiculo en obra</label>
                            <br>
                            <input type="time" id="ch_llegadaObra" name="ch_llegadaObra" value='<?php echo $Hora_llegada_obra ?>'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">

                <button id="b_llegadaVehiculo" class="btn btn-primary btn-sm">Guardar</button>


            </div>
        </div>
    </div>

    <?php
}


if ($notificacion >= 3) {
    ?>

    <!--  Hora de llegada del vehiculo -->
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-clock bg-blue"></i>
        <!-- Timeline item -->
        <div class="timeline-item" id="">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"> Hora de salida Mixer en Planta </h3>
            <!-- Body -->
            <div class="timeline-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Seleccione la Hora de salida Mixer en Planta</label>
                            <br>
                            <input type="time" id="h_salida_planta" name="h_salida_planta" value='<?php echo $Hora_salida_planta ?>'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-footer">  
                <button id="bh_salida_planta" class="btn btn-primary btn-sm">Guardar</button>
            </div>
        </div>
    </div>

    <?php
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////77
if ($notificacion >= 2) {
    ?>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-truck-moving bg-blue"></i>

        <!-- Timeline item -->
        <div class="timeline-item" id="">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"> En camino </h3>
            <!-- Body -->
            <div class="timeline-body">
                <h3> la Remision <?php echo $codigo_remision; ?>  </h3>
                
                <a class="btn bg-orange btn-sm" href="ver_remision/remision.php?id=<?php echo $_GET['id']; ?>" >  <i class="far fa-eye"></i> Ver Remision</a>

                <h5>Se ha asignado
                    La mixer <?php echo $t26_remisiones->get_vehiculo($id); ?>  con el conductor <?php echo $t26_remisiones->get_conductor($id); ?></h5>
            </div>
        </div>
    </div>
    <?php
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////7
if ($notificacion >= 1) {
    ?>
    <div>
        <!-- Before each timeline item corresponds to one icon on the left scale -->
        <i class="fas fa-clock bg-gray"></i>
        <!-- Timeline item -->
        <div class="timeline-item" id="">
            <!-- Time -->
            <span class="time"><i class="fas fa-clock"></i> </span>
            <!-- Header. Optional -->
            <h3 class="timeline-header"> En Preparacion </h3>
            <!-- Body -->

        </div>
    </div>
    <?php
}
        
        