<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/functions/dbConnection.php';
include($path);
if(isset($_POST['old']) && isset($_POST['new'])){
	$oldpassword = $_POST['old'];
	$newpassword = $_POST['new'];
	
	$conn = new mysqli ( $GLOBALS ['servername'], $GLOBALS ['dbuser'], $GLOBALS ['dbpass'], $GLOBALS ['dbname'] );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = "SELECT * FROM `admins` WHERE `username` = 'admin'";
	$result = $conn->query ( $query );
	if($result->num_rows > 0){
		while($item = $result->fetch_assoc()){
			$currentmd5 = $item['password'];
			$oldmd5 = md5($oldpassword);
			$newmd5 = md5($newpassword);
			if($currentmd5 === $oldmd5){
				$update = "UPDATE `admins` SET `password` = '" . $newmd5 ."' WHERE `username` = 'admin'";
				$updateresult = $conn->query($update);
				if($updateresult === true){
					echo true;
					return;
				}
				else{
					echo false;
					return;
				}
			}
			else{
				echo false;
			}
			return;
		}
		
	}
	else {
		echo false;
		return;
	}
}

?>