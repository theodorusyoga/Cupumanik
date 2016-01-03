<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if(isset($_POST['orderid']) && isset($_POST['isprocessed'])){
	$id = (int) $_POST['orderid'];
	$isprocessed = (int) $_POST['isprocessed'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "UPDATE `orders` SET `isprocessed`=" . (string) $isprocessed . " WHERE `id`=" . ( string ) $id;
	$result = $conn->query ( $query );
	if($result === false){
		echo false;
		return;
	}
	else{
		echo true;
		return;
	}
}

?>