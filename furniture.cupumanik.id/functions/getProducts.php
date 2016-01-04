<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
function getProducts() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description, 
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
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

$products = getProducts ();
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
		$result .= "<td><button onclick=\"detailProduct(" . $product->id .")\" class=\"btn\">Ubah/Detail</btn></td>";
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
function money_format($format, $number) {
	$regex = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' . '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
	if (setlocale ( LC_MONETARY, 0 ) == 'C') {
		setlocale ( LC_MONETARY, '' );
	}
	$locale = localeconv ();
	preg_match_all ( $regex, $format, $matches, PREG_SET_ORDER );
	foreach ( $matches as $fmatch ) {
		$value = floatval ( $number );
		$flags = array (
				'fillchar' => preg_match ( '/\=(.)/', $fmatch [1], $match ) ? $match [1] : ' ',
				'nogroup' => preg_match ( '/\^/', $fmatch [1] ) > 0,
				'usesignal' => preg_match ( '/\+|\(/', $fmatch [1], $match ) ? $match [0] : '+',
				'nosimbol' => preg_match ( '/\!/', $fmatch [1] ) > 0,
				'isleft' => preg_match ( '/\-/', $fmatch [1] ) > 0
		);
		$width = trim ( $fmatch [2] ) ? ( int ) $fmatch [2] : 0;
		$left = trim ( $fmatch [3] ) ? ( int ) $fmatch [3] : 0;
		$right = trim ( $fmatch [4] ) ? ( int ) $fmatch [4] : $locale ['int_frac_digits'];
		$conversion = $fmatch [5];

		$positive = true;
		if ($value < 0) {
			$positive = false;
			$value *= - 1;
		}
		$letter = $positive ? 'p' : 'n';

		$prefix = $suffix = $cprefix = $csuffix = $signal = '';

		$signal = $positive ? $locale ['positive_sign'] : $locale ['negative_sign'];
		switch (true) {
			case $locale ["{$letter}_sign_posn"] == 1 && $flags ['usesignal'] == '+' :
				$prefix = $signal;
				break;
			case $locale ["{$letter}_sign_posn"] == 2 && $flags ['usesignal'] == '+' :
				$suffix = $signal;
				break;
			case $locale ["{$letter}_sign_posn"] == 3 && $flags ['usesignal'] == '+' :
				$cprefix = $signal;
				break;
			case $locale ["{$letter}_sign_posn"] == 4 && $flags ['usesignal'] == '+' :
				$csuffix = $signal;
				break;
			case $flags ['usesignal'] == '(' :
			case $locale ["{$letter}_sign_posn"] == 0 :
				$prefix = '(';
				$suffix = ')';
				break;
		}
		if (! $flags ['nosimbol']) {
			$currency = $cprefix . ($conversion == 'i' ? $locale ['int_curr_symbol'] : $locale ['currency_symbol']) . $csuffix;
		} else {
			$currency = '';
		}
		$space = $locale ["{$letter}_sep_by_space"] ? ' ' : '';

		$value = number_format ( $value, $right, $locale ['mon_decimal_point'], $flags ['nogroup'] ? '' : $locale ['mon_thousands_sep'] );
		$value = @explode ( $locale ['mon_decimal_point'], $value );

		$n = strlen ( $prefix ) + strlen ( $currency ) + strlen ( $value [0] );
		if ($left > 0 && $left > $n) {
			$value [0] = str_repeat ( $flags ['fillchar'], $left - $n ) . $value [0];
		}
		$value = implode ( $locale ['mon_decimal_point'], $value );
		if ($locale ["{$letter}_cs_precedes"]) {
			$value = $prefix . $currency . $space . $value . $suffix;
		} else {
			$value = $prefix . $value . $space . $currency . $suffix;
		}
		if ($width > 0) {
			$value = str_pad ( $value, $width, $flags ['fillchar'], $flags ['isleft'] ? STR_PAD_RIGHT : STR_PAD_LEFT );
		}

		$format = str_replace ( $fmatch [0], $value, $format );
	}
	return $format;
}

?>