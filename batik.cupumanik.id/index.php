<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Cupumanik Batik</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="/../css/style.css">
'<link rel="stylesheet" href="/cupumanik-batik.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="../javascript/accounting.js"></script>
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
		$('.product-price').each(function() {
			var price = Number($(this).text());
			$(this).text(accounting.formatMoney(price, "Rp ", 2, '.', ','));
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

	function search()
	{
		var query = $('#search-input').val();
		<?php 
			echo 'window.location.href = ("http://'.$_SERVER['HTTP_HOST'].'/search.php?query=" + query);';		
		?>
		
	}
</script>
</head>
<body>
<?php
	include ($_SERVER ['DOCUMENT_ROOT'] . '/include.php');
	?>
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
			<div id="banner-empty" class="col-sm-7 col-xs-0">&nbsp;</div>
		</div>
	</div>

	<div class="main-body">
		<?php 
			$newproductlist = getNewProducts();
			echo print_product_list($newproductlist, "Produk Terbaru", "new-product-list");
			$topproductlist = getTopProducts();
			echo print_product_list($topproductlist, "Produk Terlaris", "top-product-list");
		?>
	</div>

	<?php echo getBatikFooter(); ?>
</body>
</html>