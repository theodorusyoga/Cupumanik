<?php
include('/dbConnection.php');

if(isset($_POST['catid'])){
	$id = (int) $_POST['catid'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "DELETE FROM `categories` WHERE `id`=" . ( string ) $id;
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