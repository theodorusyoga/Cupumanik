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
function getAvailableRooms($startdate, $enddate, $orderid, $selectedcat) {
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
			$single->roomname = $item ['roomname'];
			array_push ( $selectres, $single );
		}
	} else {
		echo false;
		return;
	}
	
	$res = array ();
	$grouped = array_grouping ( $selectres );
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
			$single = new stdClass ();
			$single->roomid = $group [0]->roomid;
			$single->roomname = $group [0]->roomname;
			array_push ( $res, $single );
		}
	}
	return $res;
}

$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);
if (isset ( $_POST ['startdate'] ) && isset ( $_POST ['enddate'] ) && isset ( $_POST ['selectedcat'] ) && isset ( $_POST ['orderid'] )) {
	$startdate = $_POST ['startdate'];
	$enddate = $_POST ['enddate'];
	$orderid = ( int ) $_POST ['orderid'];
	$selectedcat = ( int ) $_POST ['selectedcat']; // rumah = 1, kamar = 2
	
	$rooms = getAvailableRooms ( $startdate, $enddate, $orderid, $selectedcat );
	$result = '';
	foreach ( $rooms as $room ) {
		$result .= '<option value="' . $room->roomid . '">' . $room->roomname . '</option>';
	}
	
	echo $result;
	return;
}

?>