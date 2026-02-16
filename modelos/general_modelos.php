<?php

//require 'conexionPDO.php';

class general_modelos extends conexionPDO {

    public $con;
    private $tabla;
    private $columna_id;
    private $search_id;
    private $estado;
    protected $PDO;

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
        $sql = "SELECT * FROM " . $this->tabla . " WHERE " . $this->columna_id . "= :search_id ";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_STR);

        // Ejecutar 
        if($result = $stmt->execute()){
            $numRow = $stmt->rowCount();

            if ($numRow != 0) {
                $resultado = false;
            } else {
                $resultado = true;
            }
        }else{
            $resultado = true;
        }      
        return $resultado;
    }

   



}