<?php

require '../../../../vendor/autoload.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$PDO = new conexionPDO();
$con = $PDO->connect();

// 1
function actualizar_op_abierto_uno($con)
{
    $sql = "UPDATE `ct63_oportuniodad_negocio` SET `estado` = 1 WHERE `status_op` = 1";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// 2
function actualizar_op_abierto_dos($con)
{
    $sql = "UPDATE `ct63_oportuniodad_negocio` SET `estado` = 1 WHERE `status_op` = 2";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// 3
function actualizar_op_cerrado_tres($con)
{
    $sql = "UPDATE `ct63_oportuniodad_negocio` SET `estado` = 2 WHERE `status_op` = 3";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// 4
function actualizar_op_cerrado_cuatro($con)
{
    $sql = "UPDATE `ct63_oportuniodad_negocio` SET `estado` = 2 WHERE `status_op` = 4";
    $stmt = $con->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


var_dump(actualizar_op_abierto_uno($con));
actualizar_op_abierto_dos($con);
actualizar_op_cerrado_tres($con);
actualizar_op_cerrado_cuatro($con);
