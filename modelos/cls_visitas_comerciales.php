<?php
class cls_visitas_comerciales extends conexionPDO
{
    public $con; // variable de conexion a la base de datos
    protected $PDO;

    // Conexcion y a la base de datos
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }


    // Update 3 Observaciones
    public function update_observaciones($id, $observaciones){
       
        $sql="UPDATE `visitas_clientes` SET `observaciones`=:observaciones WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }

    // Update 3  Resultado visita Forma de Contacto
    public function update_resultado($id, $id_forma_contacto, $id_resultado_visita){
        $forma_contacto = "nombre_forma_contacto";
        $resultado_visita ="Nombre_resultado_visita";
        $sql="UPDATE `visitas_clientes` SET `id_forma_contacto` = :id_forma_contacto, `forma_contacto` = :forma_contacto,`id_resultado_visita` = :id_resultado_visita, `resultado_visita` = :resultado_visita WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_forma_contacto', $id_forma_contacto, PDO::PARAM_INT);
        $stmt->bindParam(':forma_contacto', $forma_contacto, PDO::PARAM_STR);
        $stmt->bindParam(':id_resultado_visita', $id_resultado_visita, PDO::PARAM_INT);
        $stmt->bindParam(':resultado_visita', $resultado_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }

    // Update 3 FEcha_fundida
    public function update_proyeccion_fundida($id, $metros_potenciales, $fecha_fundida){
      
        $sql="UPDATE `visitas_clientes` SET `metros_potenciales` = :metros_potenciales,`fecha_fundida` = :fecha_fundida WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':metros_potenciales', $metros_potenciales, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fundida', $fecha_fundida, PDO::PARAM_STR);
  
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }


    // Update  Maestro Nuevo
    public function update_maestro_nuevo($id, $maestro_nuevo, $nombre_maestro, $telefono_maestro){
       
        $sql="UPDATE `visitas_clientes` SET `maestro_nuevo` = :maestro_nuevo, `nombre_maestro` = :nombre_maestro, `telefono_maestro`  = :telefono_maestro WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':maestro_nuevo', $maestro_nuevo, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_maestro', $nombre_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_maestro', $telefono_maestro, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }

    // Update  Sede Municipio
    public function update_lugar($id, $id_sede, $id_departamento,$id_municipio, $idzona, $barrio ){
        $sede = "nombre_sede";
        $departamento ="Nombre_objetivo_visita";
        $municipio ="Nombre_municipio";
        $zona ="Nombre_zona";
        $sql="UPDATE `visitas_clientes` SET `id_sede`= :id_sede,`sede` =:sede,`id_departamento` = :id_departamento ,`departamento` = :departamento,`id_municipio` = :id_municipio,`municipio` = :municipio,`id_zona` = :idzona,`zona_comuna` = :zona,`barrio` = :barrio WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_sede', $id_sede, PDO::PARAM_INT);
        $stmt->bindParam(':sede', $sede, PDO::PARAM_STR);
        $stmt->bindParam(':id_departamento', $id_departamento, PDO::PARAM_INT);
        $stmt->bindParam(':departamento', $departamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_municipio', $id_municipio, PDO::PARAM_STR);
        $stmt->bindParam(':municipio', $municipio, PDO::PARAM_STR);
        $stmt->bindParam(':idzona', $idzona, PDO::PARAM_STR);
        $stmt->bindParam(':zona', $zona, PDO::PARAM_STR);
        $stmt->bindParam(':barrio', $barrio, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }



    // Update   Tipo Cliente_ Tipo Plan Maestro
    public function update_tipo_plan_maestro($id, $id_tipo_cliente, $id_tipo_plan_maestro){
        $tipo_cliente = "nombre_tipo_cliente";
        $plan_maestro ="Nombre_plan_maestro";
        $sql="UPDATE `visitas_clientes` SET `id_tipo_cliente` = :id_tipo_cliente, `tipo_cliente` = :tipo_cliente, `id_tipo_plan_maestro` = :id_tipo_plan_maestro, `plan_maestro` = :plan_maestro WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_tipo_cliente', $id_tipo_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_cliente', $tipo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_plan_maestro', $id_tipo_plan_maestro, PDO::PARAM_INT);
        $stmt->bindParam(':plan_maestro', $plan_maestro, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }

    // Update 3  Cliente y Obra_nuevo _datos
    public function update_cliente_obra_nuevos($id, $documento, $nombre_cliente, $telefono_cliente,$nombre_obra,$direccion_obra){
        
        $sql="UPDATE `visitas_clientes` SET `documento` = :documento, `nombre_cliente`= :nombre_cliente, `telefono_cliente`= :telefono_cliente, `nombre_obra` = :nombre_obra,`direccion_obra`= :direccion_obra WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':direccion_obra', $direccion_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }

    // Update  Cliente Nuevo
    public function update_cliente_nuevo($id, $cliente_nuevo){    
        $sql="UPDATE `visitas_clientes` SET `clientenuevo` = :cliente_nuevo WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cliente_nuevo', $cliente_nuevo, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }



// Update1 Asesor Comercial , Objetivo de la visita
    public function update_asesor_comercial($id, $id_asesor_comercial, $id_objetivo_visita){
        $asesora_comercial = "nombre_asesor_comercial";
        $nombre_objetivo_visita ="Nombre_objetivo_visita";
        $sql="UPDATE `visitas_clientes` SET `id_comercial`=:id_comercial,`asesor_comercial`=:asesor_comercial,`id_objetivo_visita`=:id_objetivo_visita,`objetivo_visita`=:obj_visita WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_comercial', $id_asesor_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':asesor_comercial', $asesora_comercial, PDO::PARAM_STR);
        $stmt->bindParam(':id_objetivo_visita', $id_objetivo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':obj_visita', $nombre_objetivo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar   
            return true;
        }else{
            return false;
        }
    }



    public function update_up_visita($id,$id_objetivo_visita,$cliente_nuevo,$documento, $nombre_cliente, $telefono_cliente, $start,$end){
        
        $estado = 1;
        $objetivo_visita = $id_objetivo_visita;
        
        $documento = $documento;
        $nombre_cliente = $nombre_cliente;
        $telefono_cliente = $telefono_cliente;
    
        $sql = "UPDATE `visitas_clientes` SET `id_objetivo_visita` = :id_objetivo_visita, `objetivo_visita` = :objetivo_visita,`clientenuevo` = :cliente_nuevo, `documento` = :documento, `nombre_cliente` = :nombre_cliente, `telefono_cliente`= :telefono_cliente, `start` = :start, `end` = :end  WHERE `id` =:id";
            
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_objetivo_visita', $id_objetivo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':objetivo_visita', $objetivo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':cliente_nuevo', $cliente_nuevo, PDO::PARAM_STR);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_STR);
        $stmt->bindParam(':end', $end, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
           return true;
        }else{
            return false;
        }
   
    }


    public function crear_visita($id_cliente,$id_objetivo_visita,$cliente_nuevo,$documento, $nombre_cliente, $telefono_cliente, $start,$end){
        $id_cliente;
        $estado = 1;
        $objetivo_visita = $id_objetivo_visita;
        
        $documento = $documento;
        $nombre_cliente = $nombre_cliente;
        $telefono_cliente = $telefono_cliente;
        $sql ="INSERT INTO `visitas_clientes`(`status`,  `id_objetivo_visita`, `objetivo_visita`, `clientenuevo`,  `id_cliente`, `documento`, `nombre_cliente`, `telefono_cliente`, `start`, `end`) VALUES (:estado, :id_objetivo_visita, :objetivo_visita, :cliente_nuevo,  :id_cliente, :documento, :nombre_cliente, :telefono_cliente, :start, :end) ";
            
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_objetivo_visita', $id_objetivo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':objetivo_visita', $objetivo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':cliente_nuevo', $cliente_nuevo, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':telefono_cliente', $telefono_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_STR);
        $stmt->bindParam(':end', $end, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $id_insert = $this->con->lastInsertId();
            return $id_insert;
        }else{
            return false;
        }
   
    }





   public function actualizar_estado($id_visita, $status){
       $date = "" . date('Y/m/d h:i:s', time());

        $sql="UPDATE `visitas_clientes` SET `status`= :estado WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id_visita, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    

    public function informe_excel_visitas_clientes($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT `id`, `status`, `fecha`, `id_comercial`, `asesor_comercial`, `id_objetivo_visita`, `objetivo_visita`, `clientenuevo`, `id_tipo_cliente`, `tipo_cliente`, `id_tipo_plan_maestro`, `plan_maestro`, `id_cliente`, `documento`, `nombre_cliente`, `telefono_cliente`, `id_obra`, `nombre_obra`, `direccion_obra`, `id_sede`, `sede`, `id_departamento`, `departamento`, `id_municipio`, `municipio`, `id_zona`, `zona_comuna`, `barrio`, `maestro_nuevo`, `id_maestro`, `nombre_maestro`, `telefono_maestro`, `metros_potenciales`, `fecha_fundida`, `id_forma_contacto`, `forma_contacto`, `id_resultado_visita`, `resultado_visita`, `observaciones`, `fecha_cumplimiento`, `start`, `end` FROM `visitas_clientes` WHERE `start` BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha` DESC;";


        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['id_comercial'] = $fila['id_comercial'];
                    $data_array['nombre_comercial'] = $fila['id_comercial'];
                    $data_array['id_objetivo_visita'] = $fila['id_objetivo_visita'];
                    $data_array['objetivo_visita'] = $fila['id_objetivo_visita'];
                    $data_array['nombre_comercial'] = $fila['id_comercial'];
                    $data_array['clientenuevo'] = $fila['clientenuevo'];
                    $data_array['id_tipo_cliente'] = $fila['id_tipo_cliente'];
                    $data_array['tipo_cliente'] = $fila['id_tipo_cliente'];
                    $data_array['id_tipo_plan_maestro'] = $fila['id_tipo_plan_maestro'];
                    $data_array['tipo_plan_maestro'] = $fila['id_tipo_plan_maestro'];
                    $data_array['id_cliente'] = $fila['id_cliente'];
                    $data_array['documento'] = $fila['documento'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['telefono_cliente'] = $fila['telefono_cliente'];
                    $data_array['id_obra'] = $fila['id_obra'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['direccion_obra'] = $fila['direccion_obra'];
                    $data_array['telefono_cliente'] = $fila['telefono_cliente'];
                    $data_array['id_sede'] = $fila['id_sede'];
                    $data_array['sede'] = $fila['id_sede'];
                    $data_array['id_departamento'] = $fila['id_departamento'];
                    $data_array['departamento'] = $fila['id_departamento'];
                    $data_array['id_municipio'] = $fila['id_municipio'];
                    $data_array['municipio'] = $fila['id_municipio'];
                    $data_array['id_zona'] = $fila['id_zona'];
                    $data_array['zona'] = $fila['id_zona'];
                    $data_array['barrio'] = $fila['barrio'];
                    $data_array['maestro_nuevo'] = $fila['maestro_nuevo'];
                    $data_array['id_maestro'] = $fila['id_maestro'];
                    $data_array['nombre_maestro'] = $fila['nombre_maestro'];
                    $data_array['telefono_maestro'] = $fila['telefono_maestro'];
                    $data_array['metros_potenciales'] = $fila['metros_potenciales'];
                    $data_array['fecha_fundida'] = $fila['fecha_fundida'];
                    $data_array['id_forma_contacto'] = $fila['id_forma_contacto'];
                    $data_array['forma_contacto'] = $fila['id_forma_contacto'];
                    $data_array['id_forma_contacto'] = $fila['id_forma_contacto'];
                    $data_array['id_resultado_visita'] = $fila['id_resultado_visita'];
                    $data_array['resultado_visita'] = $fila['id_resultado_visita'];
                    $data_array['observaciones'] = $fila['observaciones'];
                    $data_array['start'] = $fila['start'];
                    $data_array['end'] = $fila['end'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }


    function eliminar_anexo($id){
        $sql = "DELETE FROM `visitas_anexos` WHERE `id` = :id ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            if(SELF::validar_anexos($this->con, $id)){
                SELF::actualizar_estadovisita($this->con,$id, 1);
            }else{
                SELF::actualizar_estadovisita($this->con,$id, 1);
            }
            return true;
        }else{
            return false;
        }


    }

    function data_table_oanexos($id_visita)
    {
     
        $sql = "SELECT `id`, `id_visita`, `nombre`, `file_anexo` FROM `visitas_anexos` WHERE `id_visita` = :id_visita ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos_obra['id'] = $fila['id'];
                    $datos_obra['id_visita'] =  $fila['id_visita'];
                    $datos_obra['nombre_anexo'] =  $fila['nombre'];
                    $datos_obra['archivo'] =  '<a href="'.$fila['file_anexo'].'"  target="_blank" > <i class="fas fa-file-pdf"></i> Archivo </a>';
                    $datos_obra['botones'] =  '';
                    $datos[] = $datos_obra;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function validar_anexos($con,$id_visita){
        $sql="SELECT * FROM `visitas_anexos` WHERE `id_visita` = :id_visita";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  intval($stmt->rowCount());
            if($num_reg > 0){
                return true;
            }else{
                return false;
            } // Cuenta los numero de registros de sql
            
        }


    }

    public static function actualizar_estadovisita($con,$id_visita, $status){
       $date = "" . date('Y/m/d h:i:s', time());

        $sql="UPDATE `visitas_clientes` SET `status`= :estado, fecha_cumplimiento = :fecha_cumplimiento WHERE `id` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':estado', $status, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_cumplimiento', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id_visita, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }


    function subir_anexo($nombre_anexo,$file_anexo, $ruta, $id_visita)
    {
      $php_fechatime = date("Y-m-d H:i:s");
      $date = "" . date('Y/m/d h:i:s', time());

      if(SELF::validar_anexos($this->con, $id_visita)){
        SELF::actualizar_estadovisita($this->con,$id_visita, 1);
    }else{
        SELF::actualizar_estadovisita($this->con,$id_visita, 2);
    }

      $this->file_anexo = $file_anexo;
      $php_fileexten = strrchr($this->file_anexo, ".");
      $php_serial = strtoupper(substr(hash('sha1', $this->file_anexo . $date), 0, 40)) . $php_fileexten;
  
  
      $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/anexos_visitas/';
      $php_tempfoto = ('/internal/anexos_visitas/' . $php_serial);
  
      $sql = "INSERT INTO `visitas_anexos`( `id_visita`, `nombre`, `file_anexo`,fecha_subida) VALUES (:id_visita, :nombre, :file_anexo, :fecha_subida);";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
      $stmt->bindParam(':nombre', $nombre_anexo, PDO::PARAM_STR);
      $stmt->bindParam(':file_anexo', $php_tempfoto, PDO::PARAM_STR);
      $stmt->bindParam(':fecha_subida', $date, PDO::PARAM_STR);
      // Ejecutar 
      if ($result = $stmt->execute()) {
        $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
        
        return true;
      }

      

      //Cerrar Conexion
      $this->PDO->closePDO();
      //resultado
      return $result;
    }


    public function get_comercial_tercero($id_cliente)
    {
        $sql = "SELECT `ct1_id_asesora` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_cliente, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_id_asesora'];
                }
                
            }
        }
        return false;
    }
    

    public function get_visitas_comerciales_id($id)
    {
        $sql = "SELECT * FROM visitas_clientes WHERE id = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }
        }
        return false;
    }


    public function editar_visitas_comerciales($inicio, $fin, $id){
        $sql = "UPDATE `visitas_clientes` SET  `start`=:inicio,`end`=:fin WHERE `id` = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Asignando Datos ARRAY => SQL.
            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
    }


    public function editar_visitas_comercialestodo($id,$id_tipo_visita,$status, $id_cliente, $id_obra,  $obs_visit, $id_asesora_comercial,  $inicio, $fin){
        $sql = "UPDATE `visitas_clientes` SET id_comercial = :id_comercial,   `id_tipo_visita`= :id_tipo_visita,`tipo_visita`= :tipo_visita,`id_cliente`= :id_cliente,`nombre_cliente`=:nombre_cliente,`id_obra`=:id_obra,`nombre_obra`= :nombre_obra,`observaciones`= :obs,`start`= :inicio,`end`= :fin WHERE `id` = :id;";

        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $nombre_tipo_visita = SELF::get_nombre_tipo_visita($this->con,$id_tipo_visita);
        $nombre_cliente = SELF::get_nombre_cliente($this->con,$id_cliente);
        $nombre_obra = SELF::get_nombre_tipo_visita($this->con,$id_obra);
        
        $stmt->bindParam(':id_comercial', $id_asesora_comercial, PDO::PARAM_INT);
        //$stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_visita', $id_tipo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_visita', $nombre_tipo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':obs', $obs_visit, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Asignando Datos ARRAY => SQL.
            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
 

    }

    public function crear_visitas_comerciales($asesora_comercial, $id_objetivo_visita,$id_cliente, $id_obra,$obs_visit, $inicio, $fin){
        
        $sql = "INSERT INTO `visitas_clientes`( id_comercial, `id_tipo_visita`,`status` ,  `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones`,`start`, `end`, fecha) VALUES (:comercial, :id_tipo_visita, :status ,:tipo_visita, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :obs, :inicio, :fin, :fecha)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        $nombre_tipo_visita = SELF::get_nombre_tipo_visita($this->con,$id_objetivo_visita);
        $nombre_cliente = SELF::get_nombre_cliente($this->con,$id_cliente);
        $nombre_obra = SELF::get_nombre_tipo_visita($this->con,$id_obra);
        $status = 4;
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':comercial', $asesora_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_visita', $id_objetivo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_visita', $nombre_tipo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':obs', $obs_visit, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public static function get_nombre_tipo_visita($con, $id)
    {
        $id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_visitas_clientes` WHERE `id` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
    
    }
    

    

    public static function get_nombre_cliente($con, $id)
    {
        $id = $id;
        $sql = "SELECT `ct1_IdTerceros`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }


    public  static function get_nombre_obra($con, $id)
    {
        $id = $id;
        $sql = "SELECT `ct5_IdObras`, `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct5_NombreObra'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }



/**
 * CARGAR VISITAS COMERCIALES 
 */
public function get_visitas_comerciales()
    {
        $sql = "SELECT * FROM visitas_clientes";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['objetivo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }



    public function get_visitas_comerciales_for_comercial($id_comercial)
    {
        $sql = "SELECT * FROM `visitas_clientes` WHERE `id_comercial` = :id_comercial";
        
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_comercial', $id_comercial, PDO::PARAM_INT);

        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['tipo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }

    public function get_nombre_asesora_comercial_cliente($id_cliente)
    {
        $id = $id_cliente;
        $sql = "SELECT `ct1_id_asesora` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return SELF::get_nombre_asesora_comercial($this->con, $fila['ct1_id_asesora']);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }



    public  function get_nombre_tercero($id)
    {
        
        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_zona( $id)
    {
        
        $sql = "SELECT `id`, `nombre_comuna` FROM `comunas` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['nombre_comuna'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_municipio( $id)
    {
        
        $sql = "SELECT `id_municipio`, `municipio`  FROM `municipios` WHERE  id_municipio = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['municipio'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_departamento( $id)
    {
        
        $sql = "SELECT `id_departamento`, `departamento` FROM `departamentos` WHERE `id_departamento` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['departamento'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_resultado_visita( $id)
    {
        
        $sql = "SELECT `id`, `descripcion` FROM `resultado_vista` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_contacto( $id)
    {
        
        $sql = "SELECT `id`, `descripcion` FROM `contacto_cliente` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_tipo_plan_maestro( $id)
    {
        
        $sql = "SELECT `id`, `descripcion` FROM `tipo_plan_maestro` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_tipo_cliente( $id)
    {
        
        $sql = "SELECT  `descripcion` FROM `tipo_cliente` WHERE id_tipo_cliente = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }


    public  function get_nombre_objetivo_visita( $id)
    {
        
        $sql = "SELECT  `descripcion` FROM `tipo_visitas_clientes` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }



    public  function get_nombre_asesora_comercial2( $id_asesora_comercial)
    {
        
        $sql = "SELECT  `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id_asesora_comercial, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public static function get_nombre_asesora_comercial($con, $id_asesora_comercial)
    {
        
        $sql = "SELECT  `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id_asesora_comercial, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }


    public function get_visitas_comerciales_for_comercial2($id_comercial)
    {
        $sql = "SELECT `id`, `status`, `fecha`, `id_comercial`, `id_tipo_visita`, `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones`, `start`, `end` FROM `visitas_clientes`  INNER JOIN ct1_terceros ON visitas_clientes.`id_cliente` = ct1_terceros.ct1_IdTerceros WHERE ct1_terceros.ct1_id_asesora =  :id_comercial";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_comercial', $id_comercial, PDO::PARAM_INT);

        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['tipo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }

} // fin de la clase





?>