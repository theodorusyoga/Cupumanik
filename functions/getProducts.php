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
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description, 
			A.stock as stock, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid';
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['prodid'];
			$single->title = $item ['title'];
			$single->imageurl = $item ['image'];
			$single->description = $item ['description'];
			$single->stock = $item['stock'];
			$single->catid = $item['categoryid'];
			$single->category = $item['categoryname'];
			array_push ( $res, $single );
		}
	}

	/* foreach ( $res as $item ) {
		$strresult .= $item->title;
		} */
	return $res;
}

$products = getProducts();
$result = '<table class="table table-hover">
							<tr>
								<th>No.</th>
								<th>Nama Produk</th>
								<th>Kategori</th>
								<th>Stok Tersedia</th>
								<th colspan="2">&nbsp;</th>
							</tr>';
$itemindex = 1;
foreach ($products as $product) {
	$result .= '<tr>';
	$result .= '<td>' . $itemindex .'</td>';
	$result .= '<td>' . $product->title . '</td>';
	$result .= '<td>' . $product->category . '</td>';
	$result .= '<td>' . $product->stock . '</td>';
	$result .= '<td><button type="button" class="btn">Detail</btn></td>';
	$result .= "<td><button onclick=\"removeProduct(" . $product->id . ",'" .
			 $product->title . "')\" class=\"btn btn-danger removeprod\">X</btn></td>";
	$result .= '</tr>';
	$itemindex++;
}
$result .= '</table>';
echo $result;
return;
?>