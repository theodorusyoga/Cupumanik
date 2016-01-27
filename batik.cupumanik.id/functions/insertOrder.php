<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/functions/dbConnection.php';
$mailpath = $_SERVER ['DOCUMENT_ROOT'] . '/functions/class.phpmailer.php';
include ($path);
include ($mailpath);
setlocale(LC_MONETARY, 'id_ID');

ob_start();
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
						'" . $info . "', '" . $date . "', " . ( string ) $isprocessed . ")";
			$res = $conn->query ( $query );
			$totalprice = 0;
			if ($res === true) {
				$orderid = $conn->insert_id;
				$insertprodsuccess = true;
				if (count ( $products ) > 0) {
					foreach ( $products as $product ) {
						$id = ( int ) $product->id;
						$amount = ( int ) $product->amount;
						$prodquery = "INSERT INTO `orderdetails`(`productid`, `amount`, `associatedorder`)
							VALUES(" . ( string ) $id . ", " . ( string ) $amount . ", " . $orderid . ")";
						$prodres = $conn->query ( $prodquery );
						if ($prodres === false) {
							$insertprodsuccess = false;
						} else {
							$selectquery = 'SELECT price FROM `products` WHERE id = ' . ( string ) $id;
							$selectres = $conn->query ( $selectquery );
							if ($selectres->num_rows > 0) {
								while ( $item = $selectres->fetch_assoc () ) {
									$price = ( int ) $item ['price'];
									$totalprice += ( int ) ($price * $amount);
									break;
								}
							}
						}
					}
				}
				
				$rand = rand ( 11, 99 );
				$totalprice += $rand;
				
				if ($insertprodsuccess === true) {
					$randomquery = 'INSERT INTO `randomnumbers`(`associatedorder`, `randomnumber`) 
							VALUES(' . ( string ) $orderid . ', ' . ( string ) $rand . ')';
					$randomres = $conn->query ( $randomquery );
					if ($randomres === true) {
						$mail = new PHPMailer ();
						$mail->IsSMTP ();
						$mail->SMTPSecure = 'ssl';
						$mail->Host = "cupumanik.id";
						$mail->SMTPDebug = 2;
						$mail->Port = 465;
						$mail->SMTPAuth = true;
						$mail->Username = 'autoreply@cupumanik.id';
						$mail->Password = 'pass@word1';
						$mail->SetFrom ( "autoreply@cupumanik.id", "Cupumanik Automatic Email" );
						$mail->Subject = "Pemesanan Baru di Cupumanik Batik";
						$mail->AddAddress ( "info@cupumanik.id", "Cupumanik Informasi" );
						$body = '<p>Kepada Yth. <strong>Cupumanik Administrator</strong>,</p>';
						$body .= '<p>Terdapat pemesanan baru untuk Cupumanik Batik pada waktu: ' . date ( 'd F Y H:i:s' ) . '. Detail reservasi ditampilkan berikut ini:</p>';
						$body .= '<ul>';
						$body .= '<li>Nama Pemesan: ' . $custname . '</li>';
						$body .= '<li>Alamat: ' . $address . '</li>';
						$body .= '<li>No. Telepon: ' . $phone . '</li>';
						$body .= '<li>Email: ' . $email . '</li>';
						$body .= '<li>Keterangan: ' . $info . '</li>';
						$body .= '<li>Total Pembelian: ' . money_format ( '%i', $totalprice ) . '</li>';
						$body .= '</ul>';
						$body .= '<p>Silakan membuka Cupumanik Batik Administrator melalui tautan ini: <a href="http://batik.cupumanik.id/admin">http://batik.cupumanik.id/admin</a> untuk melihat detail pemesanan.</p>';
						$body .= '<br/><p>Salam Hangat,</p>';
						$body .= '<br/><br/>';
						$body .= '<strong>Cupumanik Automatic Email<strong>';
						$mail->MsgHTML ( $body );
						$mail->Send ();
						ob_end_clean();
						echo $totalprice;
						return;
					} else {
						echo false;
						return;
					}
				}
			} else {
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