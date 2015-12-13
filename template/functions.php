<?php
$servername = 'localhost';
$dbname = 'cupumanik';
$dbuser = 'theodorus';
$dbpass = 'pass@word1';
function getProducts() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM products';
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->title = $item ['title'];
			$single->imageurl = $item ['image'];
			$single->description = $item ['description'];
			array_push ( $res, $single );
		}
	}
	
	foreach ( $res as $item ) {
		$strresult .= $item->title;
	}
	return $strresult;
}
