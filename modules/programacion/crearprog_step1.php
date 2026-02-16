<?php 
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 



session_start();

$t8_programacion = new t8_programacion();

if(isset($_POST['txb_fechaprog'])&&!empty($_POST['txb_fechaprog']) && isset($_POST['txb_codprogramacion'])&& !empty($_POST['txb_codprogramacion'])){
    $linea = $_POST['txb_linea'];
    
    $fecha_prog = $_POST['txb_fechaprog'];
    $codProg = $_POST['txb_codprogramacion'];
    
    $fecha_actual = date("Y-m-d H:i:s");

    $last_id = $t8_programacion->link_prog();

    if($last_id){
        $html = '<a href="create/crearprog_step2.php?fecha='.$fecha_prog .'&codprog='.$codProg.'&linea='. $linea . '"> <button class="btn btn-block btn-info" type="button" >   <i class="fas fa-plus"></i> Agregar Registros  </button> </a>';
        echo $html;
    }else{
        echo 'ERROR '.$last_id;
    }

}else{
  echo "faltan campos requeridos";
}