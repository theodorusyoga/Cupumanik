<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);

if (isset ( $_POST ['id'] )) {
	$id = ( int ) $_POST ['id'];
	
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( 'Connection failed' . $conn->connect_error );
	}
	$query = 'SELECT * FROM `gh_allorderswithcategory` WHERE name IS NOT NULL AND orderid = ' . ( string ) $id; // orders with name only
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->orderid = $item ['orderid'];
			$single->roomid = $item ['roomid'];
			$single->categoryid = $item ['categoryid'];
			$single->categoryname = $item ['categoryname'];
			$single->roomname = $item ['roomname'];
			$single->name = $item ['name'];
			$single->startdate = $item ['startdate'];
			$single->enddate = $item ['enddate'];
			$single->address = $item ['address'];
			$single->phone = $item ['phone'];
			$single->email = $item ['email'];
			$single->info = $item ['information'];
			$single->isapproved = $item ['isapproved'];
			$single->reservationdate = $item ['tanggalpesan'];
			
			echo json_encode ( $single );
			return;
		}
	}
	return;
}

?>