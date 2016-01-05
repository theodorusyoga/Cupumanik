<?php
function print_gallery($list)
{
	$html = "";
	$html .= "<div id=\"".$id."\" class=\"product-list-container\">";
	$html .= "<h3 class=\"list-title\">Galeri</h3>";
	
	if (isset($list))
	{
		if (count($list) > 0)
		{
			$html .= "<div class=\"product-list row\">";
			foreach ($list as $item)
			{
				$html .= "<div id=\"product-".$item->id."\" class=\"product-item col-md-3 col-sm-6 col-xs-12\">";
				$html .= "<div id=\"product-".$item->id."-inner\" class=\"product-item-inner\" style=\"background: url('..".$item->imageurl."') no-repeat center; background-size: cover\">";
				$html .= "</div>";
				$html .= "</div>";
			}

			$html .= "</div>";
		}
		else 
			$html .= printProductNotFound();
	}
	else
		$html .= printProductNotFound();
	
	$html .= "</div>";
	return $html;
}
?>