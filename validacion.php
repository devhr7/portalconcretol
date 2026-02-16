<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validacion
 *
 * @author hr
 */
class validacion {

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }




    public function validar_sesion_funcionario($usuario, $password) {
        $this->usuario = $usuario;
        $this->password = md5($password);
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_NumeroIdentificacion = :identificacion AND ct1_pass = :pass AND ct1_TipoTercero = 10";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':identificacion', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $this->password, PDO::PARAM_STR);
        // Ejecutar 

        if (!$stmt) {
            $datos = false;
        } else {
            $result = $stmt->execute();
        }

        $numero_columnas = $stmt->rowCount();



        if ($numero_columnas > 0) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos = array(
                    'id_tercero' => $fila['ct1_IdTerceros'],
                   
                    'razon_social' => $fila['ct1_RazonSocial'],
                    'rol_user' => $fila['ct1_rol']
                );
            }
        } else {

            $sql_user = "SELECT * FROM ct11_usuario WHERE ct11_User = :usuario AND  ct11_ContraUsuario = :pass";
            $stmt_user = $this->con->prepare($sql_user);

            // Asignando Datos ARRAY => SQL
            $stmt_user->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
            $stmt_user->bindParam(':pass', $this->password, PDO::PARAM_STR);

            if (!$stmt_user) {
                $datos = false;
            } else {
                $result = $stmt_user->execute();
            }
            
             $numero_columnas = $stmt_user->rowCount();
             
              if ($numero_columnas > 0) {
                while ($fila = $stmt_user->fetch(PDO::FETCH_ASSOC)) {
                    $datos = array(
                    'id_tercero' => $fila['ct11_IdUsuario'],
                   
                    'razon_social' => $fila['ct11_NombreUsuario'],
                    'rol_user' => $fila['ct11_IdRoles']
                    );
                }
              }else{
                $datos = false;

              }
             

        }


        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $datos;
    }

}
