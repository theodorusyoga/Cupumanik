<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if(isset($_POST['catid']) && isset($_POST['categoryname'])){
	$id = (int) $_POST['catid'];
	$catname = $_POST['categoryname'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "UPDATE `categories` SET `categoryname`='" . $catname . "' WHERE `id`=" . ( string ) $id;
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