<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if (isset ( $_POST ['id'] )) {
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description,
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.id = ' . $_POST['id'];
	$result = $conn->query ( $query );
	$strresult = '';
	/* $res = array(); */
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['prodid'];
			$single->title = $item ['title'];
			$single->imageurl = $item ['image'];
			$single->description = $item ['description'];
			$single->stock = $item ['stock'];
			$single->catid = $item ['categoryid'];
			$single->price = $item ['price'];
			$single->category = $item ['categoryname'];
			/* array_push($res, $single); */
			$strresult = json_encode ( $single );
			echo $strresult;
			return;
		}
	}
}

?>