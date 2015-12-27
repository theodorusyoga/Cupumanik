<?php
session_start();
include('/dbConnection.php');

if (isset ( $_SESSION['user'] ) && isset ( $_SESSION ['pass'] )) {
	$user = $_SESSION ['user'];
	$pass = $_SESSION ['pass'];
	$conn = new mysqli ( $servername, $dbuser, $dbpass, $dbname );
	if ($conn->connect_error) {
		die ( "Connection failed " . $conn->connect_error );
	}
	$query = 'SELECT * FROM admins';
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		$md5ed = md5 ( $pass );
		while ( $item = $result->fetch_assoc () ) {
			$username = $item ['username'];
			$password = $item ['password'];
			if ($username == $user && $password == $md5ed) {
				echo true;
				return;
			}
		}
	}
	echo false;
} else
	echo false;
?>