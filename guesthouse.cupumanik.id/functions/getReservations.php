<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include ($path);

if (isset ( $_POST ['query'] ) && isset($_POST['search'])) {
	$query = $_POST ['query'];
	$search = $_POST['search'];
	$reservations = getReservations ( $query, $search);
	$result = '<table class="table table-hover">
								<tr>
									<th>No.</th>
									<th>Nama</th>
									<th>Tanggal Pemesanan</th>
									<th>Tanggal Check-In</th>
									<th>Tanggal Check-Out</th>
									<th>Status</th>
									<th colspan="2">&nbsp;</th>
								</tr>';
	$index = 1;
	foreach ( $reservations as $reservation ) {
		$result .= '<tr>';
		$result .= '<td>' . $index . '</td>';
		$result .= '<td>' . $reservation->name . '</td>';
		$date = strtotime ( $reservation->reservationdate );
		$startdate = strtotime ( $reservation->startdate );
		$enddate = strtotime ( $reservation->enddate );
		$result .= '<td>' . date ( 'd F Y G:i', $date ) . '</td>';
		$result .= '<td>' . date ( 'd F Y G:i', $startdate ) . '</td>';
		$result .= '<td>' . date ( 'd F Y G:i', $enddate ) . '</td>';
		if ($reservation->isapproved == 1) {
			$result .= '<td><span class="glyphicon glyphicon-ok">&nbsp;</span><small>Diterima</small></td>';
			$result .= "<td><button onclick=\"detailReservasi('" . $reservation->orderid . "')\" class=\"btn btn-success\">Detail</button></td>";
		} else if ($reservation->isapproved == 0) {
			$result .= '<td><span class="glyphicon glyphicon-time">&nbsp;</span><small>Pending</small></td>';
			$result .= "<td><button onclick=\"detailReservasi('" . $reservation->orderid . "')\" class=\"btn btn-primary\">Terima</button></td>";
		}
		$result .= "<td><button onclick=\"hapusReservasi('" . $reservation->orderid . "')\" class=\"btn btn-danger\">X</button></td>";
		$result .= '</tr>';
		$index ++;
	}
	$result .= '</table>';
	echo $result;
	return;
}
function getReservations($param, $search) {
	$res = array ();
	
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( 'Connection failed' . $conn->connect_error );
	}
	$query = 'SELECT * FROM `gh_allorderswithcategory` WHERE name IS NOT NULL'; // orders with name only
	
	if($search != '')
		$query .= " AND (name LIKE '%" . $search ."%' OR roomname LIKE '%" . $search ."%' 
				OR phone LIKE '%" . $search ."%' OR address LIKE '%" . $search ."%' OR
				email LIKE '%" . $search ."%')";
	
	if ($param === 'A-Z')
		$query .= ' ORDER BY name';
	else if ($param === 'Z-A')
		$query .= ' ORDER BY name DESC';
	else if ($param === 'terbaru')
		$query .= ' ORDER BY tanggalpesan DESC';
	else if ($param === 'terlama')
		$query .= ' ORDER BY tanggalpesan';
	else if ($param === 'sudah')
		$query .= ' AND isapproved = 1';
	else if ($param === 'pending')
		$query .= ' AND isapproved = 0';
	else if ($param === 'checkinterbaru')
		$query .= ' ORDER BY startdate DESC';
	else if ($param === 'checkinterlama')
		$query .= ' ORDER BY startdate';
	else if ($param === 'checkoutterbaru')
		$query .= ' ORDER BY enddate DESC';
	else if ($param === 'checkoutterlama')
		$query .= ' ORDER BY enddate';
	else
		$query .= ' AND roomid = ' . $param;
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->orderid = $item ['orderid'];
			$single->roomid = $item ['roomid'];
			$single->categoryid = $item ['categoryid'];
			$single->categoryname = $item ['categoryname'];
			$single->roomname = $item ['roomname'];
			$single->name = $item ['name'];
			$single->startdate = $item ['startdate'];
			$single->enddate = $item ['enddate'];
			$single->address = $item ['address'];
			$single->phone = $item ['phone'];
			$single->email = $item ['email'];
			$single->info = $item ['information'];
			$single->isapproved = $item ['isapproved'];
			$single->reservationdate = $item ['tanggalpesan'];
			array_push ( $res, $single );
		}
	}
	return $res;
}

?>