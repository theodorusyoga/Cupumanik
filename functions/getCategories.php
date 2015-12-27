<?php
include ('/dbConnection.php');

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
echo $result;
return;
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

?>