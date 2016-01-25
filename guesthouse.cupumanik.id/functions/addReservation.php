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

$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);
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
			if (check_date_range ( $currentstart, $currentend, $startdate ) || check_date_range ( $currentstart, $currentend, $enddate ) 
					|| check_date_range ( $startdate, $enddate, $currentstart ) || check_date_range ( $startdate, $enddate, $currentend )) /* check start and end date */{
				$accepted = false;
				break;
			}
		}
		
		if ($accepted === true) {
			$selectedRoomId = $group [0]->roomid;
			break;
		}
	}
	
	
	if($selectedRoomId != 0){
		$query = "INSERT INTO `orders`(`startdate`, `enddate`, `name`, `address`, `phone`, `email`, `information`, `roomid`, `isapproved`, `tanggalpesan`) 
				VALUES ('" . $startdate ."','" . $enddate ."','" . $fullname . "','" . $address ."'
						,'" . $phone ."','" . $email ."','" . $information . "'," . $selectedRoomId .",0, '" . date('Y-m-d H:i:s') ."')";
		$result = $conn->query ( $query );
		if ($result === false) {
			echo false;
			return;
		} else {
			echo true;
			return;
		}
	}
	else{
		echo false;
		return;
	}

}

?>