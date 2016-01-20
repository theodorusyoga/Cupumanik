<!DOCTYPE HTML>
<html>
<head>
<meta charset="ISO-8859-1">
<?php
$path = $_SERVER ['DOCUMENT_ROOT'];
$path .= '/include.php';
include ($path);
?>
<title>Cupumanik Administrator</title>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,300,500'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet"
	href="<?php echo $GLOBALS['rooturl']?>/css/style.css">
<link rel="stylesheet" href="../cupumanik-guesthouse.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png"
	href="http://cupumanik-local.com/assets/cupumanikicon.png" />
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
link rel="stylesheet"
href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="../javascript/index.js" type="text/javascript"></script>
</head>
<body>
	<div class="navbar navbar-default navbar-small navbar-fixed-top">
		<div class="container">
			<div class="navbar-brand pull-left">
				<a href="/admin"> <img class="logo"
					src="../../assets/logo-black.png" style="height: 40px" />
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
					<li><a href="/admin">Kembali ke Halaman Utama&nbsp;<span
							class="glyphicon glyphicon-home"></span></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main-body">
		<div id="warningcontainer" class="alert alert-info"></div>
		<div id="admin-content">
			<h2>Cupumanik Guest House Administrator</h2>
			<br />
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#reservation"
					aria-controls="reservation" role="tab" data-toggle="tab"
					id="reservationlink">Daftar Pemesanan</a></li>
				<li role="presentation"><a href="#roomlist" aria-controls="roomlist"
					role="tab" id="roomlistlink" data-toggle="tab">Daftar Kamar/Rumah</a></li>
				<li role="presentation"><a href="#others" aria-controls="others"
					role="tab" id="categorylink" data-toggle="tab">Pengaturan Lainnya</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="reservation">
					<div style="padding-top: 2%; padding-bottom: 0%;">
						<div class="row" style="padding-bottom: 2% !IMPORTANT;">
							<button id="addreservation" class="btn pull-right btn-success">
								<span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah
								Pemesanan
							</button>
						</div>
						<div class="row" style="padding-bottom: 0% !IMPORTANT;"></div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="roomlist">
					<div style="padding-top: 2%; padding-bottom: 0%;">
						<div class="row">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-exclamation-sign"></span>
								Daftar kamar/rumah tidak akan ditampilkan kepada
								pengguna/pemesan!<br /> &nbsp;&nbsp;&nbsp; Gunakan daftar ini
								hanya untuk menentukan apakah kamar/rumah sedang isi/kosong pada
								periode tertentu.
							</div>
						</div>
						<div class="row" style="padding-bottom: 2% !IMPORTANT;">
							<button id="addroom" class="btn pull-right btn-success">
								<span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah
								Kamar/Rumah
							</button>
						</div>
						<div class="row" style="padding-bottom: 0% !IMPORTANT;">
							<table class="table table-hover">
								<tr>
									<th>No.</th>
									<th>Nama Kamar/Rumah</th>
									<th>Deskripsi</th>
									<th>Kategori</th>
									<th>Total Pemesanan</th>
									<th colspan="2">&nbsp;</th>
								</tr>
								<tr>
									<td>1</td>
									<td>Rumah Kavling 1</td>
									<td>Kavling pertama dari jalan utama</td>
									<td>Rumah</td>
									<td>3</td>
									<td><button class="btn">Ubah</button>
									<button class="btn btn-danger">X</button></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="others">
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
					<form id="loginform">
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