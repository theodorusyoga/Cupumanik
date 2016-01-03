<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);

if (isset ( $_POST ['id'] )) {
	$idint = ( int ) $_POST ['id'];
	$conn = new mysqli ( $servername, $dbuser, $dbpass, $dbname );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'DELETE FROM products WHERE id=' . ( string ) $idint . ' LIMIT 1';
	$result = $conn->query ( $query );
	echo true;
} else
	echo false;
?>