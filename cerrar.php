<?php
session_start();
header('HTTP/1.0 404 Not Found');

@session_unset();

session_destroy();


header('location: index.php');
exit();
?>
