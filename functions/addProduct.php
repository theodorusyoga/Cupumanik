<?php
include('/dbConnection.php');

function resize($images, $filename) {
	$width = 500;
	$size = getimagesize ( $images );
	$height = round ( $width * $size [1] / $size [0] );
	$images_orig = ImageCreateFromJPEG ( $images );
	$photoX = imagesx ( $images_orig );
	$photoY = imagesy ( $images_orig );
	$images_fin = imagecreatetruecolor ( $width, $height );
	ImageCopyResampled ( $images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY );
	ImageJPEG ( $images_fin, $GLOBALS ['root'] . '/images/' . $filename );
	ImageDestroy ( $images_orig );
	ImageDestroy ( $images_fin );
}

if (isset ( $_POST ['title'] ) && isset ( $_POST ['desc'] ) && isset ( $_POST ['stock'] ) && isset ( $_POST ['categoryid'] ) && isset ( $_POST ['price'] ) && isset ( $_FILES ['file'] ['type'] )) {
	$title = $_POST ['title'];
	$desc = $_POST ['desc'];
	$stock = ( int ) $_POST ['stock'];
	$catid = ( int ) $_POST ['categoryid'];
	$price = ( int ) $_POST ['price'];
	
	$filetype = $_FILES ['file'] ['type'];
	$filename = $_FILES ['file'] ['name'];
	$filesize = $_FILES ['file'] ['size'];
	$exts = array (
			'jpeg',
			'jpg',
			'png' 
	);
	$ext = explode ( '.', $filename );
	$current = end ( $ext );
	
	/* CHECK FILE VALID AND WITHIN LIMIT */
	if (($filetype == 'image/jpg' || $filetype == 'image/jpeg') && $filesize < 1000000 && in_array ( $current, $exts )) {
		$source = $_FILES ['file'] ['tmp_name'];
		$target = $GLOBALS ['root'] . '/images/' . $filename;
		move_uploaded_file ( $source, $target );
		$newfile = '/images/' . $ext [0] . '_resized' . '.' . $current ;
		resize ( $target, $ext [0] . '_resized' . '.' . $current );
		unlink ( $target );
		
		/* DATABASE */
		$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
		if ($conn->connect_error) {
			die ( "Connection failed " . $conn->connect_error );
		}
		$query = "INSERT INTO `products`(`title`, `image`, `description`, `categoryid`, `stock`, `price`) 
				VALUES ('" . $title ."', '" . $newfile ."', '" . $desc ."', " . $catid .", 
						" . (string) $stock . ", " . (string) $price .")";
		$conn->query ( $query );
		
		echo true;
		return;
	} else
		echo false;
} else
	echo false;

?>