<!DOCTYPE html>
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
<link rel="stylesheet" href="<?php echo $GLOBALS['rooturl']?>/css/style.css">
<link rel="stylesheet" href="../cupumanik-furniture.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png" href="http://cupumanik-local.com/assets/cupumanikicon.png"/>
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="<?php echo $GLOBALS['rooturl']?>/javascript/accounting.js"></script>
<link rel="stylesheet"
	href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="../javascript/index.js" type="text/javascript"></script>
</head>
<body>
	<div class="navbar navbar-default navbar-small navbar-fixed-top">
		<div class="container">
			<div class="navbar-brand pull-left">
				<a href="/admin"> <img class="logo" src="../../assets/logo-black.png"
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
					<li><a href="/admin">Kembali ke Halaman Utama&nbsp;<span
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
					role="tab" id="orderlink" data-toggle="tab">Pemesanan</a></li>
				<li role="presentation"><a href="#others" aria-controls="others"
					role="tab" id="categorylink" data-toggle="tab">Pengaturan Lainnya</a></li>
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
											<optgroup label="Kategori Tersedia" id="catparam">
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
				<div role="tabpanel" class="tab-pane" id="orders">
					<div style="padding-top: 2%; padding-bottom: 0%;">
						<div class="row" style="padding-bottom: 0% !IMPORTANT;">
							<form id="filteroder">
								<div class="form-group col-sm-3"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Urutkan:</div>
										<select id="sortOrderParam" class="form-control">
											<optgroup label="Nama Pemesan">
												<option value="A-Z">A hingga Z</option>
												<option value="Z-A">Z hingga A</option>
											</optgroup>
											<optgroup label="Jumlah Barang Dipesan">
												<option value="banyak-sedikit">Terbanyak hingga tersedikit</option>
												<option value="sedikit-banyak">Tersedikit hingga terbanyak</option>
											</optgroup>
											<optgroup label="Total Harga Pemesanan">
												<option value="mahal-murah">Termahal hingga termurah</option>
												<option value="murah-mahal">Termurah hingga Termahal</option>
											</optgroup>
											<optgroup label="Status Pemesanan">
												<option value="sudah">Sudah diproses</option>
												<option value="belum">Belum diproses</option>
											</optgroup>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-4"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Tanggal Mulai</div>
										<input type="text" class="form-control" id="mulaiTb"
											placeholder="Masukkan tanggal mulai...">
									</div>
								</div>
								<div class="form-group col-sm-4"
									style="padding-right: 0px !IMPORTANT;">
									<div class="input-group">
										<div class="input-group-addon">Tanggal Akhir</div>
										<input type="text" class="form-control" id="akhirTb"
											placeholder="Masukkan tanggal akhir...">
									</div>
								</div>
								<button type="submit" class="btn btn-info pull-right col-sm-1">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</form>
						</div>
					</div>
					<div id="orderstable">
						<?php echo printOrders(); ?>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="others">
					<div style="padding-top: 2%; padding-bottom: 0%;" class="col-sm-6">
						<h3>Pengaturan Kategori</h3>
						<div style="padding-bottom: 2%;">
							<div class="row">
								<div class="col-sm-12" style="padding-bottom: 2% !IMPORTANT;">
									<button id="addcategory" class="btn btn-success">
										<span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah
										Kategori
									</button>
								</div>
							</div>
							<div class="row" id="newcategorydiv"
								style="padding-right: 1% !IMPORTANT">
								<form id="addcatform" action="" method="post">
									<div class="col-sm-6">
										<input id="newcategoryTb" type="text"
											placeholder="Masukkan kategori baru..." class="form-control" />
									</div>
									<div class="col-sm-3">
										<button type="submit" class="btn btn-primary pull-left">
											<span class="glyphicon glyphicon-floppy-save">&nbsp;</span>Simpan
										</button>
									</div>
									<div class="col-sm-3">
										<button type="button" class="btn btn-danger pull-left"
											id="closeaddcat">
											<span class="glyphicon glyphicon-remove"> &nbsp;</span>Tutup
										</button>
									</div>
								</form>
							</div>
						</div>
						<div id="tablecat">
						<?php echo printCategoriesTable(); ?>
						</div>
					</div>
					<form id="changepassform">
						<div style="padding-top: 2%; padding-bottom: 0%;" class="col-sm-6">
							<h3>Pengaturan Administrator</h3>
							<div style="padding-bottom: 2%">
								<button type="submit" class="btn btn-success">
									<span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Simpan
									Password Baru
								</button>
							</div>
							<div>
								<div class="row">
									<div class="col-md-4">Password Lama:</div>
									<div class="col-md-8">
										<input type="password" class="form-control"
											id="passwordLamaTb" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">Password Baru:</div>
									<div class="col-md-8">
										<input type="password" class="form-control"
											id="passwordBaruTb" />
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">Ulangi Password Baru:</div>
									<div class="col-md-8">
										<input type="password" class="form-control"
											id="ulangPasswordBaruTb" />
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
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

	<!-- ORDERS MODAL -->
	<div id="orderdetailsbox" class="modal fade" tabindex="-1"
		role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="orderdetailstitle">Detail Pemesanan:</h4>
				</div>
				<form id="formdetails" class="form-horizontal" action=""
					method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="row" id="orderdanger">
							<div class="alert alert-danger">
								<strong>Terjadi kesalahan: </strong>
								<p id="orderwarning"></p>
							</div>
						</div>
						<div class="row" id="orderwait">
							<div class="alert alert-info">
								<strong>Menunggu... </strong><img
									src="../../assets/ajax-loader.gif" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Nama Pemesan</div>
							<div class="col-md-8">
								<label id="namaPemesanLabel">Nama</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Alamat</div>
							<div class="col-md-8">
								<label id="alamatLabel">Alamat</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Nomor Telepon</div>
							<div class="col-md-8">
								<label id="phoneLabel">Telepon</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Email</div>
							<div class="col-md-8">
								<label id="emailLabel">Email</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Informasi Lainnya</div>
							<div class="col-md-8">
								<label id="informasiLabel">Informasi</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Tanggal Pemesanan</div>
							<div class="col-md-8">
								<label id="tanggalLabel">Tanggal Pemesanan</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Status Pemesanan</div>
							<div class="col-md-8">
								<label id="statusLabel"><span class="glyphicon glyphicon-ok">&nbsp;</span>Sudah
									Diproses</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">Daftar Barang</div>
						</div>
						<div class="form-group">
							<div class="col-md-12" id="productdetails"></div>
						</div>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> -->
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="button" id="tandaiBtn" class="btn btn-primary">
							<span class="glyphicon glyphicon-ok">&nbsp;</span>Tandai Sudah
							Diproses
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- END ORDERS MODAL -->
</body>
</html>