<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);
if(isset($_POST['roomid'])){
	$roomid = (int) $_POST['roomid'];
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM gh_roomslist WHERE `roomid` = ' . (string) $roomid;
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->roomid = $item ['roomid'];
			$single->roomname = $item ['roomname'];
			$single->description = $item ['description'];
			$single->categoryname = $item ['categoryname'];
			$single->categoryid = $item ['categoryid'];
			$single->ordercount = $item ['ordercount'];
			echo json_encode($single);
			return;
		}
	}
}


?>