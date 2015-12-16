<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cupumanik</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,300,500'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../cupumanik-style.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/Cupumanik';
$path .= '/functions/functions.php';
include ($path);
?>
<script src="../../javascript/index.js" type="text/javascript"></script>
</head>
<body>
	<div class="navbar navbar-default navbar-small navbar-fixed-top">
		<div class="container">
			<div class="navbar-brand pull-left">
				<a href="#home"> <img class="logo" src="../../assets/logo-black.png"
					style="height: 40px" />
				</a>
			</div>
			<button type="button" class="navbar-toggle pull-right"
				data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<div class="navbar-collapse collapse pull-right">
				<ul class="nav navbar-nav nav-menu">
					<li><a href="" style="cursor: default !IMPORTANT;">Masuk ke
							Cupumanik Administrator</a></li>
					<li><a href="">Kembali ke Halaman Utama&nbsp;<span
							class="glyphicon glyphicon-home"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- LOGIN MODAL -->
	<div id="loginbox" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
					Username:
					<button id="loginbtn" class="btn">Masuk</button>
			</div>
		</div>
	</div>
</body>
</html>