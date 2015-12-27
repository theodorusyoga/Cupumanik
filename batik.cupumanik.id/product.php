<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Produk 1</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="cupumanik-batik.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="../javascript/accounting.js"></script>
<script src="../javascript/order.js" type="text/javascript"></script>
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
		$('.product-gallery-item').bind('mousedown', function() {
			var background = $(this).css('background-image');
			//alert(background);
			$('.product-image').css('background-image', background);
			$('.product-image').css('background-repeat', 'no-repeat');
			$('.product-image').css('background-position', 'center');
			$('.product-image').css('background-size', 'cover');
			$('.product-gallery-item').removeClass('selected');
			$(this).addClass('selected');
		});
	});

	function placeorder(id, name, price, stock) {
		var qty = Number($('input[id=selected-product-qty]').val());
		var orderitem = addOrder(id, name, price, stock, qty);
		$('#order-item-count').text(orderitem);
		canOrder(id);
	}

	function canOrder(id)
	{
		var orderexist = checkOrderExist(id);
		$('#button-order').attr('disabled', orderexist);
	}
	
</script>
<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/Cupumanik';
$function = $path . '/functions/functions.php';
$product = $path . '/functions/getProductById.php';
$header = $path . '/batik.cupumanik.id/header.php';
$footer = $path . '/batik.cupumanik.id/footer.php';
include ($function);
include ($product);
include ($header);
include ($footer);
?>
</head>
<body>
<?php 
	echo getBatikHeader();
	?>
	
	<div class="main-body">
	<?php 
	
	if (isset($_GET['id']))
	{
		$singleproduct = getProductById($_GET['id']);
		if ($singleproduct)
		{?>
		<script type="text/javascript">
		$(document).ready(function() {
			canOrder(<?php echo $singleproduct->id; ?>);
		});
		</script>
		<div id="product-detail">
		<div class="product-detail-content row">
			<div class="product-picture col-sm-5 col-xs-12">
			<?php 
				echo "<div class=\"product-image\" style=\"background-image: url('..".$singleproduct->imageurl."'); background-repeat: no-repeat; background-position: center;  background-size: cover\"></div>";
				echo "<div class=\"product-gallery row\">";
				echo "<div class=\"product-gallery-item selected col-xs-4\" title=\"Klik untuk melihat detail gambar\" style=\"background-image: url('..".$singleproduct->imageurl."'); background-repeat: no-repeat; background-position: center; background-size: cover\"></div>";
				echo "<div class=\"product-gallery-item col-xs-4\" title=\"Klik untuk melihat detail gambar\" style=\"background-image: url('..".$singleproduct->imageurl."'); background-repeat: no-repeat; background-position: center;  background-size: cover\"></div>";
				echo "<div class=\"product-gallery-item col-xs-4\" title=\"Klik untuk melihat detail gambar\" style=\"background-image: url('..".$singleproduct->imageurl."'); background-repeat: no-repeat; background-position: center;  background-size: cover\"></div>";
				echo "<div class=\"product-gallery-item col-xs-4\" title=\"Klik untuk melihat detail gambar\" style=\"background-image: url('..".$singleproduct->imageurl."'); background-repeat: no-repeat; background-position: center;  background-size: cover\"></div>";
				echo "</div>"
			?>
			</div>
			<div class="product-detail col-sm-7 col-xs-12">
				<div class="product-header row">
					<div class="col-xs-6">
						<h2 class="product-title"><?php echo $singleproduct->title; ?></h2>
					</div>
					<div class="col-xs-6">
						<h3 class="product-price pull-right"><?php echo $singleproduct->price; ?></h3>
					</div>
				</div>
				<br/>
				<p class="product-description"><?php echo $singleproduct->description;?></p>
				<br/>
				<h5 class="product-stock">Stok tersisa: <strong><?php echo $singleproduct->stock; ?></strong></h5>
				<br/>
				<hr/>
				<h3 class="list-title">Pesan:</h3>
				<div id="order-box">
					<div class="input-group">
						<?php echo "<input type=\"number\" min=\"1\" max=\"".$singleproduct->stock."\" step=\"1\" value=\"1\" id=\"selected-product-qty\" class=\"order-qty form-control\" />" ?>
       					<div class="input-group-btn">
           					<?php echo "<button id=\"button-order\" onclick=\"placeorder(".$singleproduct->id.",'".$singleproduct->title."',".$singleproduct->price.",".$singleproduct->stock.")\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-plus\"></span>Tambahkan ke daftar belanja</button>"; ?>
       					</div>
       				</div>
				</div>
		</div>
		</div>
		<hr/>
		<h3 class="list-title">Produk Terkait</h3>
		<div class="product-list row">
			<div id="product-1" class="product-item col-md-3 col-sm-6 col-xs-12" >
				<div id="product-1-inner" class="product-item-inner" style="background: url('../assets/produk-baru-1.jpg') no-repeat center; background-size: cover">
					<div id="product-1-info-small" class="product-info-small">
						<span><h3 class="product-title">Jas Batik</h3></span>
					</div>
					<a href="#product-1" id="product-1-info" class="product-info">
						<span>
							<h3 class="product-title">Jas Batik</h3>
							<h5 class="product-price">1820000</h5>
						</span>
					</a>
				</div>
			</div>	
			<div id="product-2" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-2-inner" class="product-item-inner" style="background: url('../assets/produk-baru-2.jpg') no-repeat center; background-size: cover">
					<div id="product-2-info-small" class="product-info-small">
						<span><h3 class="product-title">Dasi Batik</h3></span>
					</div>
					<a href="#product-2" id="product-2-info" class="product-info">
						<span>
							<h3 class="product-title">Dasi Batik</h3>
							<h5 class="product-price">103000</h5>
						</span>
					</a>
				</div>
			</div>	
			<div id="product-3" class="product-item col-md-3 col-sm-6 col-xs-12" >
				<div id="product-3-inner" class="product-item-inner" style="background: url('../assets/produk-baru-3.jpg') no-repeat center; background-size: cover">
					<div id="product-3-info-small" class="product-info-small">
						<span><h3 class="product-title">Hijab Batik</h3></span>
					</div>
					<a href="#product-3" id="product-3-info" class="product-info">
						<span>
							<h3 class="product-title">Hijab Batik</h3>
							<h5 class="product-price">152000</h5>
						</span>
					</a>
				</div>
			</div>	
			<div id="product-4" class="product-item col-md-3 col-sm-6 col-xs-12">
				<div id="product-4-inner" class="product-item-inner" style="background: url('../assets/produk-baru-4.jpg') no-repeat center; background-size: cover">
					<div id="product-4-info-small" class="product-info-small">
						<span><h3 class="product-title">Dress Batik Short</h3></span>
					</div>
					<a href="#product-4" id="product-4-info" class="product-info">
						<span>
							<h3 class="product-title">Dress Batik Short</h3>
							<h5 class="product-price">282000</h5>
						</span>
					</a>
				</div>
			</div>	
		</div>
	</div>
			
			<?php
		}
		else 
			echo printProductNotFound();
	}
	else 
		printProductNotFound();
	?>
	</div>
	<?php 

	echo getBatikFooter(); ?>
</body>
</html>