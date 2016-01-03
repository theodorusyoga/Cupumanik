<?php
function getBatikHeader() {
	$header = "";
	$header .= "<script type=\"text/javascript\">";
	$header .= "$(document).ready(function() {";
	$header .= "var orderitem = getOrderCount();";
	$header .= "$('#order-item-count').text(orderitem);";
	$header .= "});";
	$header .= "</script>";
	$header .= "<div class=\"navbar navbar-default navbar-small navbar-fixed-top\">";
	$header .= "<div class=\"container\">";
	$header .= "<div class=\"navbar-brand pull-left\">";
	$header .= "<a href=\"/\"><img class=\"logo\" src=\"../assets/logo-black.png\" style=\"height: 40px\" /></a>";
	$header .= "</div>";
	$header .= "<button type=\"button\" class=\"navbar-toggle pull-right\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">";
    $header .= "<span class=\"icon-bar\"></span>";
   	$header .= "<span class=\"icon-bar\"></span>";
    $header .= "<span class=\"icon-bar\"></span>";
  	$header .= "</button>";
	$header .= "<div class=\"navbar-collapse collapse pull-right\">";
	$header .= "<ul class=\"nav navbar-nav nav-menu\">";
	$header .= printCategories();
	$header .= "<li><a href=\"order.php\">DAFTAR BELANJA <strong>(<span id=\"order-item-count\">0</span>)</strong></a></li>";
	$header .= "</ul>";
	$header .= "</div>";
	$header .= "</div>";
	$header .= "</div>";
	return $header;
}

?>