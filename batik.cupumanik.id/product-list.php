<?php
function print_product_list($list, $title, $id)
{
	$html = "";
	$html .= "<div id=\"".$id."\" class=\"product-list-container\">";
	$html .= "<h3 class=\"list-title\">".$title."</h3>";
	
	if (isset($list))
	{
		if (count($list) > 0)
		{
			$html .= "<div class=\"product-list row\">";
			foreach ($list as $item)
			{
				$html .= "<div id=\"product-".$item->id."\" class=\"product-item col-md-3 col-sm-6 col-xs-12\">";
				$html .= "<div id=\"product-".$item->id."-inner\" class=\"product-item-inner\" style=\"background: url('..".$item->imageurl."') no-repeat center; background-size: cover\">";
				$html .= "<div id=\"product-".$item->id."-info-small\" class=\"product-info-small\">";
				$html .= "<span><h3 class=\"product-title\">".$item->title."</h3></span>";
				$html .= "</div>";
				$html .= "<a href=\""."/product.php?id=".$item->id."\" id=\"product-4-info\" class=\"product-info\"><span>";
				$html .= "<h3 class=\"product-title\">".$item->title."</h3>";
				$html .= "<h5 class=\"product-price\">".$item->price."</h5>";
				$html .= "</span>";
				$html .= "</a>";
				$html .= "</div>";
				$html .= "</div>";
			}
		}
		else 
			$html .= printProductNotFound();
	}
	else
		$html .= printProductNotFound();
	
	
	$html .= "</div>";
	$html .= "</div>";
	return $html;
}
?>