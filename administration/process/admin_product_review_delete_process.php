<?php

require_once('../../included/class_loader.php') ;
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-6";

$review_id = secureRequestParameter($_REQUEST["review_id"]);
$product_id = secureRequestParameter($_REQUEST["product_id"]);

$review = new Review();
$review->load($review_id);
$review->delete();


$url=$url."&tab_id=".$tab_id;
$url=$url."&product_id=".$product_id;
$msg = "The product review from client [".$review->get_customer()->get_full_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

