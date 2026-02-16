<?php

session_start();
header('Content-Type: application/json');

$id_usuario = $_SESSION['id_usuario'];

require '../../../librerias/conexionPDO.php';
//require '../../../../includes/LibreriasHR.php';


$conexionPDO= new conexionPDO();
$conexion_bd = $conexionPDO->connect();


if (isset($_POST['C_Newpass1']) && isset($_POST['C_Newpass2'])) {

    $C_Newpass1 = htmlspecialchars($_POST['C_Newpass1']);
    $C_Newpass2 = htmlspecialchars($_POST['C_Newpass2']);

    if ($C_Newpass1 == $C_Newpass2) {

        $newPass = md5($C_Newpass1);

        $sql = "UPDATE `ct1_terceros` SET `ct1_pass`= '$newPass'  WHERE ct1_terceros.ct1_IdTerceros = '$id_usuario'";
        $stmt = $conexion_bd->prepare($sql);
       

        if ($stmt->execute()) {
            $php_estado = 1;
        } else {
            $php_estado = 2;
        }
    }
}

$datos = array(
    'estado' => $php_estado
);


echo json_encode($datos, JSON_FORCE_OBJECT);
