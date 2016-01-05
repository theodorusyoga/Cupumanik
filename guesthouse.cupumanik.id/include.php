<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$function = $path . '/functions/functions.php';
$connection = $path . '/functions/dbConnection.php';
include ($connection);
include ($function);

?>