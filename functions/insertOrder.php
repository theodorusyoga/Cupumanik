<?php
include ('/dbConnection.php');

if (isset ( $_POST ['jsondata'] )) {
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$jsondata = $_POST ['jsondata'];
	try {
		$data = json_decode ( $jsondata );
		if (count ( $data ) > 0) {
			$custname = $data->name;
			$email = $data->email;
			$address = $data->address;
			$phone = $data->phone;
			$info = $data->info;
			$products = $data->products;
			$date = date ( 'Y-m-d H:i:s' );
			$isprocessed = 0;
			$query = "INSERT INTO `orders`(`name`, `address`, `phone`, `email`, `information`, `date`, `isprocessed`) 
				VALUES ('" . $custname . "', '" . $address . "', '" . $phone . "', '" . $email . "', 
						'" . $info . "', '" . $date . "', " . (string) $isprocessed .")";
			$res = $conn->query($query);
			if($res === true){
				$orderid = $conn->insert_id;
				$insertprodsuccess = true;
				$totalprice = 0;
				if (count ( $products ) > 0) {
					foreach ( $products as $product ) {
						$id = ( int ) $product->id;
						$amount = ( int ) $product->amount;
						$prodquery = "INSERT INTO `orderdetails`(`productid`, `amount`, `associatedorder`)
							VALUES(" . (string) $id .", " . (string)$amount . ", " . $orderid . ")";
						$prodres = $conn->query($prodquery);
						if($prodres === false){
							$insertprodsuccess = false;
						}
						else{
							$selectquery = 'SELECT price FROM `products` WHERE id = ' . (string) $id;
							$selectres = $conn->query($selectquery);
							if($selectres->num_rows > 0){
								while($item = $selectres->fetch_assoc()){
									$price = (int)$item['price'];
									$totalprice += (int)($price * $amount);
									break;
								}
							}
						}
					}
				}
				
				$rand = rand(11,99);
				$totalprice += $rand;
				
				if($insertprodsuccess === true){
					$randomquery = 'INSERT INTO `randomnumbers`(`associatedorder`, `randomnumber`) 
							VALUES(' . (string)$orderid .', ' . (string) $rand .')';
					$randomres = $conn->query($randomquery);
					if($randomres === true){
						echo $totalprice;
						return;
					}
					else {
						echo false;
						return;
					}
				}
			}
			else{
				echo false;
				return;
			}
		} else {
			echo false;
			return;
		}
	} catch ( Exception $e ) {
		echo false;
		return;
	}
}

?>