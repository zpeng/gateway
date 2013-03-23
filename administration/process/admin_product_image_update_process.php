<?php

require_once('../../included/class_loader.php') ;
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-5";

$product_id =secureRequestParameter($_REQUEST["product_id"]);
$product_image_id =secureRequestParameter($_REQUEST["product_image_id"]);

$productImageManager = new ProductImageManager();
$productImageManager->set_product_id($product_id);
$productImageManager->updateImageListDefaultSetting($product_image_id);


$url=$url."&tab_id=".$tab_id;
$url=$url."&product_id=".$product_id;
$msg = "The product gallery has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

