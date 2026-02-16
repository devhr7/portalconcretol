<?php

require_once 'include/conexionPDO.php';
require_once 'include/reset_pass.php';
require_once 'vendor/autoload.php';

$reset_pass = new reset_pass();



 $token = $reset_pass->generate_token();

 
  $date = date("m-d-Y H:i:s");
  $date_int = strtotime($date);
  $date_dia = date("d", $date_int );
  
 \FB::log($date);
 \FB::log($date_dia);
  
  
  
 
 var_dump($token);