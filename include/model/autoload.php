<?php
function autoload($clase){
    include "../include/model/tablas/".$clase.".php";
}
spl_autoload_register('autoload');

