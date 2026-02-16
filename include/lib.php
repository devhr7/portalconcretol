<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib
 *
 * @author hr
 */
class lib {
    //put your code here
    
    function HR_Crypt($valor, $encode_decode) {
        $secret_key = 'my_195501421';
        $secret_iv = 'my_195501421';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($encode_decode == 1) {
            $this->hashnum = base64_encode(openssl_encrypt($valor, $encrypt_method, $key, 0, $iv));
        }
        if ($encode_decode == 2) {
            $this->hashnum = openssl_decrypt(base64_decode($valor), $encrypt_method, $key, 0, $iv);
        }

        return $this->hashnum;
    }




    function permisos($rol_user, $array_roles) {  
        if(in_array($rol_user,$array_roles)){
            $permisos = "";
            
        }else{
            $permisos = " disabled='true'";
        }
        return $permisos;
        
    }
    
    
      function estado_remi($estado) {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Completado </small>';
                break;
              case 3:
                $state = '<small class="badge badge-warning"> Pendiente </small>';
                break;
            case 4:
                $state = '<small class="badge badge-info"> Completado </small>';
                break;

          
        }
        return $state;
    }
    
     function estado($estado) {
        $this->estado = $estado;

        switch ($estado) {
            case 1:
                $state = '<small class="badge badge-success"> Habilitado </small>';
                break;
              case 3:
                $state = '<small class="badge badge-warning"> Pendiente </small>';
                break;
            case 4:
                $state = '<small class="badge badge-info"> Eliminado </small>';
                break;

          
        }
        return $state;
    }

    
}
