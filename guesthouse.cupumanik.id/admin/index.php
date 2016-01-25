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
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment-with-locales.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/locale/id.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

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
		<div id="admin-content">
			<br />
			<h2>Cupumanik Guest House Administrator</h2>
			<br />
			<div id="warningcontainer" class="alert alert-info"></div>
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
						<div class="row" style="padding-bottom: 2% !IMPORTANT;"></div>
						<div class="row" style="padding-bottom: 0% !IMPORTANT;">
							<form id="sortform">
								<div class="form-group col-sm-5"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Urutkan:</div>
										<select id="sortParam" class="form-control">
											<optgroup label="Nama Pemesan">
												<option value="A-Z">A hingga Z</option>
												<option value="Z-A">Z hingga A</option>
											</optgroup>
											<optgroup label="Tanggal Pemesanan">
												<option value="terbaru">Dari terbaru</option>
												<option value="terlama">Dari terlama</option>
											</optgroup>
											<optgroup label="Tanggal Check-In">
												<option value="checkinterbaru">Dari terbaru</option>
												<option value="checkinterlama">Dari terlama</option>
											</optgroup>
											<optgroup label="Tanggal Check-Out">
												<option value="checkoutterbaru">Dari terbaru</option>
												<option value="checkoutterlama">Dari terlama</option>
											</optgroup>
											<optgroup label="Status Pesanan">
												<option value="sudah">Sudah diterima</option>
												<option value="pending">Pending</option>
											</optgroup>
											<optgroup id="daftarKamarFilter" label="Per Kamar/Rumah">
											</optgroup>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-6"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Cari Pemesanan:</div>
										<input type="text" class="form-control" id="cariTb"
											placeholder="Masukkan kata kunci...">
									</div>
								</div>
								<button type="submit" class="btn btn-info pull-right col-sm-1">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</form>
						</div>
						<div id="reservationcontent">
							<!-- FILL WITH RESERVATION TABLE -->
						</div>
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
						<div class="row" id="roomslist"
							style="padding-bottom: 0% !IMPORTANT;">
							<!-- FILL WITH ROOMS TABLE -->
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="others"></div>
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
						<span aria-hidden="true">&times;</span> 
						</button> -->
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

	<!-- ROOMS MODAL -->
	<div id="roombox" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="addroomform" class="form-horizontal">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="addRoomModalLabel">Tambah Kamar/Rumah</h4>
					</div>

					<div class="modal-body">
						<input type="hidden" id="selectedRoomId" />
						<div class="row" id="roomdanger">
							<div class="alert alert-danger">
								<strong>Terjadi kesalahan: </strong>
								<p id="roomdangermessage" />
							</div>
						</div>
						<div class="row" id="roomsuccess">
							<div class="alert alert-success">
								<strong>Kamar/rumah berhasil disimpan.</strong>
							</div>
						</div>
						<div class="row" id="roomwait">
							<div class="alert alert-info">
								<strong>Menunggu... </strong><img
									src="../../assets/ajax-loader.gif" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Pilih Kategori</div>
							<div class="col-md-8" id="categorylistdiv">
								<!-- FILL WITH CATEGORIES DROP DOWN -->
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Nama Kamar/Rumah</div>
							<div class="col-md-8">
								<input type="text" class="form-control" id="roomNameTb" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Deskripsi</div>
							<div class="col-md-8">
								<textarea id="deskripsiTb" class="form-control" rows="4"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
						<button type="submit" id="addroombtn" class="btn btn-primary">
							<span class="glyphicon glyphicon-plus">&nbsp;</span>Tambah Kamar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- RESERVATION MODAL -->
	<div id="order-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title main-title">Detail Pemesanan</h4>
					<p>
						Tanggal Pemesanan: <label id="customer-reservation-date"></label>
					</p>
				</div>
				<div class="modal-body">
					<div id="form-order">
						<div class="form-group row">
							<label class="control-label col-xs-3">Jenis Pemesanan</label>
							<div class="col-xs-9">
								<label id="jenis-pemesanan"></label> &nbsp;&nbsp;<small
									style="color: red; text-decoration: underline; cursor: pointer; font-size: x-small;"
									data-toggle="tooltip" data-placement="right"
									title="Jenis pemesanan tidak dapat diganti. Untuk menggantinya, pemesanan sebelumnya harus dihapus dan dilakukan pemesanan baru melalui halaman depan.">
									Bagaimana menggantinya?</small>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-3">Tanggal Check-In</label>
							<div class="col-xs-9">
								<div class="input-group date" id='start-date'>
									<input type='text' id="start-date-input"
										placeholder="Pilih tanggal check in" class="form-control" /> <span
										class="input-group-addon datepicker"> <span
										class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-3">Tanggal Check-Out</label>
							<div class="col-xs-9">
								<div class="input-group date" id='end-date'>
									<input type='text' id="end-date-input"
										placeholder="Pilih tanggal check out" class="form-control" />
									<span class="input-group-addon datepicker"> <span
										class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-3">Pilih Kamar/Rumah</label>
							<div class="col-xs-9">
								<select class="form-control" id="pilihKamarDetail">
									
								</select>
								<small
									style="color: red; text-decoration: underline; cursor: pointer; font-size: x-small;"
									data-toggle="tooltip" data-placement="right"
									title="Kamar/rumah yang ditampilkan hanya yang tersedia pada tanggal check-in/out yang diberikan.">
									Mengapa saya tidak bisa melihat semua daftar kamar/rumah?</small>
							</div>
						</div>
						<hr />
						<div id="orderprogressbar" class="progress">
							<div class="progress-bar progress-bar-striped active"
								role="progressbar" aria-valuenow="100" aria-valuemin="0"
								aria-valuemax="100" style="width: 100%">Memproses pemesanan...</div>
						</div>
						<div id="orderalert" class="alert alert-info"></div>
						<h4 class="main-title">Detail Pemesanan</h4>
						<form role="form">
							<div class="form-group row">
								<label class="control-label col-xs-3">Nama Lengkap</label>
								<div class="col-xs-9">
									<label id="customer-name">Theodorus Yoga</label>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Alamat Pengiriman </label>
								<div class="col-xs-9">
									<label id="customer-address"></label>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Nomor Telepon/HP</label>
								<div class="col-xs-9">
									<label id="customer-phone"></label>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Email </label>
								<div class="col-xs-9">
									<label id="customer-email"></label>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Informasi Tambahan</label>
								<div class="col-xs-9">
									<label id="customer-note"></label>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button id="btn-submit" class="btn btn-info">Proses Pemesanan</button>
					<button id="btn-ok" class="btn btn-success">OK</button>
				</div>
			</div>

		</div>
	</div>

</body>
</html>