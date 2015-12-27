<?php
include('/dbConnection.php');

if (isset ( $_POST ['catname'] )) {
	$categoryname = $_POST ['catname'];
	$link = '/category/' . str_replace ( ' ', '', $categoryname );
	/* DATABASE */
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "INSERT INTO `categories`(`categoryname`, `uniquelink`)
				VALUES ('" . $categoryname . "', '" . $link . "')";
	$conn->query ( $query );
	if ($conn === false) {
		echo false;
		return;
	} else {
		echo true;
		return;
	}
}

?>