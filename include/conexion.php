<?php

  
class conexion{
    
    var $port = "3306";
    var $host = 'localhost';
    var $user = 'concr_adminconcretol';
    var $pass = 'Nirvana1310';
    var $db = 'concr_bdportalconcretol';
    var $myconn = null;
    
    
    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db,$this->port);
        if (!$con) {
            die('Could not connect to database!');
        } else {
            $this->myconn = $con;
            //echo 'Connection established!';
        }
        return $this->myconn;
    }

    function close() {
       mysqli_close($this->myconn);
    }
}




?>