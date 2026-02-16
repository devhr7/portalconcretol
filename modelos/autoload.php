<?php
spl_autoload_register(function($clase){
    $ruta1 = "modelos/".$clase . ".php";
    if(is_readable($ruta1)){
        require_once $ruta1;
    }
    $ruta2 = "../modelos/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta2)){
        require_once $ruta2;
    }
    $ruta3 = "../../modelos/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta3)){
        require_once $ruta3;
    }
    $ruta4 = "../../../modelos/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta4)){
        require_once $ruta4;
    }
    $ruta5 = "../../../../modelos/" . str_replace("\\", "/", $clase) . ".php";
    if(is_readable($ruta5)){
        require_once $ruta5;
    }
});



    
    
