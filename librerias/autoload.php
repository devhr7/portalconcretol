<?php
spl_autoload_register(function($clase){
    $ruta1 = "librerias/" .$clase . ".php";
    if(is_readable($ruta1)){
        require_once $ruta1;
    }
    $ruta2 = "../librerias/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta2)){
        require_once $ruta2;
    }
    $ruta3 = "../../librerias/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta3)){
        require_once $ruta3;
    }
    $ruta4 = "../../../librerias/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta4)){
        require_once $ruta4;
    }
    $ruta5 = "../../../../librerias/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta5)){
        require_once $ruta5;
    }
    $ruta6 = "../../../../../librerias/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta6)){
        require_once $ruta6;
    }
});
