<?php
$letra = ['a', 'b', 'c'];


$rst = [222, 3333, 444];


$x = 0;
foreach ($rst as $key) {
    echo $letra[$x];
    echo $key;
    echo "<br>";
    $x++;
}
