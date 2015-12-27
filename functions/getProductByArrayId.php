<?php
include('/dbConnection.php');

if (isset ( $_POST ['ids'] )) {
$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
if ($conn->connect_error) {
	die ( "Connection failed " . $conn->connect_error );
}

$ids = json_decode($_POST ['ids']);
//$strresult = '';
$res = array();
foreach ($ids as $id)
{
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description,
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.id = ' . $id;
	$result = $conn->query ( $query );
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
			array_push($res, $single);
		}
	}
}
echo json_encode($res);
return;
}
?>