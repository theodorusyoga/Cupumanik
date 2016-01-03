<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
function getProductsFiltered($title, $sort) {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description, 
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.title LIKE '%" . $title . "%'";
	$orderby = '';
	switch ($sort) {
		case ('A-Z') :
			$orderby = 'ORDER BY A.title';
			break;
		case ('Z-A') :
			$orderby = 'ORDER BY A.title DESC';
			break;
		case ('tinggi-rendah') :
			$orderby = 'ORDER BY A.price DESC';
			break;
		case ('rendah-tinggi') :
			$orderby = 'ORDER BY A.price';
			break;
		case ('banyak-sedikit') :
			$orderby = 'ORDER BY A.stock DESC';
			break;
		case ('sedikit-banyak') :
			$orderby = 'ORDER BY A.stock';
			break;
		default:
			$orderby = 'AND A.categoryid = ' . $sort;
			break;
	}
	
	$query .= ' ' . $orderby;
	
	$result = $conn->query ( $query );
	$strresult = '';
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
			array_push ( $res, $single );
		}
	}
	
	/*
	 * foreach ( $res as $item ) {
	 * $strresult .= $item->title;
	 * }
	 */
	return $res;
}

if(isset($_POST['title']) && isset($_POST['sort'])){
	$title =  $_POST['title'];
	$sort = $_POST['sort'];
	$products = getProductsFiltered ($title, $sort);
	$result = '<table class="table table-hover">
							<tr>
								<th>No.</th>
								<th>&nbsp;</th>
								<th>Nama Produk</th>
								<th>Kategori</th>
								<th>Harga Satuan</th>
								<th>Stok Tersedia</th>
								<th colspan="2">&nbsp;</th>
							</tr>';
	$itemindex = 1;
	if (count ( $products ) > 0) {
		foreach ( $products as $product ) {
			$result .= '<tr>';
			$result .= '<td>' . $itemindex . '</td>';
			$result .= '<td><img src="../../' . $product->imageurl . '" style="max-width: 100px;"/></td>';
			$result .= '<td>' . $product->title . '</td>';
			$result .= '<td>' . $product->category . '</td>';
			$result .= '<td>' . str_replace ( '+', '', money_format ( '%i', $product->price ) ) . '</td>';
			$result .= '<td>' . $product->stock . '</td>';
			$result .= "<td><button onclick=\"detailProduct(" . $product->id . ")\" class=\"btn\">Ubah/Detail</btn></td>";
			$result .= "<td><button onclick=\"removeProduct(" . $product->id . ",'" . $product->title . "')\" class=\"btn btn-danger removeprod\">X</btn></td>";
			$result .= '</tr>';
			$itemindex ++;
		}
	} else {
		$result .= '<tr><td colspan="6"><p class="alert alert-warning">Tidak ada data produk</p></td></tr>';
	}
	$result .= '</table>';
	echo $result;
	return;
}


?>