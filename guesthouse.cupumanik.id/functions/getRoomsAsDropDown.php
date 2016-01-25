<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
$rooms = getRooms ();
$result = '';
$index = 1;
foreach ( $rooms as $room ) {
	$result .= '<option value="' . $room->roomid .'">' . $room->roomname	 .'</option>';
}
echo $result;
return;
function getRooms() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM gh_roomslist ORDER BY `roomname`';
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
			array_push ( $res, $single );
		}
	}
	return $res;
}

?>