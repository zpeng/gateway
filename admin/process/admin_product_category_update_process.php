<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-3";


$product_id = secureRequestParameter($_REQUEST["product_id"]);
$category_id_list = $_REQUEST['category_id_list'];

$product = new Product();
$product->load($product_id);

//set category
$product->set_category_id_list($category_id_list);
$product->updateProductToCategoryList();


$url=$url."&tab_id=".$tab_id;
$url=$url."&product_id=".$product_id;
$msg = "The product category has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


