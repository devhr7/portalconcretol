<?php





$datos_participantes = $t40_votaciones->select_participante($id_campana);

?>


<?php

foreach ($datos_participantes as $key2) {
?>
    <div class="col-md-3 ">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h2><?php echo $key2['ct41_nombreparticipante']; ?>  </h2>
                    <br>
                    <img src="<?php echo $key2['ct41_foto']; ?>" class="img-fluid mb-1" alt="muestra negra" style="width: 311px;height: 313px;">
                    <br>
                    <h4><?php echo $key2['ct41_cedulaparticipante']; ?></h4>
                    <h5><?php echo $key2['ct41_cargo_participante']; ?></h5>
                    <hr>
                    <button type="button" value="<?php echo $key2['ct41_idparticipantes']; ?>" id='b_voto<?php echo $key2['ct41_idparticipantes']; ?>' class="btn btn-block bg-gradient-info" <?php echo $disabled ?> >Votar</button>
                    <script>

                        $("#b_voto<?php echo $key2['ct41_idparticipantes']; ?>").click(function() {
                            var id_participante = $("#b_voto<?php echo $key2['ct41_idparticipantes']; ?>").val();
                            var id_votante = <?php echo $id_votante; ?>;
                            var id_campana = <?php echo $id_campana; ?>;
                            

                            $.ajax({
                                url: "votar.php",
                                type: "POST",
                                data: {
                                    task: 1,
                                    id_participante : id_participante,
                                    id_votante : id_votante,
                                    id_campana : id_campana,

                                },
                                success: function(response) {

                                    toastr.success('Gracias Por su Voto');
                                    location.reload();
                                },
                                error: function(respuesta) {
                                    alert(JSON.stringify(respuesta));
                                },

                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <br>
    </div>


<?php
}
