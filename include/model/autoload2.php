<?php

function autoload2($clase){
    include "../../include/model/tablas/".$clase.".php";
}
spl_autoload_register('autoload2');

