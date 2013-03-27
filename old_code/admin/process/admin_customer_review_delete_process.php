<?php

require_once('../../included/class_loader.php');
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_customer_update"; // target of the redirect
$tab_id ="Tabs-4";

$review_id = secureRequestParameter($_REQUEST["review_id"]);
$customer_id = secureRequestParameter($_REQUEST["customer_id"]);



$review = new Review();
$review->load($review_id);

$product = new Product();
$product->load($review->get_product_id());


$review->delete();



$url=$url."&tab_id=".$tab_id;
$url=$url."&customer_id=".$customer_id;
$msg = "The customer review for product [".$product->getProductDescriptionByLanguageID(1)->get_product_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

