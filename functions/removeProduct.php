<?php
$servername = 'localhost';
$dbname = 'cupumanik';
$dbuser = 'theodorus';
$dbpass = 'pass@word1';

if (isset ( $_POST ['id'] )) {
	$idint = ( int ) $_POST ['id'];
	$conn = new mysqli ( $servername, $dbuser, $dbpass, $dbname );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'DELETE FROM products WHERE id=' . ( string ) $idint . ' LIMIT 1';
	$result = $conn->query ( $query );
	return true;
} else
	return false;
?>