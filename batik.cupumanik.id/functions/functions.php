<?php
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
			$single->price = $item ['price'];
			$single->catid = $item ['categoryid'];
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

function getProductById($id)
{
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description,
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.id = ' . $id;
	$result = $conn->query ( $query );
	//$strresult = '';
	$res = array();
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
			array_push($res, $single);
		}
	}

	if (count($res) > 0)
		return $res[0];
	else
		return null;
}

function getProductByCategory($id)
{
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description,
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.categoryid = ' . $id;
	$result = $conn->query ( $query );
	//$strresult = '';
	$res = array();
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
			array_push($res, $single);
		}
	}
	return $res;
}

function getNewProducts()
{
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title, A.image as image, 
			A.description as description, A.stock as stock, 
			A.price as price, B.id as categoryid, B.categoryname as categoryname 
			FROM products A JOIN categories B ON B.id = A.categoryid 
			ORDER BY A.id DESC LIMIT 4';
	$result = $conn->query ( $query );
	//$strresult = '';
	$res = array();
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
			array_push($res, $single);
		}
	}
	return $res;
}

function getTopProducts()
{
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description, 
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname, C.sold as sold
			FROM products A JOIN categories B ON B.id = A.categoryid JOIN (SELECT productid, SUM(amount) as sold FROM orderdetails GROUP BY productid) as C on C.productid = A.id
			ORDER BY sold DESC
			LIMIT 4';
	$result = $conn->query ( $query );
	//$strresult = '';
	$res = array();
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
			array_push($res, $single);
		}
	}
	return $res;
}

function searchProduct($query)
{
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT A.id as prodid, A.title as title,
			A.image as image, A.description as description,
			A.stock as stock, A.price as price, B.id as categoryid, B.categoryname as categoryname
			FROM products A JOIN categories B ON B.id = A.categoryid WHERE A.title LIKE \'%' . $query . '%\'';
	$result = $conn->query ( $query );
	//$strresult = '';
	$res = array();
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
			array_push($res, $single);
		}
	}
	return $res;
}

function printProductNotFound() {
	return "<p class=\"alert alert-warning\">Tidak ada produk untuk ditampilkan</p>";
}

function getCategories() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM categories';
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->categoryname = $item ['categoryname'];
			$single->link = $item ['uniquelink'];
			array_push ( $res, $single );
		}
	}
	return $res;
}

function getCategoryById($id) {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM categories WHERE id = '.$id;
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->categoryname = $item ['categoryname'];
			$single->link = $item ['uniquelink'];
			array_push ( $res, $single );
		}
	}
	if (count($res) > 0)
		return $res[0];
	else
		return null;
}

function getOrders() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM orders ORDER BY name';
	$result = $conn->query ( $query );
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
			$randomres = $conn->query ( $randomquery );
			if ($randomres->num_rows > 0) {
				while ( $rand = $randomres->fetch_assoc () ) {
					$totalprice += ( int ) $rand ['randomnumber'];
					$single->randomnum = ( int ) $rand ['randomnumber'];
				}
			}
			$single->totalprice = $totalprice;
			array_push ( $res, $single );
		}
	}
	return $res;
}
function getOrderDetails($id) {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT a.id as id, a.productid as productid, a.amount as amount, a.associatedorder as associatedorder, 
			b.title as productname, b.stock as stock, b.image as image, b.price as price 
			FROM orderdetails a JOIN products b ON a.productid = b.id WHERE a.associatedorder = ' . $id;
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->productid = $item ['productid'];
			$single->amount = $item ['amount'];
			$single->associatedorder = $item ['associatedorder'];
			$single->productname = $item ['productname'];
			$single->stock = $item ['stock'];
			$single->image = $item ['image'];
			$single->price = $item ['price'];
			array_push ( $res, $single );
		}
	}
	return $res;
}
function printCategories() {
	$categories = getCategories ();
	$result = '';
	foreach ( $categories as $category ) {
		$result .= '<li><a class="cat" href="'."/category.php?id=".$category->id.'">' . $category->categoryname . '</a></li>';
	}
	return $result;
}
function printCategoriesAsDropdown() {
	$categories = getCategories ();
	$result = '';
	$index = 0;
	foreach ( $categories as $category ) {
		/*
		 * if($index == 0){
		 * $result .= '<option value="' . $category->id .'" selected="selected">' . $category->categoryname . '</option>';
		 * continue;
		 * }
		 */
		$result .= '<option value="' . $category->id . '">' . $category->categoryname . '</option>';
		$index ++;
	}
	return $result;
}
function printProducts() {
	setlocale ( LC_MONETARY, 'id-ID' );
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
			$result .= "<td><button onclick=\"detailProduct(" . $product->id . ")\" class=\"btn\">Ubah/Detail</btn></td>";
			$result .= "<td><button onclick=\"removeProduct(" . $product->id . ",'" . $product->title . "')\" class=\"btn btn-danger removeprod\">X</btn></td>";
			$result .= '</tr>';
			$itemindex ++;
		}
	} else {
		$result .= '<tr><td colspan="5"><p class="alert alert-warning">Tidak ada data produk</p></td></tr>';
	}
	$result .= '</table>';
	return $result;
}
function printCategoriesTable() {
	$categories = getCategories ();
	$result = '<table class="table table-hover">
							<tr>
								<th>No.</th>
								<th>Nama Kategori</th>
								<th colspan="2">&nbsp;</th>
							</tr>';
	$index = 1;
	foreach ( $categories as $category ) {
		$result .= '<tr>';
		$result .= '<td>' . ( string ) $index . '</td>';
		$result .= '<td id="catname_' . ( string ) $category->id . '">' . $category->categoryname . '</td>';
		$result .= "<td id=\"buttoncat_" . ( string ) $category->id . "\"><button onclick=\"changeCategory(" . ( string ) $category->id . ")\" class=\"btn\">Ubah</button></td>";
		$result .= "<td><button onclick=\"removeCategory(" . ( string ) $category->id . ")\"
				class=\"btn btn-danger\">X</button></td>";
		$result .= '</tr>';
		$index ++;
	}
	$result .= '</table>';
	return $result;
}
function printOrders() {
	$orders = getOrders ();
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
		$result .= "<td><button type=\"button\" class=\"btn btn-primary\" onclick=\"detailOrder(" . ( string ) $order->id . ")\">Detail</button></td>";
		if ($order->isprocessed === true) {
			$result .= "<td><button type=\"button\" class=\"btn btn-primary\" disabled><span class=\"glyphicon glyphicon-ok\">&nbsp;</span>Sudah Selesai</button></td>";
		} else {
			$result .= "<td><button type=\"button\" onclick=\"markFinished(" . ( string ) $order->id . ")\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-ok\">&nbsp;</span>Tandai Selesai</button></td>";
		}
		$result .= "<td><button onclick=\"removeOrder(" . ( string ) $order->id . ",'" . $order->custname . "')\" type=\"button\" class=\"btn btn-danger\">X</button></td>";
		$result .= '</tr>';
		$index ++;
	}
	$result .= '</table>';
	return $result;
}

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

