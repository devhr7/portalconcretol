<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LibreriasHR
 *
 * @author HR
 */
class LibreriasHR {
    
    
    function ValidarExistencias($conexion_bd, $tabla,$columna, $valor) {
        $sql = "SELECT ".$columna ." FROM " . $tabla. " WHERE ". $columna ." = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("s", $valor);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows == 0) {
                $resultado = true;
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
    }
    
    function HR_Crypt($valor, $encode_decode) {
        $secret_key = 'my_195501421';
        $secret_iv = 'my_195501421';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($encode_decode == 1) {
            $this->hashnum = base64_encode(openssl_encrypt($valor, $encrypt_method, $key, 0, $iv));
        }
        if ($encode_decode == 2) {
            $this->hashnum = openssl_decrypt(base64_decode($valor), $encrypt_method, $key, 0, $iv);
        }

        return $this->hashnum;
    }

    function ValidarCambioPass($conexion_bd, $tipoTercero, $id_Usuario) {
        $NumeroIdentificacion = 0;
        $Pass = 2;

        $sql = "SELECT ct1_NumeroIdentificacion,ct1_pass FROM `ct1_terceros` WHERE ct1_TipoTercero = ?  AND `ct1_IdTerceros` = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("ii", $tipoTercero, $id_Usuario);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($fila = $result->fetch_assoc()) {
                $NumeroIdentificacion = $fila['ct1_NumeroIdentificacion'];
                $Pass = $fila['ct1_pass'];
            }
            if (md5($NumeroIdentificacion) == $Pass) {
                $resultado = true;
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
    }
    
    
    
    function get_datos_for_table($conexion_bd, $tabla,$columna_condicion, $id_valor) {
        $sql = "SELECT * FROM " . $tabla. " WHERE ". $columna_condicion ." = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("s", $id_valor);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $datos = $result;
            } else {
                $datos = false;
            }
        } else {
            $datos = false;
        }
        return $datos;
    }
    
    function get_datos_update($conexion_bd, $tabla,$id_columna, $id_valor) {
        $sql = "SELECT * FROM " . $tabla. " WHERE ". $id_columna ." = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_valor);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $datos = $result;
            } else {
                $datos = false;
            }
        } else {
            $datos = false;
        }
        return $datos;
    }
    
    function get_ct1_usuariosclientes2($conexion_bd, $id_cliente1) {
        $sql = "SELECT * FROM `ct1_terceros` WHERE ct1_terceros.ct1_TipoTercero = 3 AND ct1_terceros.ct1_id_cliente1 = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_cliente1);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $datos = $result;
            } else {
                $datos = false;
            }
        } else {
            $datos = false;
        }
        return $datos;
    }

}
