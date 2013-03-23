<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-2";


$product_id = secureRequestParameter($_REQUEST["product_id"]);
$product = new Product();
$product->load($product_id);

$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

$productDescList = null;
$count=0;
if (sizeof($languageList) > 0) {
    $language = new Language();
    foreach($languageList as $language) {
        $productDescription = new ProductDescription();
        $productDescription = $product->getProductDescriptionByLanguageID($language->get_language_id());

        if ($productDescription != null) {

            $product_name = secureRequestParameter($_REQUEST["product_name".$productDescription->get_language_id()]);
            $product_desc = $_REQUEST["product_desc".$productDescription->get_language_id()];
            
            $productDescription->set_product_name($product_name);
            $productDescription->set_product_description($product_desc);
         
        }else {
            $productDescription = new ProductDescription();
           
            $product_name = secureRequestParameter($_REQUEST["product_name".$productDescription->get_language_id()]);
            $product_desc = $_REQUEST["product_desc".$productDescription->get_language_id()];
            $productDescription->set_product_description_id(0); // id 0 marks it as new record for later insert
            $productDescription->set_product_name($product_name);
            $productDescription->set_product_description($product_desc);
            $productDescription->set_language_id($language->get_language_id());
            $productDescription->set_product_id($product_id);
        }
        $productDescList[$count] = $productDescription;
        $count++;
    }
}

$product->set_product_description_list($productDescList);

$product->updateProductDescriptionList();

$url=$url."&product_id=".$product_id;
$url=$url."&tab_id=".$tab_id;
$msg = "The product description has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


