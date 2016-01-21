<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
$categories = getCategories();
$result = '	<select id="categorylist" class="form-control">';
foreach ( $categories as $category ) {
	$result .= '<option value="' . $category->id .'">' . $category->categoryname . '</option>';
}
$result .= '</select>';
echo $result;
return;
function getCategories() {
	$res = array ();
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM `categories`';
	$result = $conn->query ( $query );
	$strresult = '';
	if ($result->num_rows > 0) {
		while ( $item = $result->fetch_assoc () ) {
			$single = new stdClass ();
			$single->id = $item ['id'];
			$single->categoryname = $item ['categoryname'];
			array_push ( $res, $single );
		}
	}
	return $res;
}

?>