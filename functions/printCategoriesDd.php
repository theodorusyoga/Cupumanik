<?php
include ('/dbConnection.php');
include ('/functions.php');

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
echo $result;
return;
?>