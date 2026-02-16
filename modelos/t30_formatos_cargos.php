<?php
class t30_formatos_cargos extends conexionPDO
{
    protected $PDO;
    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    
    
    function get_funciones($id_cargo)
    {
        $this->id_cargo = intval($id_cargo);
        if ($this->id_cargo) {
            $sql = "SELECT `ct30_descripcion` FROM `ct30_funciones` WHERE `ct30_id_cargo` = :id_cargo  ORDER BY `ct30_funciones`.`ct30_descripcion` ASC";
            //Preparar Conexion
            $stmt = $this->con->prepare($sql);
            //insertar parametros
            $stmt->bindParam(':id_cargo', $this->id_cargo, PDO::PARAM_INT);
            if ($result = $stmt->execute()) {
                $num_reg =  $stmt->rowCount();
                if ($num_reg > 0) {
                    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                        $datos[] = $fila;
                    }
                    return $datos;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}