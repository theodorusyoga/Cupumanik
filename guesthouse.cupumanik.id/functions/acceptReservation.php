<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);
if (isset ( $_POST ['orderid'] ) && isset ( $_POST ['startdate'] ) && isset ( $_POST ['enddate'] ) && isset ( $_POST ['roomid'] )) {
	$orderid = ( int ) $_POST ['orderid'];
	$startdate = $_POST ['startdate'];
	$enddate = $_POST ['enddate'];
	$roomid = ( int ) $_POST ['roomid'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "UPDATE `orders` SET `isapproved` = 1, `startdate` = '" . $startdate . "', 
			`enddate` = '" . $enddate . "', `roomid` = " . $roomid . " WHERE `id` = " . ( string ) $orderid;
	
	$result = $conn->query ( $query );
	if ($result === false)
		echo false;
	else
		echo true;
	return;
}

?>