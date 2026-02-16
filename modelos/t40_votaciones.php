<?php


class t40_votaciones extends conexionPDO
{
    protected $con;
    protected $PDO;
    private $id;


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function informe_votantes(){
        $sql="SELECT * FROM `ct42_votantes`";
        $stmt = $this->con->prepare($sql);
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
    }



    function select_ced_votante($id_votante)
    {
        $this->id_votante = (int)$id_votante;
        $sql="SELECT `ct42_cedula_votantes` FROM `ct42_votantes` WHERE `ct42_id_votantes` = :id_votantes";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_votantes', $this->id_votante, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos = $fila['ct42_cedula_votantes'];
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    function verificacion($id_votante,$id_campana)
    {
        $this->id_votante = (int)$id_votante;
        $this->id_campana = (int)$id_campana;
        $sql ="SELECT ct43_id_campana FROM `ct43_registro_votos` WHERE `ct43_id_votante` = :id_votante AND `ct43_id_campana` = :id_campana";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_votante', $this->id_votante, PDO::PARAM_INT);
        $stmt->bindParam(':id_campana', $this->id_campana, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return (int)$fila['ct43_id_campana'];
                }
                //return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function registro_voto($id_votante, $id_campana)
    {
        $this->id_votante = $id_votante;
        $this->id_campana = $id_campana;
        $sql = "INSERT INTO `ct43_registro_votos`( `ct43_id_votante`, `ct43_id_campana`) VALUES (:id_votante,:id_campana)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_votante', $this->id_votante, PDO::PARAM_INT);
        $stmt->bindParam(':id_campana', $this->id_campana, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            $id_insert = $this->con->lastInsertId();
            if ($id_insert) {
                return $id_insert;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function selectvotante()
    {
        $sql = "SELECT * FROM `ct42_votantes`";
        $stmt = $this->con->prepare($sql);

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
    }

    function registrovotantes($cedula, $nombre, $cargo)
    {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->cargo = $cargo;

        $sql = "INSERT INTO `ct42_votantes`( `ct42_cedula_votantes`, `ct42_nombre_votantes`, `ct42_cargo_votantes`) VALUES (:cedula , :nombre , :cargo )";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':cedula', $this->cedula, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':cargo', $this->cargo, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            $id_insert = $this->con->lastInsertId();
            if ($id_insert) {
                return $id_insert;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    function votar($id_participante)
    {
        $this->id_participante = $id_participante;
        $sql =  "SELECT `ct41_votos` FROM `ct41_participantes` WHERE `ct41_idparticipantes` = :id_participante";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_participante', $this->id_participante, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $cant_votos = $fila['ct41_votos'];
                }

                $this->voto = $cant_votos + 1;

                $sql_2 = "UPDATE `ct41_participantes` SET `ct41_votos`= :votos WHERE `ct41_idparticipantes` = :id_participante";
                $stmt2 = $this->con->prepare($sql_2);
                $stmt2->bindParam(':votos', $this->voto, PDO::PARAM_INT);
                $stmt2->bindParam(':id_participante', $this->id_participante, PDO::PARAM_INT);
                if ($result = $stmt2->execute()) {
                    return true;
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

    function select_participante($id_campana)
    {
        $this->id_campana = $id_campana;
        $sql =  "SELECT * FROM `ct41_participantes` WHERE `ct41_id_campana` = :id_campana";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_campana', $this->id_campana, PDO::PARAM_INT);
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
    }


    function select_campana()
    {

        $sql =  "SELECT `ct40_idcampvota`, `ct40_estado`, `ct40_nombrecampvota`  FROM `ct40_campanavotaciones` WHERE `ct40_estado` = 1";
        $stmt = $this->con->prepare($sql);
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
    }

    function tabla_participante($id_camp)
    {
        $this->id_campana = $id_camp;

        $sql = "SELECT * FROM `ct41_participantes` WHERE `ct41_id_campana` = :id_campana ORDER BY `ct41_participantes`.`ct41_votos` DESC";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_campana', $this->id_campana, PDO::PARAM_INT);


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

        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function participantes($id_campana, $nombre_participante, $cedula_participante, $cargo_participante, $foto)
    {

        $this->id_campana = (int)$id_campana;
        $this->nombre_participante = $nombre_participante;
        $this->cedula_participante = $cedula_participante;
        $this->cargo_participante = $cargo_participante;
        $this->foto = $foto;


        // Falta Foto y eliminar Votoss
        $sql = "INSERT INTO `ct41_participantes`( `ct41_id_campana`, `ct41_nombreparticipante`, `ct41_cedulaparticipante`, `ct41_cargo_participante`, ct41_foto) VALUES (:id_campana,:nombre_participante,:cedula_participante,:cargo_participante,:foto)";
        $stmt = $this->con->prepare($sql);
        //  $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':id_campana', $this->id_campana, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_participante', $this->nombre_participante, PDO::PARAM_STR);
        $stmt->bindParam(':cedula_participante', $this->cedula_participante, PDO::PARAM_STR);
        $stmt->bindParam(':cargo_participante', $this->cargo_participante, PDO::PARAM_STR);
        $stmt->bindParam(':foto', $this->foto, PDO::PARAM_STR);


        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function tabla_campana()
    {
        $sql = "SELECT * FROM `ct40_campanavotaciones`";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                foreach ($datos as $fila) {
                    return $datos;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    function crear_campana($nombre_camp, $descripcion_camp, $fecha_ini)
    {
        $this->nombre_camp = $nombre_camp;
        $this->descripcion = $descripcion_camp;
        $this->fecha_ini = $fecha_ini;
        $this->estado = 1;

        $sql = "INSERT INTO `ct40_campanavotaciones`( `ct40_nombrecampvota`, ct40_estado ,`ct40_descripvota`, `ct40_periodovotaini`) VALUES (:nombre_camp,:estado,:descrip_vota,:fecha_ini)";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_camp', $this->nombre_camp, PDO::PARAM_STR);
        $stmt->bindParam(':descrip_vota', $this->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);



        if ($result = $stmt->execute()) {
            $id_insert = $this->con->lastInsertId();
            if ($id_insert) {
                return $id_insert;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
