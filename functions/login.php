<?php
session_start();
$servername = 'localhost';
$dbname = 'cupumanik';
$dbuser = 'theodorus';
$dbpass = 'pass@word1';

if (isset ( $_POST ['user'] ) && isset ( $_POST ['pass'] )) {
	$user = $_POST ['user'];
	$pass = $_POST ['pass'];
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
				$_SESSION['user'] = $username;
				$_SESSION['pass'] = $pass;
				echo true;
				return;
			}
		}
	}
	echo false;
} else
	echo false;
?>