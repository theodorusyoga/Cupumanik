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
					<li><a href="#" id="login">Masuk ke Cupumanik Administrator</a></li>
					<li><a href="" id="logout">Keluar</a></li>
					<li><a href="">Kembali ke Halaman Utama&nbsp;<span
							class="glyphicon glyphicon-home"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main-body" >
		<div id="warningcontainer" class="alert alert-info" id="warning"></div>
		<div>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#products"
					aria-controls="products" role="tab" data-toggle="tab">Daftar Produk</a></li>
				<li role="presentation"><a href="#orders" aria-controls="orders"
					role="tab" data-toggle="tab">Pemesanan</a></li>
				<li role="presentation"><a href="#others" aria-controls="others"
					role="tab" data-toggle="tab">Pengaturan Lainnya</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="products">Products</div>
				<div role="tabpanel" class="tab-pane" id="orders">Pemesanan</div>
				<div role="tabpanel" class="tab-pane" id="others">Pengaturan</div>
			</div>

		</div>
	</div>

	<!-- LOGIN MODAL -->
	<div id="loginbox" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span> -->
					</button>
					<h4 class="modal-title" id="myModalLabel">Masuk ke Administrator</h4>
				</div>
				<form>
					<div class="modal-body">
						<div class="row" id="alertdanger">
							<div class="alert alert-danger">
								<strong>Terjadi kesalahan: </strong>username atau password
								salah.
							</div>
						</div>
						<div class="row" id="alertsuccess">
							<div class="alert alert-success">
								<strong>Login berhasil. </strong> Harap tunggu...
							</div>
						</div>
						<div class="row" id="alertwait">
							<div class="alert alert-info">
								<strong>Menunggu... </strong><img
									src="../../assets/ajax-loader.gif" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">Username:</div>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usernameTb" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">Password:</div>
							<div class="col-md-8">
								<input type="password" class="form-control" id="passwordTb" />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
						<button type="submit" id="loginbtn" class="btn btn-primary">Masuk</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</body>
</html>