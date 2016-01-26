<?php
function getBatikFooter() {
	$footer = "";
	$footer .= "<div class=\"footer\">";
	$footer .= "<div class=\"container\">";
	$footer .= "<div class=\"inner-container\">";
	$footer .= "<div class=\"footer-info row\">";
	$footer .= "<div class=\"shop-footer shop-info col-md-4 col-xs-12\">";
	$footer .= "<img class=\"logo\" src=\"../assets/logo-white.png\" style=\"height: 60px\" />";
	$footer .= "<p>Cupumanik Batik Hadir di Kota Jogja berawal dari kecintaan pemilik terhadap batik-batik tulis yang beraneka ragam di Indonesia, dan kesungguhan untuk mengangkat hasil karya anak bangsa, yaitu para pembatik dan seniman lukis. Oleh karena itu, pemilik mulai berinisiatif untuk memperkenalkan batik-batik cantiknya kepada rekan, teman-teman dan orang-orang di sekitarnya untuk mencintai batik. </p>";
	$footer .= "<p>Cupumanik Batik bermula dari membuka sebuah galeri kecil di salah satu sudut ruangan rumahnya, semakin lama semakin banyak peminat dari batik itu sendiri melalui strategi marketing dari teman ke teman lainnya. Akhirnya kini Cupumanik Batik sudah membuka galeri khusus untuk koleksi-koleksi batik cantiknya. </p>";
	$footer .= "</div>";
	$footer .= "<div class=\"shop-footer shop-nav col-md-3 col-xs-12\">";
	$footer .= "<h3>Kategori</h3>";
	$footer .= "<ul>";
	$footer .= printCategories();
	$footer .= "</ul>";
	$footer .= "<h3>Lihat Pula</h3>";
	$footer .= "<ul>";
	$footer .= "<li><a href=\"http://".str_replace('batik', 'guesthouse', $_SERVER['HTTP_HOST'])."\">Cupumanik Guest House</a></li>";
	$footer .= "<li><a href=\"http://".str_replace('batik', 'furniture', $_SERVER['HTTP_HOST'])."\">Cupumanik Furniture</a></li>";
	$footer .= "</ul>";
	$footer .= "</div>";
	$footer .= "<div class=\"shop-footer shop-map col-md-5 col-xs-12\">";
	$footer .= "<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.285349342276!2d110.38723571437622!3d-7.7595316791016025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59af47e65003%3A0xdf8e8c7fb3dcee6e!2sCupumanik+Batik!5e0!3m2!1sen!2sid!4v1449979825410\" width=\"100%\" height=\"300\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>";
	$footer .= "<h4>Alamat</h4>";
	$footer .= "<p>Jl. Ring Road Utara No.4A, Kec. Depok, Sleman,<br/>Daerah Istimewa Yogyakarta 55283, Indonesia</p>";
	$footer .= "<ul>";
	$footer .= "<li>";
	$footer .= "<div class=\"row\">";
	$footer .= "<div class=\"col-xs-1\"><div class=\"icon-div\" style=\"background:url('../assets/1452611475_phone.png') no-repeat center; background-size: contain; width: 24px; height: 24px;\"></div></div>";
	$footer .= "<div class=\"col-xs-11\">0818224469, 087838688122</div>";
	$footer .= "</div>";
	$footer .= "</li>";
	$footer .= "<li>";
	$footer .= "<div class=\"row\">";
	$footer .= "<div class=\"col-xs-1\"><div class=\"icon-div\" style=\"background:url('../assets/1452611566_common-email-envelope-mail-glyph.png') no-repeat center; background-size: contain; width: 24px; height: 24px;\"></div></div>";
	$footer .= "<div class=\"col-xs-11\"><a href=\"mailto:info@cupumanik.co.id\">info@cupumanik.id</a></div>";
	$footer .= "</div>";
	$footer .= "</li>";
	$footer .= "<li>";
	$footer .= "<div class=\"row\">";
	$footer .= "<div class=\"col-xs-1\"><div class=\"icon-div\" style=\"background:url('../assets/1452607783_bbm.png') no-repeat center; background-size: contain; width: 24px; height: 24px;\"></div></div>";
	$footer .= "<div class=\"col-xs-11\">5A70AE52</div>";
	$footer .= "</div>";
	$footer .= "</li>";
	$footer .= "</ul>";
	$footer .= "</div>";
	$footer .= "</div>";
	$footer .= "</div>";
	$footer .= "</div>";
	$footer .= "<div class=\"copyright-info\">";
	$footer .= "<p>Copyright &copy; 2015 <a href=\"https://www.facebook.com/theodorus.yoga\" target=\"_blank\">T&S Design and Program Team</a></p>";
	$footer .= "<p>This site uses Font Awesome by Dave Gandy - http://fontawesome.io</p>";
	$footer .= "</div>";
	$footer .= "</div>";
	
	return $footer;
}

?>