<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
$funcpath = $_SERVER['DOCUMENT_ROOT'] . '/functions/functions.php';
include($path);
include($funcpath);	
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