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
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="cupumanik-style.css">
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.product-info').hide();
		$('.product-item').bind('mouseenter', function() {
			//$(this).find('.product-info').show('slide', {direction: 'up'});
			$(this).find('.product-info').show();
			$(this).find('.product-info-small').hide();
		});
		$('.product-item').bind('mouseleave', function() {
			//$(this).find('.product-info').hide();
			$(this).find('.product-info').hide();
			$(this).find('.product-info-small').show();
		});
	});
</script>
<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/Cupumanik';
$path .= '/functions/functions.php';
include ($path);
?>
<script src="../javascript/index.js" type="text/javascript"></script>
</head>
<body>
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
					<?php echo printCategories();?>
					<li><a href="#shoppinglist">DAFTAR BELANJA <strong>(0)</strong></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="home-banner">
		<div id="home-content" class="row">
			<div id="banner-content" class="col-sm-5 col-xs-12">
				<h3>BATIK EKSKLUSIF TERBAIK DI YOGYAKARTA</h3>
				<br />
				<hr />
				<p>Lebih dari 100 koleksi batik dan kain batik terbaik ada di sini.
					Temukan favorit anda di sini</p>
				<br />
				<div id="search-box">
					<div class="input-group">
						<input type="Search" id="search-input"
							placeholder="Cari busana atau kain batik" class="form-control" />
						<div class="input-group-btn">
							<button class="btn btn-info">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-7 col-xs-0">&nbsp;</div>
		</div>
	</div>

	<div id="new-product-list" class="product-list-container">
		<h3 class="list-title">Produk Terbaru</h3>
		<div class="product-list row">
			<div id="product-1" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-1-inner" class="product-item-inner"
					style="background: url('../assets/produk-baru-1.jpg') no-repeat center; background-size: cover">
					<div id="product-1-info-small" class="product-info-small">
						<span><h3 class="product-title">Jas Batik</h3></span>
					</div>
					<a href="#product-1" id="product-1-info" class="product-info"> <span>
							<h3 class="product-title">Jas Batik</h3>
							<h5 class="product-price">Rp 1.820.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-2" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-2-inner" class="product-item-inner"
					style="background: url('../assets/produk-baru-2.jpg') no-repeat center; background-size: cover">
					<div id="product-2-info-small" class="product-info-small">
						<span><h3 class="product-title">Dasi Batik</h3></span>
					</div>
					<a href="#product-2" id="product-2-info" class="product-info"> <span>
							<h3 class="product-title">Dasi Batik</h3>
							<h5 class="product-price">Rp 103.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-3" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-3-inner" class="product-item-inner"
					style="background: url('../assets/produk-baru-3.jpg') no-repeat center; background-size: cover">
					<div id="product-3-info-small" class="product-info-small">
						<span><h3 class="product-title">Hijab Batik</h3></span>
					</div>
					<a href="#product-3" id="product-3-info" class="product-info"> <span>
							<h3 class="product-title">Hijab Batik</h3>
							<h5 class="product-price">Rp 152.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-4" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-4-inner" class="product-item-inner"
					style="background: url('../assets/produk-baru-4.jpg') no-repeat center; background-size: cover">
					<div id="product-4-info-small" class="product-info-small">
						<span><h3 class="product-title">Dress Batik Short</h3></span>
					</div>
					<a href="#product-4" id="product-4-info" class="product-info"> <span>
							<h3 class="product-title">Dress Batik Short</h3>
							<h5 class="product-price">Rp 282.000,00</h5>
					</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div id="top-product-list" class="product-list-container">
		<h3 class="list-title">Produk Terlaris</h3>
		<div class="product-list row">
			<div id="product-1" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-1-inner" class="product-item-inner"
					style="background: url('../assets/produk-laris-1.jpg') no-repeat center; background-size: cover">
					<div id="product-1-info-small" class="product-info-small">
						<span><h3 class="product-title">T-shirt Batik Cokelat</h3></span>
					</div>
					<a href="#product-1" id="product-1-info" class="product-info"> <span>
							<h3 class="product-title">T-shirt Batik Cokelat</h3>
							<h5 class="product-price">Rp 129.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-2" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-2-inner" class="product-item-inner"
					style="background: url('../assets/produk-laris-2.jpg') no-repeat center; background-size: cover">
					<div id="product-2-info-small" class="product-info-small">
						<span><h3 class="product-title">Selendang Batik Sutera</h3></span>
					</div>
					<a href="#product-2" id="product-2-info" class="product-info"> <span>
							<h3 class="product-title">Selendang Batik Sutera</h3>
							<h5 class="product-price">Rp 372.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-3" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-3-inner" class="product-item-inner"
					style="background: url('../assets/produk-laris-3.jpg') no-repeat center; background-size: cover">
					<div id="product-3-info-small" class="product-info-small">
						<span><h3 class="product-title">T-shirt Batik Biru</h3></span>
					</div>
					<a href="#product-3" id="product-3-info" class="product-info"> <span>
							<h3 class="product-title">T-shirt Batik Biru</h3>
							<h5 class="product-price">Rp 152.000,00</h5>
					</span>
					</a>
				</div>
			</div>
			<div id="product-4" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-4-inner" class="product-item-inner"
					style="background: url('../assets/produk-laris-4.jpg') no-repeat center; background-size: cover">
					<div id="product-4-info-small" class="product-info-small">
						<span><h3 class="product-title">Rok Batik Panjang Multicorak</h3></span>
					</div>
					<a href="#product-4" id="product-4-info" class="product-info"> <span>
							<h3 class="product-title">Rok Batik Panjang Multicorak</h3>
							<h5 class="product-price">Rp 225.000,00</h5>
					</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<div class="inner-container">
				<div class="footer-info row">
					<div class="shop-footer shop-info col-md-4 col-xs-12">
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
						<h3>Kategori</h3>
						<ul>
							<li><a href="#BatikPria">Batik Pria</a></li>
							<li><a href="#BatikWanita">Batik Wanita</a></li>
						</ul>
						<h3>Lihat Pula</h3>
						<ul>
							<li><a href="#CupumanikGuesthouse">Cupumanik Guest House</a></li>
							<li><a href="#CupumanikFurniture">Cupumanik Furniture</a></li>
						</ul>
					</div>
					<div class="shop-footer shop-map col-md-5 col-xs-12">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.285349342276!2d110.38723571437622!3d-7.7595316791016025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59af47e65003%3A0xdf8e8c7fb3dcee6e!2sCupumanik+Batik!5e0!3m2!1sen!2sid!4v1449979825410"
							width="100%" height="350" frameborder="0" style="border: 0"
							allowfullscreen></iframe>
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
</body>
</html>