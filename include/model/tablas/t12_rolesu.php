<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of t12_rolesi
 *
 * @author hr
 */
class t12_rolesu {
    
    private $id_roles;
    
    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    
    function option_roles($id_roles) {
        
        $this->id_roles = $id_roles;
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Rol</option>";

        $sql = "SELECT * FROM `ct12_rolesu` WHERE `ct12_IdRoles` > 1 AND `ct12_IdRoles` < 99 ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($this->id_roles == $fila['ct12_IdRoles']){
                
                $selection = "selected='true'";
                
            }else{
                $selection = "";
                
            }
            $option .= '<option value="' . $fila['ct12_IdRoles'] . '" '. $selection .' >' . $fila['ct12_NombreRol'] . ' - ' . $fila['ct12_area'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
        
    }
}
