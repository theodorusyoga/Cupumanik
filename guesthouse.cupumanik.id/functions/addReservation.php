<?php
function check_date_range($start, $end, $requested) {
	$start_time = strtotime ( $start );
	$end_time = strtotime ( $end );
	$requested_time = strtotime ( $requested );
	return (($requested_time >= $start_time) && ($requested_time <= $end_time));
}
function array_grouping($array) {
	$groups = array ();
	$index = 0;
	foreach ( $array as $value ) {
		$roomid = $value->roomid;
		if (isset ( $groups [$roomid] )) {
			$groups [$roomid] [] = $value;
		} else {
			$groups [$roomid] = array (
					$value 
			);
		}
		$index ++;
	}
	return $groups;
}

$path = $_SERVER ['DOCUMENT_ROOT'] . '/functions/dbConnection.php';
$mailpath = $_SERVER ['DOCUMENT_ROOT'] . '/functions/class.phpmailer.php';
include ($path);
include ($mailpath);
if (isset ( $_POST ['startdate'] ) && isset ( $_POST ['enddate'] ) && isset ( $_POST ['fullname'] ) && isset ( $_POST ['address'] ) && isset ( $_POST ['phone'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['information'] ) && isset ( $_POST ['selectedCategoryId'] )) {
	$startdate = $_POST ['startdate'];
	$enddate = $_POST ['enddate'];
	$fullname = $_POST ['fullname'];
	$address = $_POST ['address'];
	$phone = $_POST ['phone'];
	$email = $_POST ['email'];
	$information = $_POST ['information'];
	$selectedcat = ( int ) $_POST ['selectedCategoryId'];
	/* DATABASE */
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$selectquery = "SELECT * FROM `gh_allorderswithcategory` WHERE categoryid = " . ( string ) $selectedcat . " ORDER BY startdate DESC, enddate DESC";
	$resultselect = $conn->query ( $selectquery );
	$selectres = array ();
	if ($resultselect->num_rows > 0) {
		while ( $item = $resultselect->fetch_assoc () ) {
			$single = new stdClass ();
			$single->orderid = $item ['orderid'];
			$single->startdate = $item ['startdate'];
			$single->enddate = $item ['enddate'];
			$single->roomid = $item ['roomid'];
			array_push ( $selectres, $single );
		}
	} else {
		echo false;
		return;
	}
	
	$grouped = array_grouping ( $selectres );
	$selectedRoomId = 0;
	foreach ( $grouped as $group ) {
		$accepted = true;
		for($i = 0; $i < count ( $group ); $i ++) {
			$currentorder = $group [$i];
			$currentstart = $currentorder->startdate;
			$currentend = $currentorder->enddate;
			if (check_date_range ( $currentstart, $currentend, $startdate ) || check_date_range ( $currentstart, $currentend, $enddate ) || check_date_range ( $startdate, $enddate, $currentstart ) || check_date_range ( $startdate, $enddate, $currentend )) /* check start and end date */{
				$accepted = false;
				break;
			}
		}
		
		if ($accepted === true) {
			$selectedRoomId = $group [0]->roomid;
			break;
		}
	}
	
	if ($selectedRoomId != 0) {
		$query = "INSERT INTO `orders`(`startdate`, `enddate`, `name`, `address`, `phone`, `email`, `information`, `roomid`, `isapproved`, `tanggalpesan`) 
				VALUES ('" . $startdate . "','" . $enddate . "','" . $fullname . "','" . $address . "'
						,'" . $phone . "','" . $email . "','" . $information . "'," . $selectedRoomId . ",0, '" . date ( 'Y-m-d H:i:s' ) . "')";
		$result = $conn->query ( $query );
		if ($result === false) {
			echo false;
			return;
		} else {
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
			$mail->Subject = "Reservasi Baru di Cupumanik Guest House";
			$mail->AddAddress ( "info@cupumanik.id", "Cupumanik Informasi" );
			$body = '<p>Kepada Yth. <strong>Cupumanik Administrator</strong>,</p>';
			$body .= '<p>Terdapat reservasi baru pada waktu: ' . date ( 'd F Y H:i:s' ) . '. Detail reservasi ditampilkan berikut ini:</p>';
			$body .= '<ul>';
			$tipepesan = '';
			if ($selectedcat == 1)
				$tipepesan = 'Per Rumah';
			else
				$tipepesan = 'Per Kamar';
			$body .= '<li>Jenis Pemesanan: ' . $tipepesan . '</li>';
			$body .= '<li>Nama Pemesan: ' . $fullname . '</li>';
			$body .= '<li>Alamat: ' . $address . '</li>';
			$body .= '<li>No. Telepon: ' . $phone . '</li>';
			$body .= '<li>Email: ' . $email . '</li>';
			$body .= '<li>Keterangan: ' . $information . '</li>';
			$checkin = strtotime ( $startdate );
			$checkout = strtotime ( $enddate );
			$body .= '<li>Tanggal Check-In: ' . date ( 'd F Y H:i:s', $checkin ) . '</li>';
			$body .= '<li>Tanggal Check-Out: ' . date ( 'd F Y H:i:s', $checkout ) . '</li>';
			$body .= '</ul>';
			$body .= '<p>Silakan membuka Cupumanik Guest House Administrator melalui tautan ini: <a href="http://guesthouse.cupumanik.id/admin">http://guesthouse.cupumanik.id/admin</a> untuk melihat detail dan melakukan persetujuan reservasi.</p>';
			$body .= '<br/><p>Salam Hangat,</p>';
			$body .= '<br/><br/>';
			$body .= '<strong>Cupumanik Automatic Email<strong>';
			$mail->MsgHTML ( $body );
			$mail->Send ();
			echo true;
			return;
		}
	} else {
		echo false;
		return;
	}
}

?>