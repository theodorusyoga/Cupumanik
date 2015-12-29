<?php
include ('/dbConnection.php');

if (isset ( $_POST ['id'] )) {
	$id = ( int ) $_POST ['id'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	
	$querydetails = 'DELETE FROM `orderdetails` WHERE `associatedorder` = ' . ( string ) $id;
	$detailsres = $conn->query($querydetails);
	if($detailsres === true){
		$query = "DELETE FROM `orders` WHERE `id`=" . ( string ) $id;
		$result = $conn->query ( $query );
		if ($result === true) {
			echo true;
			return;
		} else {
			echo false;
			return;
		}
	}
	else {
		echo false;
		return;
	}
}

?>