<?php

//require 'conexionPDO.php';

class php_class extends conexionPDO {

    private $tabla;
    private $columna_id;
    private $search_id;
    private $estado;

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    
    
    
    
    function existencia($tabla, $comulna_id, $search) {
        $this->tabla = $tabla;
        $this->columna_id = $comulna_id;
        $this->search_id = $search;
        //SQL
        //$sql = "SELECT * FROM productos ";
        $sql = "SELECT * FROM " . $tabla . " WHERE " . $comulna_id . "= :search_id ";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_INT);

        $stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_STR);

        // Ejecutar 
        $result = $stmt->execute();


        $numRow = $stmt->rowCount();

        if ($numRow != 0) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        
        return $resultado;
        
    }

   



}
