<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cupumanik</title>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link
	href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,300,500'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../cupumanik-batik.css">
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
	<div class="main-body">
		<div id="warningcontainer" class="alert alert-info"></div>
		<div id="admin-content">
			<h2>Cupumanik Administrator</h2>
			<br />
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#products"
					aria-controls="products" role="tab" data-toggle="tab"
					id="productlink">Daftar Produk</a></li>
				<li role="presentation"><a href="#orders" aria-controls="orders"
					role="tab" data-toggle="tab">Pemesanan</a></li>
				<li role="presentation"><a href="#others" aria-controls="others"
					role="tab" data-toggle="tab">Pengaturan Lainnya</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="products">
					<div style="padding-top: 2%; padding-bottom: 0%;">
						<div class="row" style="padding-bottom: 2% !IMPORTANT;">
							<button id="addproduct" class="btn pull-right btn-success">
								<span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah
								Produk
							</button>
						</div>
						<div class="row" style="padding-bottom: 0% !IMPORTANT;">
							<form id="filter">
								<div class="form-group col-sm-5"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Urutkan:</div>
										<select id="sortParam" class="form-control">
											<optgroup label="Abjad">
												<option value="A-Z">A hingga Z</option> 
												<option value="Z-A">Z hingga A</option> 
											</optgroup>
											<optgroup label="Harga">
												<option value="tinggi-rendah">Tertinggi hingga terendah</option> 
												<option value="rendah-tinggi">Terendah hingga tertinggi</option> 
											</optgroup>
											<optgroup label="Kategori Tersedia">
												<?php echo printCategoriesAsDropdown(); ?>
											</optgroup>
											<optgroup label="Jumlah Stok">
												<option value="banyak-sedikit">Terbanyak hingga tersedikit</option> 
												<option value="sedikit-banyak">Tersedikit hingga terbanyak</option> 
											</optgroup>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-6"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Cari Produk:</div>
										<input type="text" class="form-control" id="cariTb"
											placeholder="Masukkan kata kunci...">
									</div>
								</div>

								<button type="submit" class="btn btn-info pull-right col-sm-1">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</form>
						</div>
					</div>
					<div id="productstable">
						<?php echo printProducts(); ?>
						</div>
				</div>
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
	<!-- END LOGIN MODAL -->

	<!-- DETAILS MODAL -->
	<div id="detailsbox" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="tambahProdukLabel">Tambah Produk</h4>
				</div>
				<form id="formdetails" class="form-horizontal" action=""
					method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="row" id="detaildanger">
							<div class="alert alert-danger">
								<strong>Terjadi kesalahan: </strong>
								<p id="detailwarning"></p>
							</div>
						</div>
						<div class="row" id="detailwait">
							<div class="alert alert-info">
								<strong>Menunggu... </strong><img
									src="../../assets/ajax-loader.gif" />
							</div>
						</div>
						<input type="hidden" id="tempid" />
						<div class="form-group">
							<div class="col-md-4">Pilih Kategori</div>
							<div class="col-md-8">
								<select id="selectCategory" class="form-control">
								<?php echo printCategoriesAsDropdown(); ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Nama Produk</div>
							<div class="col-md-8">
								<input type="text" class="form-control" id="namaProdukTb"
									required />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Deskripsi</div>
							<div class="col-md-8">
								<textarea id="deskripsiTb" class="form-control" rows="4"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Jumlah Stok</div>
							<div class="col-md-8">
								<input type="number" class="form-control" id="jumlahStokTb"
									required />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Harga Satuan</div>
							<div class="col-md-8">
								<div class="input-group">
									<div class="input-group-addon">IDR</div>
									<input type="number" class="form-control" id="hargaSatuanTb">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Unggah Foto</div>
							<div class="col-md-8">
								<input type="file" name="file" class="form-control"
									id="uploadFile" />
								<div class="alert alert-danger" id="imagewarning"></div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">&nbsp;</div>
							<div class="col-md-8">
								<img id="uploadedimg" style="max-width: 300px;" />
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<input type="submit" value="Simpan" id="tambahBtn"
							class="btn btn-primary"></input>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- END DETAILS MODAL -->
</body>
</html>