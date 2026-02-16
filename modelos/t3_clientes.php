<?php 
class t3_clientes extends conexionPDO
{
    protected $PDO;
    private $table = 'ct3_clientes';

    protected $colt3_id = 'ct3_IdTerceros';
    protected $colt3_tipo_cliente = 'ct3_TipoCliente';
    protected $colt3_modalidad_pago = 'ct3_ModalidadPago';
    protected $colt3_estado_cupo = 'ct3_CupoEstado';
    protected $colt3_cupo = 'ct3_Cupo';
    protected $colt3_total_despachado = 'ct3_TotalDespachados';
    protected $colt3_total_recaudado = 'ct3_TotalRecaudado';
    protected $colt3_saldoDisponible = 'ct3_SaldoDisponible';
    protected $colt3_saldo_inicial = 'ct3_SaldoDisponibleInicial';
    protected $colt3_saldo_cartera = 'ct3_SaldoCartera';
    protected $colt3_saldo_inicial_cartera = 'ct3_SaldoInicialCartera';
    protected $colt3_cupo_extra_estado = 'ct3_CupoExtraEstado';
    protected $colt3_fecha_creacion_cupo_extra = 'ct3_FechaCreacionCupoExtra';
    protected $colt3_fecha_limite_cupo_extra = 'ct3_FechaLimiteCupoExtra';
    protected $colt3_cupo_extra = 'ct3_CupoExtra';
    protected $colt3_saldo_extra = 'ct3_SaldoExtra';

    protected $vt11_id;
    protected $vt11_tipo_cliente;
    protected $vt11_modalidad_pago;
    protected $vt11_estado_cupo;
    protected $vt11_cupo;
    protected $vt11_total_despachado;
    protected $vt11_total_recaudado;
    protected $vt11_saldoDisponible;
    protected $vt11_saldo_inicial;
    protected $vt11_saldo_cartera;
    protected $vt11_saldo_inicial_cartera;
    protected $vt11_cupo_extra_estado;
    protected $vt11_fecha_creacion_cupo_extra;
    protected $vt11_fecha_limite_cupo_extra;
    protected $vt11_cupo_extra;
    protected $vt11_saldo_extra;

    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');   
    }


    

    function get_datos_cliente($id_cliente){

        $this->id_cliente = (int)$id_cliente;
        $sql = "SELECT * FROM `ct3_clientes` WHERE `ct3_IdTerceros` = :id_cliente";
        $stmt = $this->con->prepare($sql); // Preparar la conexion

        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);

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


    function get_datos_for_table(){
        //SQL
        $sql = "SELECT ";
        $sql .= $this->colt3_id;// Seleccion
        $sql .= " , ";
        $sql .= $this->colt3_tipo_cliente;// Seleccion
        $sql .= " , ";
        $sql .= $this->colt3_estado_cupo;// Seleccion
        $sql .= " FROM ";
        $sql .= $this->table;
        
        $stmt = $this->con->prepare($sql); // Preparar la conexion

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





 
}