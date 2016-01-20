<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
$rooms = getRooms ();
$result = '<table class="table table-hover">
								<tr>
									<th>No.</th>
									<th>Nama Kamar/Rumah</th>
									<th>Deskripsi</th>
									<th>Kategori</th>
									<th>Total Pemesanan</th>
									<th colspan="2">&nbsp;</th>
								</tr>';
$index = 1;
foreach ( $rooms as $room ) {
	$result .= '<tr>';
	$result .= '<td>' . ( string ) $index . '</td>';
	$result .= '<td>' . ( string ) $room->roomname . '</td>';
	$result .= '<td>' . ( string ) $room->description . '</td>';
	$result .= '<td>' . ( string ) $room->categoryname . '</td>';
	$result .= '<td>' . ( string ) $room->ordercount . '</td>';
	$result .= '<td><button class="btn">Ubah</button>';
	$result .= '<button class="btn btn-danger">X</button></td>';
	$result .= '</tr>';
	$index ++;
}
$result .= '</table>';
echo $result;
return;
function getRooms() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM gh_roomslist';
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
			$single->ordercount = (int) $item ['orderid'];
			array_push ( $res, $single );
		}
	}
	return $res;
}

?>