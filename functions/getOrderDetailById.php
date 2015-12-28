<?php
include('/dbConnection.php');

$res = array ();
$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
if ($conn->connect_error) {
	die ( "Connection failed " . $conn->connect_error );
}
$query = 'SELECT * FROM orders WHERE ';
$result = $conn->query ( $query );

?>