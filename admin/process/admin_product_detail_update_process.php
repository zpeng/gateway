<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-1";


$product_id =  secureRequestParameter($_REQUEST["product_id"]);
$manufacturer_id =  secureRequestParameter($_REQUEST["brand_id"]);
$product_sku = secureRequestParameter($_REQUEST["product_sku"]);
$product_cost = secureRequestParameter($_REQUEST["product_cost"]);
$product_price = secureRequestParameter($_REQUEST["product_price"]);
$product_onsale = secureRequestParameter($_REQUEST["product_onsale"]);
$product_presale_price = secureRequestParameter($_REQUEST["product_presale_price"]);
$product_url = secureRequestParameter($_REQUEST["product_url"]);
$product_weight = secureRequestParameter($_REQUEST["product_weight"]);
$product_stock_level = secureRequestParameter($_REQUEST["product_stock_level"]);
$date_available = secureRequestParameter($_REQUEST["date_available"]);

$product = new Product();
$product->load($product_id);

$product->set_manufacturer_id($manufacturer_id);
$product->set_product_sku($product_sku);
$product->set_product_cost($product_cost);
$product->set_product_price($product_price);
$product->set_product_onsale($product_onsale);
$product->set_product_presale_price($product_presale_price);
$product->set_product_url($product_url);
$product->set_product_weigth($product_weight);
$product->set_product_stock_level($product_stock_level);
$product->set_product_date_available($date_available);


$product->update();


$url=$url."&tab_id=".$tab_id;
$url=$url."&product_id=".$product_id;
$msg = "The product deatils has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


