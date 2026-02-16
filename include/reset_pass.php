<?php

class reset_pass extends conexionPDO {
   
     public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }
    
    
    
    function generate_token() {
        date_default_timezone_set('America/Bogota');
        $date = date("m-d-Y H:i:s");
        $tk_date = md5($date);
        
        
        
        $token = $tk_date;
        
        //token  = Fecha
        return $token;
        
    }
}
