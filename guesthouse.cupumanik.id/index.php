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
'<link rel="stylesheet" href="/cupumanik-guesthouse.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.0/locale/id.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
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
			 sideBySide: true
		});
		$('#end-date').datetimepicker({
			 locale: 'id',
			 sideBySide: true
		});
		$('#start-date').on('dp.change', function(e) {
			$('#end-date').data('DateTimePicker').minDate(e.date);
		});
		$('#end-date').on('dp.change', function(e) {
			$('#start-date').data('DateTimePicker').maxDate(e.date);
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
			<a href="#home">
				<img class="logo" src="../assets/logo-black.png" style="height: 40px" />
			</a>
		</div>
		<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-collapse">
    		<span class="icon-bar"></span>
   			<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
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
                    	<input type='text' id="start-date-input" placeholder="Pilih tanggal check in" class="form-control" />
                    	<span class="input-group-addon datepicker">
                        	<span class="glyphicon glyphicon-calendar"></span>
                    	</span>
                	</div>
				</div>
				<br/>
				<div class="form-group">
                	<div class="input-group date" id='end-date'>
                    	<input type='text' id="end-date-input" placeholder="Pilih tanggal check out" class="form-control" />
                    	<span class="input-group-addon datepicker">
                        	<span class="glyphicon glyphicon-calendar"></span>
                    	</span>
                	</div>
				</div>
				<br/>
				<div>
					<p class="text-danger bg-danger hide" id="date-not-available">Tanggal tidak tersedia</p>
					<p class="text-info bg-info hide" id="date-not-available">Tanggal tersedia</p>
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
		for ($i = 1; $i <= 8; $i++)
		{
			$html .= "<div id=\"gallery-".$i."\" class=\"product-item col-md-3 col-sm-6 col-xs-12\">";
			$html .= "<div id=\"gallery-".$i."-inner\" class=\"product-item-inner\" style=\"background: url('../images/gh".$i.".jpg') no-repeat center; background-size: cover\">";
			$html .= "</div>";
			$html .= "</div>";
		}
		echo $html;
		
		?>
		</div>
	</div>
	
	<br/>
	<hr id="separator" />
	
	<div id="facilities-list" class="product-list-container">
		<h3 class="list-title">Fasilitas</h3>
		<div class="product-list row">
			<div id="facilities-icon-1" class="facilities-icon col-sm-2 col-xs-4 selected">
				<i class="fa fa-bed fa-3x"></i>
				<br/>
				<label>kamar tidur</label>
			</div>
			<div id="facilities-icon-2" class="facilities-icon col-sm-2 col-xs-4">
				<i class="fa fa-wifi fa-3x"></i>
				<br/>
				<label>wifi</label>
			</div>
			<div id="facilities-icon-3" class="facilities-icon col-sm-2 col-xs-4">
				<i class="fa fa-television fa-3x"></i>
				<br/>
				<label>hiburan</label>
			</div>
			<div id="facilities-icon-4" class="facilities-icon col-sm-2 col-xs-4">
				<i class="fa fa-car fa-3x"></i>
				<br/>
				<label>parkir mobil</label>
			</div>
			<div id="facilities-icon-5" class="facilities-icon col-sm-2 col-xs-4">
				<i class="fa fa-clock-o fa-3x"></i>
				<br/>
				<label>layanan 24 jam</label>
			</div>
			<div id="facilities-icon-6" class="facilities-icon col-sm-2 col-xs-4">
				<i class="fa fa-cutlery fa-3x"></i>
				<br/>
				<label>makanan</label>
			</div>
		</div>
		<div id="facilities-desc" class="product-list row">
			<div id="facilities-desc-1" class="facilities-desc">
				<p>Tersedia 3 kamar tidur yang besar dan nyaman. Tiap kamar tidur dilengkapi dengan AC, TV, kamar mandi dalam, dan pemanas air.</p>
			</div>
			<div id="facilities-desc-2" class="facilities-desc">
				<p>Cupumanik Guest House dilengkapi dengan Wi-Fi berkecepatan tinggi yang dapat menunjang kebutuhan internet Anda.</p>
			</div>
			<div id="facilities-desc-3" class="facilities-desc">
				<p>Terdapat 3 TV di tiap kamar dan 1 TV besar di ruang tengah. Anda dapat menikmati saluran terbaik di dunia melalui jaringan TV kabel.</p>
			</div>
			<div id="facilities-desc-4" class="facilities-desc">
				<p>Tersedia parkir mobil yang luas, dapat memuat hingga 5 mobil. Anda juga mendapat fasilitas berenang gratis di kolam renang Pesona Merapi.</p>
			</div>
			<div id="facilities-desc-5" class="facilities-desc">
				<p>Cupumanik Guest House dijaga oleh keamanan 24 jam dan dilengkapi dengan <i>cleaning service</i> untuk menjaga keamanan dan kebersihan.</p>
			</div>
			<div id="facilities-desc-6" class="facilities-desc">
				<p>Pengunjung mendapatkan gratis makan pagi berupa roti dan kopi/teh. Tersedia pula berbagai fasilitas dapur (kompor, dispenser, toaster, kulkas, dll.).</p>
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
					<img class="logo" src="../assets/logo-white.png" style="height: 60px" />
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius tellus orci, nec pharetra sapien aliquet sit amet. Nam suscipit velit non condimentum sollicitudin. Nunc posuere ac est nec accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
					</p>
					<ul>
						<li>
							<div class="row">
								<div class="col-xs-2"><i class="fa fa-phone fa-2x"></i></div>
								<div class="col-xs-10">0888888888888888</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2"><i class="fa fa-envelope fa-2x"></i></div>
								<div class="col-xs-10"><a href="mailto:info@cupumanik.co.id">info@cupumanik.co.id</a></div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2"><i class="fa fa-facebook fa-2x"></i></div>
								<div class="col-xs-10"><a href="http://www.facebook.com/cupumanik">Cupumanik Batik</a></div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-xs-2"><i class="fa fa-twitter fa-2x"></i></div>
								<div class="col-xs-10"><a href="http://www.twitter.com/cupumanikbatik">@cupumanikbatik</a></div>
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
							echo "<li><a href=\"http://".str_replace('guesthouse', 'batik', $_SERVER['HTTP_HOST'])."\">Cupumanik Batik</a></li>";
							echo "<li><a href=\"http://".str_replace('guesthouse', 'furniture', $_SERVER['HTTP_HOST'])."\">Cupumanik Furniture</a></li>";
						?>
					</ul>
				</div>
				<div class="shop-footer shop-map col-md-5 col-xs-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.285349342276!2d110.38723571437622!3d-7.7595316791016025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59af47e65003%3A0xdf8e8c7fb3dcee6e!2sCupumanik+Batik!5e0!3m2!1sen!2sid!4v1449979825410" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
					<h4>
						Alamat
					</h4>
					<p>
						Jl. Ring Road Utara No.4A, Kec. Depok, Sleman,
						<br/>
						Daerah Istimewa Yogyakarta 55283, Indonesia
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
			<p>
				This site uses Font Awesome by Dave Gandy - http://fontawesome.io
			</p>
		</div>
	</div>
</body>
</html>