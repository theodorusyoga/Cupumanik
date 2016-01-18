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
<link rel="stylesheet" href="cupumanik-furniture.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="shortcut icon" type="image/png" href="http://cupumanik-local.com/assets/cupumanikicon.png"/>
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
	});
</script>
<?php
	include_once( $_SERVER ['DOCUMENT_ROOT'].'/include.php');
?>
<script src="../javascript/index.min.js" type="text/javascript"></script>
</head>
<body>
	<?php echo getBatikHeader(); ?>
	
	<div class="main-body">
	<?php 
		if (isset($_GET['id']))
		{
			$category = getCategoryById($_GET['id']);
			if (!is_null($category))
			{
				?>
				<h2 class="main-title"><?php echo $category->categoryname; ?></h2>
				<hr/>
				<?php
				$productlist = getProductByCategory($_GET['id']);
				echo print_product_list($productlist, "Daftar Barang", "product-category-list");
			}
			else echo printProductNotFound();
		}
		else echo printProductNotFound();
	?>
	</div>

	<?php echo getBatikFooter(); ?>
</body>
</html>