<?php
    $xml = simplexml_load_file("FV3-0000006352.xml");
    echo $xml->pelicula[0]->argumento;
    print_r($xml);
?>