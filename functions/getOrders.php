<?php
include ('/dbConnection.php');
include ('/functions.php');
function getOrdersSort($sort, $mulai, $akhir) {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM orders';
	$param = '';
	if ($mulai !== '' || $akhir !== '') {
		if (strpos ( $param, 'WHERE' ) === false) {
			$param .= ' WHERE';
		}
		
		if ($mulai !== '') {
			$param .= " date >= '" . $mulai . "'";
		}
		if ($akhir !== '') {
			if (strlen ( $param ) > 6)
				$param .= ' AND';
			$param .= " date <= '" . $akhir . "'";
		}
	}
	
	switch ($sort) {
		case ('A-Z') :
			$param .= ' ORDER BY name';
			break;
		case ('Z-A') :
			$param .= ' ORDER BY name DESC';
			break;
		case ('sudah') :
			if (strpos ( $param, 'WHERE' ) === false) {
				$param .= ' WHERE';
			}
			if (strlen ( $param ) > 6)
				$param .= ' AND';
			$param .= ' isprocessed = 1';
			break;
		case ('belum') :
			if (strpos ( $param, 'WHERE' ) === false) {
				$param .= ' WHERE';
			}
			if (strlen ( $param ) > 6)
				$param .= ' AND';
			$param .= ' isprocessed = 0';
			break;
	}
	$result = $conn->query ( $query . $param );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->custname = $item ['name'];
			$single->address = $item ['address'];
			$single->phone = $item ['phone'];
			$single->email = $item ['email'];
			$single->information = $item ['information'];
			$single->date = ( string ) $item ['date'];
			$single->isprocessed = ( boolean ) $item ['isprocessed'];
			$details = getOrderDetails ( $single->id );
			$totalprice = 0;
			foreach ( $details as $detail ) {
				$totalprice += ( int ) $detail->price * ( int ) $detail->amount;
			}
			$single->orderedproducts = count ( $details );
			$randomquery = 'SELECT * FROM `randomnumbers` WHERE `associatedorder` = ' . $single->id;
			$randomres = $conn->query($randomquery);
			if($randomres->num_rows > 0){
				while($rand = $randomres->fetch_assoc()){
					$totalprice += (int)$rand['randomnumber'];
					$single->randomnum = (int)$rand['randomnumber'];
				}
			}
			$single->totalprice = $totalprice;
			array_push ( $res, $single );
		}
		
		switch ($sort) {
			case ('sedikit-banyak') :
				usort ( $res, 'sortByAmount' );
				break;
			case ('banyak-sedikit') :
				usort ( $res, 'sortByAmountDesc' );
				break;
			case ('murah-mahal') :
				usort ( $res, 'sortByPrice' );
				break;
			case ('mahal-murah') :
				usort ( $res, 'sortByPriceDesc' );
				break;
		}
	}
	
	return $res;
}
function sortByAmount($a, $b) {
	return $a->orderedproducts - $b->orderedproducts;
}
function sortByAmountDesc($a, $b) {
	return $b->orderedproducts - $a->orderedproducts;
}
function sortByPrice($a, $b) {
	return $a->totalprice - $b->totalprice;
}
function sortByPriceDesc($a, $b) {
	return $b->totalprice - $a->totalprice;
}

if (isset ( $_POST ['sort'] ) && isset ( $_POST ['mulai'] ) && isset ( $_POST ['akhir'] )) {
	$sort = $_POST ['sort'];
	$mulai = $_POST ['mulai'];
	$akhir = $_POST ['akhir'];
	$orders = getOrdersSort ( $sort, $mulai, $akhir );
	$result = '<table class="table table-hover">
							<tr>
								<th>No.</th>
								<th>Nama Pemesan</th>
								
								<th>Email</th>
								<th>Tanggal Pemesanan</th>
								<th>Jumlah Barang</th>
								<th>Total Harga</th>
								<th colspan="3">&nbsp;</th>
							</tr>';
	$index = 1;
	foreach ( $orders as $order ) {
		$datearray = strtotime ( $order->date );
		$date = date ( 'd F Y', $datearray );
		$result .= '<tr>';
		$result .= '<td>' . ( string ) $index . '</td>';
		$result .= '<td>' . $order->custname . '</td>';
		
		$result .= '<td>' . $order->email . '</td>';
		$result .= '<td>' . $date . '</td>';
		$result .= '<td>' . $order->orderedproducts . '</td>';
		$result .= '<td>' . money_format ( '%i', $order->totalprice ) . '</td>';
		$result .= "<td><button type=\"button\" class=\"btn btn-primary\" onclick=\"detailOrder(" . (string)$order->id . ")\">Detail</button></td>";
		if ($order->isprocessed === true) {
			$result .= "<td><button type=\"button\" class=\"btn btn-primary\" disabled><span class=\"glyphicon glyphicon-ok\" disabled>&nbsp;</span>Sudah Selesai</button></td>";
		} else {
			$result .= "<td><button type=\"button\" onclick=\"markFinished(" . ( string ) $order->id . ")\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-ok\">&nbsp;</span>Tandai Selesai</button></td>";
		}
		$result .= "<td><button onclick=\"removeOrder(" . ( string ) $order->id . ",'" . $order->custname . "')\" type=\"button\" class=\"btn btn-danger\">X</button></td>";
		$result .= '</tr>';
		$index ++;
	}
	$result .= '</table>';
	echo $result;
	return;
}

?>