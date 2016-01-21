<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if(isset($_POST['roomname']) && isset($_POST['description']) && isset($_POST['categoryid'])){
	$roomname = $_POST['roomname'];
	$description = $_POST['description'];
	$categoryid = (int) $_POST['categoryid'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = '';
	if(isset($_POST['roomid'])){
		$query = "UPDATE `rooms` SET 
		`roomname`='" . $roomname ."',`description`='" . $description ."',
		`categoryid`=" . $categoryid ." WHERE `roomid` = " . (string)$_POST['roomid'];
	}
	else{
		$query = "INSERT INTO `rooms`(`roomname`, `description`, `categoryid`)
			VALUES ('" . $roomname ."','" . $description ."'," . (string) $categoryid .")";
	}
	
	$res = $conn->query ( $query );
	if($res === false)
		echo false;
	else echo true;
	return;
}
else {
	echo false;
	return;
}

?>