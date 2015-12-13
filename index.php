<html>
<head>
<title>Cupumanik.id - Welcome</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"
	type="text/javascript"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script src="../Cupumanik/javascript/function.js" type="text/javascript"></script>
</head>
<?php include('/template/functions.php') ?>
<body style="background-color: #000000">
	<div class="header">
		<div class="subheader">
			<img class="logo" src="assets/logo-black.png" />
		</div>
	</div>
	<div class="menu">
		<ul class="list">
			<li><a class="link" href="/batik">ABOUT US</a></li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp; <a class="link" href="#">CONTACT US</a>
			</li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp; <a class="link" href="#" target="_blank">FACEBOOK</a>
			<li>&nbsp;&nbsp;&nbsp;&nbsp; <a class="link" href="#" target="_blank">TWITTER</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</li>
		</ul>
	</div>
	<div class="main">
		<div class="overlay"></div>
		<span class="coverage">&nbsp;</span>
		<div class="content">
			<div class="submain">
				<ul class="list">
					<li><a id="batiklink" class="link" href="/batik">Batik</a>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</p></li>
					<li><a id="furnilink" class="link" href="#">Furniture</a>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</p></li>
					<li><a id="guesthouselink" class="link" href="#">Guesthouse</a></li>
				</ul>
			</div>
		</div>
		<div class="preview">
			<div class="previewcontent">&nbsp;</div>
			<div class="images batiklink">
				<div class="column">
					<img id="img1" src="images/batik1.png" class="previewimg batiklink" />
				</div>
				<div class="column">
					<img id="img2" src="images/batik2.png" class="previewimg batiklink" />
				</div>
				<div class="column">
					<img id="img3" src="images/batik3.png" class="previewimg batiklink" />
				</div>
			</div>
			<div class="images furnilink">
				<div class="column">
					<img id="img1" src="images/home.png" class="previewimg furnilink" />
				</div>
				<div class="column">
					<img id="img2" src="images/home.png" class="previewimg furnilink" />
				</div>
				<div class="column">
					<img id="img3" src="images/home.png" class="previewimg furnilink" />
				</div>
			</div>
			<div class="images guesthouselink">
				<div class="column">
					<img id="img1" src="images/home.png"
						class="previewimg guesthouselink" />
				</div>
				<div class="column">
					<img id="img2" src="images/home.png"
						class="previewimg guesthouselink" />
				</div>
				<div class="column">
					<img id="img3" src="images/home.png"
						class="previewimg guesthouselink" />
				</div>
			</div>
		</div>
		<div class="foot">
			<p>
				Copyright &copy; 2015 <a
					href="https://www.facebook.com/theodorus.yoga" target="_blank">T&S
					Design and Program Team</a>
					<?php echo(getProducts()); ?>
			</p>
		</div>
	</div>

</body>
</html>