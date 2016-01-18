<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cupumanik Guest House</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/../css/style.css">
'
<link rel="stylesheet" href="/cupumanik-guesthouse.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png"
	href="http://cupumanik-local.com/assets/cupumanikicon.png" />
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment-with-locales.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/locale/id.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="../javascript/accounting.js"></script>
<script src="../javascript/order.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.scroll').click(function(){
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top	- 50
			}, {
				duration: 500
			});
			return false;
		});
		$('#search-input').keydown(function(e) {
			if (e.keyCode == 13 || e.which == 13)
			{
				search();
			}
		});
		$('#search-btn').click(function() {
			search();
		});
		$('#banner-1').show();
		$('#banner-2').hide();
		$('#banner-3').hide();
		sessionStorage.guesthouseBanner = 1;
		var interval = window.setInterval(function() {
			var index = Number(sessionStorage.banner);
			var nextIndex = index < 3 ? (index + 1) : 1;
			//alert(index);
			$('#banner-' + index).fadeOut(500, function() {
				$('#banner-' + nextIndex).fadeIn(500);
			});
			sessionStorage.guesthouseBanner = nextIndex;
		}, 5000);
		$('.facilities-desc').hide();
		$('#facilities-desc-1').show();
		$('.facilities-icon').bind('mousedown', function() {
			var newId = Number($(this).attr('id').replace('facilities-icon-',''));
			var selectedId = Number($('.facilities-icon.selected').first().attr('id').replace('facilities-icon-',''));
			if (newId != selectedId) {
				$('#facilities-icon-' + selectedId).removeClass('selected');
				$('#facilities-icon-' + newId).addClass('selected');
				$('#facilities-desc-' + selectedId).hide("slide", { direction: (newId > selectedId ? "left" : "right") }, 300, 
					function() {
						$('#facilities-desc-' + newId).show("slide", { direction: (newId > selectedId ? "right" : "left") }, 300)
					});
			}
		});
		$('#start-date').datetimepicker({
			 locale: 'id',
			 sideBySide: true,
			 format: 'dddd, YYYY-MM-D HH:mm'
		});
		$('#end-date').datetimepicker({
			 locale: 'id',
			 sideBySide: true,
			 format: 'dddd, YYYY-MM-D HH:mm'
		});
		$('#start-date').on('dp.change', function(e) {
			$('#end-date').data('DateTimePicker').minDate(e.date);
		});
		$('#end-date').on('dp.change', function(e) {
			$('#start-date').data('DateTimePicker').maxDate(e.date);
		});
		$('#btn-reservation').click(function() {
			var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
			                  "Juli", "Agustus", "September", "Oktober", "November", "Desember"
			                ];
			$('#order-modal').modal({
				backdrop : 'static',
				keyboard : false
			});
			$('#order-confirmation').hide();
			$('#btn-ok').hide();

			/* START DATE */
			var fullstartdate = $('#start-date-input').val();
			var allstartdate = fullstartdate.split(',');
			var startdatestr = allstartdate[1];	
			var date = new Date(startdatestr);
			$('#startday').html(allstartdate[0]);
			$('#startdate').html(date.getDate());
			$('#startmonth').html(monthNames[date.getMonth()] + '<br/>' + date.getFullYear());
			$('#starthour').html(("0" + date.getHours()).slice(-2));
			$('#startminute').html(("0" + date.getMinutes()).slice(-2));

			/* END DATE */
			var fullenddate = $('#end-date-input').val();
			var allenddate = fullenddate.split(',');
			var enddatestr = allenddate[1];	
			var enddate = new Date(enddatestr);
			$('#endday').html(allenddate[0]);
			$('#enddate').html(enddate.getDate());
			$('#endmonth').html(monthNames[enddate.getMonth()] + '<br/>' + enddate.getFullYear());
			$('#endhour').html(("0" + enddate.getHours()).slice(-2));
			$('#endminute').html(("0" + enddate.getMinutes()).slice(-2));
			});
		/* $('#btn-submit').on('click', function() {
			var allFilled = true;
			var customerName = $('input[name=customer-name]').val();
			if (!customerName) {
			      $('#alert-name-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-name-empty').addClass('hide');
			var customerAddress = $('input[name=customer-address]').val();
			if (!customerAddress) {
			      $('#alert-address-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-address-empty').addClass('hide');
			var customerPhone = $('input[name=customer-phone]').val();
			var customerEmail = $('input[name=customer-email]').val();
			if (!customerEmail) {
			      $('#alert-email-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-email-empty').addClass('hide');
			var customerNote = $('#customer-note').val()
			var customerPrice = $('#order-final').find('.order-total-price').first().text();
			if (allFilled) {
				insertOrder(customerName, customerEmail, customerAddress, customerPhone, customerNote,
					function(priceWithCode) {
						var price = accounting.unformat(customerPrice, ',');
						$('#fail-alert').addClass('hide');
						$('.modal-header h4').text('Pemesanan Berhasil');
						$('#form-order').hide();
						$('#order-confirmation').show();
						$('#customer-name-success').text(customerName);
						$('#customer-address-success').text(customerAddress);
						$('#customer-price-success').text(accounting.formatMoney(price, "Rp ", 2, '.', ','));
						$('#customer-email-success').text(customerEmail);
						$('#price-with-code').text(accounting.formatMoney(Number(priceWithCode), "Rp ", 2, '.', ',') + ' *');
						$('#btn-submit').hide();
						$('#btn-ok').show();
						deleteAllOrder();
					}, function(error) {
						$('#fail-alert').text("Terjadi kesalahan, silakan coba ulangi pemesanan\n" + error);
						$('#fail-alert').removeClass('hide');
					});
			}
		}); */
		$('#btn-ok').click(function() {
			window.location.reload(true);
		});
		$('.product-item').bind('mousedown', function() {
			var background = $(this).find('.product-item-inner').first().css('background-image');
			$('#image-big').css('background-image', background);
			$('#image-big').css('background-size', 'cover');
			$('#gallery-modal').modal({
				backdrop : true,
				keyboard : true
			});
		});
	});

</script>
</head>
<body>
<?php
include ($_SERVER ['DOCUMENT_ROOT'] . '/include.php');
?>
	<div class="navbar navbar-default navbar-small navbar-fixed-top">
		<div class="container">
			<div class="navbar-brand pull-left">
				<a href="#home"> <img class="logo" src="../assets/logo-black.png"
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
					<li><a class="scroll" href="#gallery-list">GALERI</a></li>
					<li><a class="scroll" href="#facilities-list">FASILITAS</a></li>
					<li><a class="scroll" href="#about-us">TENTANG KAMI</a></li>
					<li><a class="scroll" href="#home-banner">PESAN</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="home-banner">
		<div id="banner-1" class="banner-bg"></div>
		<div id="banner-2" class="banner-bg"></div>
		<div id="banner-3" class="banner-bg"></div>
		<div id="home-content" class="main-body row">
			<div id="banner-content" class="col-sm-5 col-xs-12">
				<h3>GUEST HOUSE NYAMAN DAN ASRI DI UTARA KOTA YOGYAKARTA</h3>
				<br />
				<hr />
				<p>Pesan sekarang juga</p>
				<br />
				<div id="search-box">
					<div class="form-group">
						<div class="input-group date" id='start-date'>
							<input type='text' id="start-date-input"
								placeholder="Pilih tanggal check in" class="form-control" /> <span
								class="input-group-addon datepicker"> <span
								class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					<br />
					<div class="form-group">
						<div class="input-group date" id='end-date'>
							<input type='text' id="end-date-input"
								placeholder="Pilih tanggal check out" class="form-control" /> <span
								class="input-group-addon datepicker"> <span
								class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					<br />
					<div>
						<p class="text-danger bg-danger hide" id="date-not-available">Tanggal
							tidak tersedia</p>
						<p class="text-info bg-info hide" id="date-not-available">Tanggal
							tersedia</p>
					</div>
					<button class="btn btn-success" id="btn-reservation">Pesan</button>
				</div>
			</div>
			<div id="banner-empty" class="col-sm-7 col-xs-0">&nbsp;</div>
		</div>
	</div>

	<div class="main-body">
		<div id="gallery-list" class="product-list-container">
			<h3 class="list-title">Galeri</h3>
			<div class="product-list row">
		<?php
		$html = "";
		for($i = 1; $i <= 8; $i ++) {
			$html .= "<div id=\"gallery-" . $i . "\" class=\"product-item col-md-3 col-sm-6 col-xs-12\">";
			$html .= "<div id=\"gallery-" . $i . "-inner\" class=\"product-item-inner\" style=\"background: url('../images/gh" . $i . ".jpg') no-repeat center; background-size: cover\">";
			$html .= "</div>";
			$html .= "</div>";
		}
		echo $html;
		
		?>
		</div>
		</div>

		<br />
		<hr id="separator" />

		<div id="facilities-list" class="product-list-container">
			<h3 class="list-title">Fasilitas</h3>
			<div class="product-list row">
				<div id="facilities-icon-1"
					class="facilities-icon col-sm-2 col-xs-4 selected">
					<i class="fa fa-bed fa-3x"></i> <br /> <label>kamar tidur</label>
				</div>
				<div id="facilities-icon-2"
					class="facilities-icon col-sm-2 col-xs-4">
					<i class="fa fa-wifi fa-3x"></i> <br /> <label>wifi</label>
				</div>
				<div id="facilities-icon-3"
					class="facilities-icon col-sm-2 col-xs-4">
					<i class="fa fa-television fa-3x"></i> <br /> <label>hiburan</label>
				</div>
				<div id="facilities-icon-4"
					class="facilities-icon col-sm-2 col-xs-4">
					<i class="fa fa-car fa-3x"></i> <br /> <label>parkir mobil</label>
				</div>
				<div id="facilities-icon-5"
					class="facilities-icon col-sm-2 col-xs-4">
					<i class="fa fa-clock-o fa-3x"></i> <br /> <label>layanan 24 jam</label>
				</div>
				<div id="facilities-icon-6"
					class="facilities-icon col-sm-2 col-xs-4">
					<i class="fa fa-cutlery fa-3x"></i> <br /> <label>makanan</label>
				</div>
			</div>
			<div id="facilities-desc" class="product-list row">
				<div id="facilities-desc-1" class="facilities-desc">
					<p>Tersedia 3 kamar tidur yang besar dan nyaman. Tiap kamar tidur
						dilengkapi dengan AC, TV, kamar mandi dalam, dan pemanas air.</p>
				</div>
				<div id="facilities-desc-2" class="facilities-desc">
					<p>Cupumanik Guest House dilengkapi dengan Wi-Fi berkecepatan
						tinggi yang dapat menunjang kebutuhan internet Anda.</p>
				</div>
				<div id="facilities-desc-3" class="facilities-desc">
					<p>Terdapat 3 TV di tiap kamar dan 1 TV besar di ruang tengah. Anda
						dapat menikmati saluran terbaik di dunia melalui jaringan TV
						kabel.</p>
				</div>
				<div id="facilities-desc-4" class="facilities-desc">
					<p>Tersedia parkir mobil yang luas, dapat memuat hingga 5 mobil.
						Anda juga mendapat fasilitas berenang gratis di kolam renang
						Pesona Merapi.</p>
				</div>
				<div id="facilities-desc-5" class="facilities-desc">
					<p>
						Cupumanik Guest House dijaga oleh keamanan 24 jam dan dilengkapi
						dengan <i>cleaning service</i> untuk menjaga keamanan dan
						kebersihan.
					</p>
				</div>
				<div id="facilities-desc-6" class="facilities-desc">
					<p>Pengunjung mendapatkan gratis makan pagi berupa roti dan
						kopi/teh. Tersedia pula berbagai fasilitas dapur (kompor,
						dispenser, toaster, kulkas, dll.).</p>
				</div>
			</div>
			<!-- <hr id="separator" /> -->
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<div class="inner-container">
				<div class="footer-info row">
					<div id="about-us" class="shop-footer shop-info col-md-4 col-xs-12">
						<img class="logo" src="../assets/logo-white.png"
							style="height: 60px" />
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
							varius tellus orci, nec pharetra sapien aliquet sit amet. Nam
							suscipit velit non condimentum sollicitudin. Nunc posuere ac est
							nec accumsan. Class aptent taciti sociosqu ad litora torquent per
							conubia nostra, per inceptos himenaeos.</p>
						<ul>
							<li>
								<div class="row">
									<div class="col-xs-2">
										<i class="fa fa-phone fa-2x"></i>
									</div>
									<div class="col-xs-10">0888888888888888</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-2">
										<i class="fa fa-envelope fa-2x"></i>
									</div>
									<div class="col-xs-10">
										<a href="mailto:info@cupumanik.co.id">info@cupumanik.co.id</a>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-2">
										<i class="fa fa-facebook fa-2x"></i>
									</div>
									<div class="col-xs-10">
										<a href="http://www.facebook.com/cupumanik">Cupumanik Batik</a>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-xs-2">
										<i class="fa fa-twitter fa-2x"></i>
									</div>
									<div class="col-xs-10">
										<a href="http://www.twitter.com/cupumanikbatik">@cupumanikbatik</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="shop-footer shop-nav col-md-3 col-xs-12">
						<h3>Menu Utama</h3>
						<ul>
							<li><a class="scroll" href="#gallery-list">Galeri</a></li>
							<li><a class="scroll" href="#facilities-list">Fasilitas</a></li>
							<li><a class="scroll" href="#about-us">Tentang Kami</a></li>
							<li><a class="scroll" href="#home-banner">Pemesanan</a></li>
						</ul>
						<h3>Lihat Pula</h3>
						<ul>
						<?php
						echo "<li><a href=\"http://" . str_replace ( 'guesthouse', 'batik', $_SERVER ['HTTP_HOST'] ) . "\">Cupumanik Batik</a></li>";
						echo "<li><a href=\"http://" . str_replace ( 'guesthouse', 'furniture', $_SERVER ['HTTP_HOST'] ) . "\">Cupumanik Furniture</a></li>";
						?>
					</ul>
					</div>
					<div class="shop-footer shop-map col-md-5 col-xs-12">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.285349342276!2d110.38723571437622!3d-7.7595316791016025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59af47e65003%3A0xdf8e8c7fb3dcee6e!2sCupumanik+Batik!5e0!3m2!1sen!2sid!4v1449979825410"
							width="100%" height="300" frameborder="0" style="border: 0"
							allowfullscreen></iframe>
						<h4>Alamat</h4>
						<p>
							Jl. Ring Road Utara No.4A, Kec. Depok, Sleman, <br /> Daerah
							Istimewa Yogyakarta 55283, Indonesia
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright-info">
			<p>
				Copyright &copy; 2015 <a
					href="https://www.facebook.com/theodorus.yoga" target="_blank">T&S
					Design and Program Team</a>
			</p>
			<p>This site uses Font Awesome by Dave Gandy - http://fontawesome.io
			</p>
		</div>
	</div>

	<div id="order-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title main-title">Form Pemesanan</h4>
				</div>
				<div class="modal-body">
					<div id="form-order">
						<div id="order-final">
							<h4 class="main-title">Detail Pemesanan Anda</h4>
							<p>Silakan review kembali tanggal check-in dan tanggal check-out
								yang Anda isikan.</p>
							<div class="row">
								<div class="col-xs-6">
									<p>Tanggal Check-In</p>
									<time datetime="2014-09-20" class="icon">
										<em id="startday">Saturday</em> <strong id="startmonth">September
										</strong> <span id="startdate">20</span>
									</time> 
									<div class="timeclock">
										<div class="hour" id="starthour">00</div>
										<span>:</span>
										<div class="minute" id="startminute">00</div>
									</div>
								</div>
								<div class="col-xs-6">
									<p>Tanggal Check-Out</p>
									<time datetime="2014-09-20" class="icon">
										<em id="endday">Saturday</em> <strong id="endmonth">September 2016</strong> <span id="enddate">20</span>
									</time>
									<div class="timeclock">
										<div class="hour" id="endhour">00</div>
										<span>:</span>
										<div class="minute" id="endminute">00</div>
									</div>
								</div>
							</div>
						</div>
						<hr />
						<p id="fail-alert" class="alert alert-danger hide"></p>
						<h4 class="main-title">Isikan data diri anda</h4>
						<form role="form">
							<div class="form-group row">
								<label class="control-label col-xs-3">Nama Lengkap <span
									class="important-mark">*</span></label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm"
										name="customer-name" required>
									<p id="alert-name-empty" class="text-danger bg-danger hide">Nama
										wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Alamat Pengiriman <span
									class="important-mark">*</span>
								</label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm"
										name="customer-address" required>
									<p id="alert-address-empty" class="text-danger bg-danger hide">Alamat
										wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Nomor Telepon/HP</label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm"
										name="customer-phone">
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Email <span
									class="important-mark">*</span>
								</label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm"
										name="customer-email" required>
									<p id="alert-email-empty" class="text-danger bg-danger hide">Email
										wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Keterangan/Informasi
									Tambahan </label>
								<div class="col-xs-9">
									<textarea rows="4" class="form-control input-sm"
										id="customer-note"></textarea>
								</div>
							</div>
						</form>
					</div>
					<div id="order-confirmation">
						<div class="order-summary">
							<div class="row">
								<label class="col-xs-5">Kode Pemesanan</label> <label
									class="col-xs-1">:</label> <label class="col-xs-6">82VCM7K91</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Nama Pemesan</label> <label
									class="col-xs-1">:</label> <label id="customer-name-success"
									class="col-xs-6">Orang Ketiga</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Total Harga</label> <label
									class="col-xs-1">:</label> <label id="customer-price-success"
									class="col-xs-6">Rp 2.679.000,00</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Alamat Pengiriman</label> <label
									class="col-xs-1">:</label> <label id="customer-address-success"
									class="col-xs-6">Orang Ketiga</label>
							</div>
						</div>
						<p>
							Detail pemesanan sudah dikirim ke email <strong
								id="customer-email-success">orangketiga@blablabla.com</strong>
						</p>
						<hr />
						<p>Harap segera melakukan transfer sejumlah:</p>
						<h2 id="price-with-code" class="main-title">Rp 2.679.091,00 *</h2>
						<p>
							Ke rekening <strong>111111111111111 (Cupumanik Batik)</strong>
							paling lambat 24 jam setelah pemesanan ini dilakukan. Jika dalam
							24 jam pengiriman tidak dilakukan, pemensanan dianggap batal.
						</p>
						<br /> <small>* tambahan 2 angka sebagai kode pemesanan</small>
					</div>
				</div>
				<div class="modal-footer">
					<button id="btn-submit" class="btn btn-info">Proses Pemesanan</button>
					<button id="btn-ok" class="btn btn-success">OK</button>
				</div>
			</div>

		</div>
	</div>

	<div id="gallery-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<div id="image-big">
						<button type="button"
							class="btn btn-lg btn-primary close pull-right"
							data-dismiss="modal">
							<span class="glyphicon glyphicon-remove"></span>
						</button>
						<div style="width: 1000px; height: 400px"></div>

					</div>
				</div>
			</div>

		</div>
	</div>
</body>
</html>