<?php
class t11_usuarios extends conexionPDO
{
    private $table= 'ct11_usuario';
    protected $PDO;
    protected $colt11_id = 'ct11_IdUsuario';
    protected $colt11_date_create = 'ct11_FechaCreacion';
    protected $colt11_estado = 'ct11_Estado';
    protected $colt11_area = 'ct11_areas';
    protected $colt11_id_rol = 'ct11_IdRoles';
    protected $colt11_user = 'ct11_User';
    protected $colt11_pass = 'ct11_ContraUsuario';
    protected $colt11_nombreusuario = 'ct11_NombreUsuario';
    protected $colt11_email = 'ct11_EmailUsuario';
    //protected $colt11_ = '';

    protected $vt11_id;
    protected $vt11_date_create;
    protected $vt11_estado;
    protected $vt11_area;
    protected $vt11_id_rol;
    protected $vt11_user;
    protected $vt11_pass;
    protected $vt11_nombreusuario;
    protected $vt11_email;

    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');   
    }



    function get_datos_usuario($id){
        //asignacion Valores
        $this->vt11_id = (int)$id;

        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt11_id;// Seleccion
        $sql .= " , ";
        $sql .= $this->colt11_estado;// Seleccion
        $sql .= " , ";
        $sql .= $this->colt11_nombreusuario;// Seleccion
        $sql .= " , ";
        $sql .= $this->colt11_id_rol;// Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        $sql .= ' WHERE ';
        $sql .= $this->colt11_id;// CONDUCION
        $sql .= ' = :id';// CONDUCION
        // Fin SQL

        $stmt = $this->con->prepare($sql); // Preparar la conexion
         // Asignando Datos  SQL
         $stmt->bindParam(':id', $this->vt11_id, PDO::PARAM_INT);


        if( $result = $stmt->execute()){ // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if($num_reg == 1){ // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;            
                }

                return $datos;  

            }else{
                return false;
            }
        }else{
            return false;
        }
         $this->PDO->closePDO(); // Cerrar Conexion    
    }




    function autenticacion_usuario($usuario, $pass){
        $this->vt11_user = $usuario;
        $this->vt11_pass = md5($pass);

        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt11_id;// Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        $sql .= ' WHERE ';
        $sql .= $this->colt11_user;// CONDUCION
        $sql .= ' = :ususario';// CONDUCION
        $sql .= ' AND ';
        $sql .= $this->colt11_pass;// CONDUCION 2
        $sql .= ' = :pass ';// CONDUCION 2
        // Fin SQL

        $stmt = $this->con->prepare($sql); // Preparar la conexion

         // Asignando Datos  SQL
         $stmt->bindParam(':ususario', $this->vt11_user, PDO::PARAM_STR);
         $stmt->bindParam(':pass', $this->vt11_pass, PDO::PARAM_STR);
          

        if( $result = $stmt->execute()){ // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if($num_reg == 1){ // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos = $fila['ct11_IdUsuario'];  
                }

                return (int)$datos;  

            }else{
                $err[] = "No se encuentra registros en la base de datos : ". $num_reg; 
                return false;
                //return $err;
            }
            

        }else{
            $err[] = "Error em ejecurar en la base de datos"; 
            return false;
            //return $err;
        }
         $this->PDO->closePDO(); // Cerrar Conexion   
    }


    

    
}