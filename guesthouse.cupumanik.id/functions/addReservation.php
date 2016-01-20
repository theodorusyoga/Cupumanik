<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if (isset ( $_POST ['startdate'] ) && isset($_POST['enddate']) && isset($_POST['fullname']) 
		&& isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['email'])
		&& isset($_POST['information'])) {
	$startdate = $_POST ['startdate'];
	$enddate = $_POST['enddate'];
	$fullname = $_POST['fullname'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$information = $_POST['information'];
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