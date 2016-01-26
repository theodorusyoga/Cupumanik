<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);
if (isset ( $_POST ['orderid'] )) {
	$orderid = ( int ) $_POST ['orderid'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'DELETE FROM `orders` WHERE `id` = ' . ( string ) $orderid . ' LIMIT 1';
	$result = $conn->query ( $query );
	if ($result === false)
		echo false;
	else
		echo true;
	return;
}

?>