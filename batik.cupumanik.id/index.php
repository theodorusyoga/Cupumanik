<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cupumanik</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="cupumanik-batik.css">
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
		$('#banner-1').show();
		$('#banner-2').hide();
		$('#banner-3').hide();
		sessionStorage.banner = 1;
		var interval = window.setInterval(function() {
			var index = Number(sessionStorage.banner);
			var nextIndex = index < 3 ? (index + 1) : 1;
			//alert(index);
			$('#banner-' + index).fadeOut(500, function() {
				$('#banner-' + nextIndex).fadeIn(500);
			});
			sessionStorage.banner = nextIndex;
		}, 5000);
	});
</script>
<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/Cupumanik';
$function = $path . '/functions/functions.php';
$header = $path . '/batik.cupumanik.id/header.php';
$footer = $path . '/batik.cupumanik.id/footer.php';
include ($function);
include ($header);
include ($footer);
?>
<script src="../javascript/index.js" type="text/javascript"></script>
</head>
<body>
	<?php echo getBatikHeader(); ?>

	<div id="home-banner">
		<div id="banner-1" class="banner-bg"></div>
		<div id="banner-2" class="banner-bg"></div>
		<div id="banner-3" class="banner-bg"></div>
		<div id="home-content" class="main-body row">
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
							<button id="search-btn" class="btn btn-info">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div id="banner-empty" class="col-sm-7 col-xs-0">
				&nbsp;
			</div>
		</div>
	</div>
	
	<div class="main-body">
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
	</div>

	<?php echo getBatikFooter(); ?>
</body>
</html>