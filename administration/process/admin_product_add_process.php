<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_product_update"; // target of the redirect


$_brand_id = secureRequestParameter($_REQUEST["brand_id"]);
$_date_available = secureRequestParameter($_REQUEST["date_available"]);
$_stock_level = secureRequestParameter($_REQUEST["stock_level"]);
$_product_sku = secureRequestParameter($_REQUEST["product_sku"]);


$product = new Product();
$product->set_manufacturer_id($_brand_id);
$product->set_product_date_available($_date_available);
$product->set_product_stock_level($_stock_level);
$product->set_product_sku($_product_sku);

$product_id = $product->insert();
$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();
if (sizeof($languageList) > 0) {
    $language = new Language();
    foreach($languageList as $language) {
        $product_name = secureRequestParameter($_REQUEST["product_name".$language->get_language_id()]);

        $product_desc = new ProductDescription();
        $product_desc->set_language_id($language->get_language_id());
        $product_desc->set_product_id($product_id);
        $product_desc->set_product_name($product_name);

        $product_desc->insert();
    }
}


$url = $url."&product_id=".$product_id;
$msg = "Please complete the product information.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


