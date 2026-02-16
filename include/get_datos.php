<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of get_datos
 *
 * @author SISTEMAS
 */
class get_datos {

    function Select_rolU($conexion_bd) {
        $error =  '<option value="0">Error al cargar Roles</option>';
        $datos = "";
        $rowsArray_Rol = "";
        $sql = "SELECT *  FROM `ct12_rolesu` WHERE  `ct12_IdRoles` >2";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        //$stmt->bind_param("i", $id_cliente);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $rowsArray_Rol .= '<option value="0">Seleccionar Rol</option>';
                while ($fila = $result->fetch_assoc()) {
                    $rowsArray_Rol .= '<option  value="' . $fila['ct12_IdRoles'] . '">' . $fila['ct12_NombreRol'] . '</option>';
                }
                $datos .= $rowsArray_Rol;
            } else {
                $datos = $error;
            }
        } else {
            $datos = $error;
        }
        return $datos;
    }
    
    function get_all($conexion_bd,$tabla,$columnaid,$id_campo) {
        
        $sql = "SELECT * FROM " . $tabla. " WHERE ". $columnaid ." = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_campo);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            
            if ($n_rows > 0) {
                $resultado = $result;
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
    
    }
    
    function ct26_Remisiones2($conexion_bd,$id_cliente) {
        $sql = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`,`ct26_fecha_remi`,ct26_razon_social, `ct26_estado`, ct26_nombre_obra FROM `ct26_remisiones`  WHERE  ct26_idcliente = ? ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC ";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_cliente);
 
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
    


      function ct26_Remisiones1($conexion_bd,$id_obra) {
        $sql = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idObra`,ct5_obras.ct5_NombreObra, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` INNER JOIN ct5_obras ON ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE ct5_obras.ct5_IdObras = ? ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC ";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_obra);
 
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
    
    function ct26_Remisiones($conexion_bd,$id_Cliente1) {
        $sql = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idObra`,ct5_obras.ct5_NombreObra, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` INNER JOIN ct5_obras ON ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE ct5_obras.ct5_IdTerceros = ? ORDER BY ct26_remisiones.ct26_id_remision DESC ";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_Cliente1);

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
    
    
    function Select_Obra($conexion_bd,$id_cliente) {
        $error =  '<option value="0">Error al cargar Obras</option>';
        $datos = "";
        $rowsArray_obra = "";
        $sql = "SELECT `ct5_IdObras`, `ct5_EstadoObra`,`ct5_NombreObra` FROM `ct5_obras` WHERE ct5_obras.ct5_IdTerceros = ?";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("i", $id_cliente);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $rowsArray_obra .= '<option value="0">Seleccionar Obras</option>';
                while ($fila = $result->fetch_assoc()) {
                    $rowsArray_obra .= '<option  value="' . $fila['ct5_IdObras'] . '">' . $fila['ct5_NombreObra'] . '</option>';
                }
                $datos .= $rowsArray_obra;
            } else {
                $datos = $error;
            }
        } else {
            $datos = $error;
        }
        return $datos;
    }
    
    function Select_Cliente($conexion_bd) {
        $error =  '<option value="0">Error al cargar clientes</option>';
        $sql = "SELECT  `ct1_IdTerceros`,`ct1_NumeroIdentificacion`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_TipoTercero` = 1 AND `ct1_Estado` = 1";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        //$stmt->bind_param("s", $id_valor);
        $rowsArray_cliente="";
        $datos = "";
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $n_rows = $result->num_rows;
            if ($n_rows > 0) {
                $rowsArray_cliente .= '<option value="0">Seleccionar Cliente</option>';
                while ($fila = $result->fetch_assoc()) {
                    $rowsArray_cliente .= '<option  value="' . $fila['ct1_IdTerceros'] . '">' . $fila['ct1_NumeroIdentificacion'] . " - " . $fila['ct1_RazonSocial'] . '</option>';
                }
                $datos .= $rowsArray_cliente;
            } else {
                $datos = $error;
            }
        } else {
            $datos = $error;
        }
        return $datos;
    }

    function ct5_obras_inner1($conexion_bd) {
        $sql = "SELECT ct5_obras.ct5_IdObras, ct5_obras.ct5_EstadoObra, ct5_obras.ct5_NombreObra, ct5_obras.ct5_DireccionObra, ct5_obras.ct5_IdTerceros, ct1_terceros.ct1_NumeroIdentificacion, ct1_terceros.ct1_RazonSocial FROM `ct5_obras` INNER JOIN ct1_terceros ON ct5_obras.ct5_IdTerceros = ct1_terceros.ct1_IdTerceros";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        //$stmt->bind_param("s", $id_valor);

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
