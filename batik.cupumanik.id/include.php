<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$function = $path . '/functions/functions.php';
$header = $path . '/header.php';
$footer = $path . '/footer.php';
$list = $path . '/product-list.php';
$connection = $path . '/functions/dbConnection.php';
$currenturl = 'http://batik.cupumanik-local.com';
$rooturl = 'http://cupumanik-local.com';
include ($connection);
include ($function);
include ($header);
include ($footer);
include ($list);

?>