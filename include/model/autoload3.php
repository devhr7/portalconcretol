<?php
function autoload3($clase){
    include "../../../include/model/tablas/".$clase.".php";
}
spl_autoload_register('autoload3');

