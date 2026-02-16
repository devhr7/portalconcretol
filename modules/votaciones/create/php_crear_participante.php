<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t40_votaciones = new t40_votaciones();


$php_estado = false;
$php_error= "";
$resultado = "";



if (isset($_POST['txt_nombreParticipante_principal']) && !empty($_POST['txt_nombreParticipante_principal']) ){
     
    $id_campana = (int)htmlspecialchars($_POST['txt_id_campana']);
    $nombre_participante = htmlspecialchars($_POST['txt_nombreParticipante_principal']);
    $cedula_participante = htmlspecialchars($_POST['cedulaParticipante_principal']);
    $cargo_participante = htmlspecialchars($_POST['cargoParticipante_principal']);
    
    $image = htmlspecialchars($_FILES['foto_participante']['name']);
    $ruta = htmlspecialchars($_FILES['foto_participante']['tmp_name']);
    $date = "".date('Y/m/d h:i:s', time());

    
    $php_fileexten = strrchr($_FILES['foto_participante']['name'], ".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['foto_participante']['name'] . $date), 0, 40)) . $php_fileexten;
    
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/fotos/';
    $php_tempfoto = ('/internal/fotos/' . $php_serial);





    $id_last_insert = $t40_votaciones->participantes($id_campana, $nombre_participante, $cedula_participante, $cargo_participante, $php_tempfoto);
    
    if($id_last_insert){
        $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);

        $php_estado = true;
        $php_error = $id_campana;
    }else{
        $php_error = "No guardo";
    }
   
    
    
}else{
    $php_error = "Falta llenar Campos Requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,

    
);


echo json_encode($datos, JSON_FORCE_OBJECT);
