<html>
<head>
<title>Cupumanik.id - Welcome</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="shortcut icon" type="image/png"
	href="http://cupumanik-local.com/assets/cupumanikicon.png" />

<script src="https://code.jquery.com/jquery-2.1.4.min.js"
	type="text/javascript"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="/javascript/function.js" type="text/javascript"></script>
</head>

<?php include('/template/functions.php')?>
<body style="background-color: #000000">
	<div class="header">
		<div class="subheader">
			<img class="logo" src="assets/logo-black.png" />
		</div>
	</div>
	<div class="menu">
		<ul class="list">
			<li><a class="link" href="#" id="aboutus">ABOUT US</a></li>
			<li><a class="link" href="#" id="contactus">CONTACT US</a></li>&nbsp;&nbsp;&nbsp;&nbsp;
			</li>
		</ul>
	</div>
	<div class="main">
		<div class="overlay"></div>
		<span class="coverage">&nbsp;</span>
		<div class="content">
			<div class="submain">
				<ul class="list">
				<?php
				echo '<li><a id="batiklink" class="link" href="http://batik.' . $_SERVER ['HTTP_HOST'] . '">Batik</a></li>
					<li><a id="furnilink" class="link" href="http://furniture.' . $_SERVER ['HTTP_HOST'] . '">Furniture</a></li>
					<li><a id="guesthouselink" class="link" href="http://guesthouse.' . $_SERVER ['HTTP_HOST'] . '">Guest House</a></li>'?>
				</ul>
			</div>
		</div>
		<div class="preview">
			<div class="previewcontent">&nbsp;</div>
			<div class="images batiklink">
				<div class="column">
					<img id="img1" src="images/batik1.jpg" class="previewimg batiklink" />
				</div>
				<div class="column">
					<img id="img2" src="images/batik2.jpg" class="previewimg batiklink" />
				</div>
				<div class="column">
					<img id="img3" src="images/batik3.jpg" class="previewimg batiklink" />
				</div>
			</div>
			<div class="images furnilink">
				<div class="column">
					<img id="img1" src="images/furni_1.jpg" class="previewimg furnilink" />
				</div>
				<div class="column">
					<img id="img2" src="images/furni_2.jpg" class="previewimg furnilink" />
				</div>
				<div class="column">
					<img id="img3" src="images/furni_3.jpg" class="previewimg furnilink" />
				</div>
			</div>
			<div class="images guesthouselink">
				<div class="column">
					<img id="img1" src="images/guest_1.jpg"
						class="previewimg guesthouselink" />
				</div>
				<div class="column">
					<img id="img2" src="images/guest_2.jpg"
						class="previewimg guesthouselink" />
				</div>
				<div class="column">
					<img id="img3" src="images/guest_3.jpg"
						class="previewimg guesthouselink" />
				</div>
			</div>
		</div>
		<div class="foot">
			<p>
				Copyright &copy; 2015 <a
					href="https://www.facebook.com/theodorus.yoga" target="_blank">T&S
					Design and Program Team</a>
			</p>
			<!-- <button id="testremove">CLICK ME TO REMOVE!!!</button>
			<input type="hidden" value="1" id="productid" /> -->
		</div>
	</div>

	<!-- ABOUT US -->
	<div id="aboutusbox" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">About Us</h4>
				</div>
				<form id="loginform">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-4">
								<img src="/images/batik1.png"
									style="max-width: 560px; position: relative;" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 aboutdiv">
								<blockquote id="abouttext">
									<h3>
										<strong>Cupumanik Batik Hadir di Kota Jogja berawal dari
											kecintaan pemilik terhadap batik-batik tulis yang beraneka
											ragam di Indonesia, dan kesungguhan untuk mengangkat hasil
											karya anak bangsa, yaitu para pembatik dan seniman lukis. </strong>
									</h3>
								</blockquote>
								<p>Oleh karena itu, pemilik mulai berinisiatif untuk
									memperkenalkan batik-batik cantiknya kepada rekan, teman-teman
									dan orang-orang di sekitarnya untuk mencintai batik. Cupumanik
									Batik bermula dari membuka sebuah galeri kecil di salah satu
									sudut ruangan rumahnya, semakin lama semakin banyak peminat
									dari batik itu sendiri melalui strategi marketing dari teman ke
									teman lainnya. Akhirnya kini Cupumanik Batik sudah membuka
									galeri khusus untuk koleksi-koleksi batik cantiknya, yaitu di
									Jl. Ringroad Utara No 4A Sawit Sari, Caturtunggal Depok Sleman
									Yogyakarta. Buka hari senin-sabtu dari jam 09:00-19:00 wib,
									Cupumanik Batik menyediakan berbagai macam jenis batik
									Nusantara, Batik tulis abstrak, Batik Tulis klasik, Batik Tulis
									pewarna alam dan jenis-jenis pakaian batik untuk berbagai macam
									usia, baik untuk orang tua, maupun anak-anak, serta berbagai
									aneka tas batik. Bagi anda peminat dan pecinta batik, Cupumanik
									Batik bisa dijadikan sebagai referensi anda untuk memenuhi
									kebutuhan anda akan batik.</p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- CONTACT US -->
	<div id="contactusbox" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Contact Us</h4>
				</div>
				<form id="loginform">
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<h3>
									<iframe
										src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.285349342276!2d110.38723571437622!3d-7.7595316791016025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59af47e65003%3A0xdf8e8c7fb3dcee6e!2sCupumanik+Batik!5e0!3m2!1sen!2sid!4v1449979825410"
										width="100%" height="300" frameborder="0" style="border: 0"
										allowfullscreen></iframe>
								</h3>
							</div>
						</div>
						<div class="phonediv">
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 50%;">
										<span class="glyphicon glyphicon-phone"
											style="font-size: 40px; margin: auto; left: -7.5%;"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 46%;">
										<small style="font-size: 16px; margin: auto;">Phone</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="margin-left: 23%;">
										<h3 style="font-size: 40px; margin: auto; left: -50%;">+62-87838688122</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="phonediv">
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 50%;">
										<div class="bbmlogo">&nbsp;&nbsp;&nbsp;&nbsp;</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 36%;">
										<small style="font-size: 16px; margin: auto;">BlackBerry
											Messenger</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="margin-left: 35%;">
										<h3 style="font-size: 40px; margin: auto; left: -50%;">5A70AE52</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="phonediv">
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 50%;">
										<span class="glyphicon glyphicon-envelope"
											style="font-size: 40px; margin: auto; left: -7.5%;"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="padding-left: 46%;">
										<small style="font-size: 16px; margin: auto;">E-mail</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div style="margin-left: 23%;">
										<h3 style="font-size: 40px; margin: auto; left: -50%;">info@cupumanik.id</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>