<?php
include('/dbConnection.php');

if(isset($_POST['id'])){
	$id = (int) $_POST['id'];
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM orders WHERE id = ' . (string) $id;
	$result = $conn->query ( $query );
	if($result->num_rows > 0){
		while($item = $result->fetch_assoc()){
			$single = new stdClass();
			$single->id = $item ['id'];
			$single->custname = $item ['name'];
			$single->address = $item ['address'];
			$single->phone = $item ['phone'];
			$single->email = $item ['email'];
			$single->information = $item ['information'];
			$single->date = ( string ) $item ['date'];
			$single->isprocessed = ( boolean ) $item ['isprocessed'];
			$single->products = array();
			$queryproduct = 'SELECT a.id as id, a.productid as productid, a.amount as amount, a.associatedorder as associatedorder, b.title as productname, b.price as price, b.image as image, b.stock as stock 
					FROM orderdetails a JOIN products b on b.id = a.productid 
					WHERE a.associatedorder = ' . (string) $single->id;
			$resproducts = $conn->query($queryproduct);
			if($resproducts->num_rows > 0){
				while($prod = $resproducts->fetch_assoc()){
					$product = new stdClass();
					$product->detailid = $prod['id'];
					$product->amount = $prod['amount'];
					$product->productname = $prod['productname'];
					$product->price = $prod['price'];
					$product->imageurl = $prod['image'];
					$product->stock = $prod['stock'];
					array_push($single->products, $product);
				}
			}
			$randomquery = 'SELECT * FROM `randomnumbers` WHERE `associatedorder` = ' . $single->id;
			$randomres = $conn->query($randomquery);
			if($randomres->num_rows > 0){
				while($rand = $randomres->fetch_assoc()){
					$single->randomnum = (int)$rand['randomnumber'];
				}
			}
			$jsonstr = json_encode($single);
			echo $jsonstr;
			return;
		}
		echo false;
		return;
	}
	else
	{
		echo false;
		return;
	}
}


?>