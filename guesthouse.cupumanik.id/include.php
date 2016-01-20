<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$function = $path . '/functions/functions.php';
$connection = $path . '/functions/dbConnection.php';
$rooturl = 'http://cupumanik-local.com';
include ($connection);
include ($function);

?>