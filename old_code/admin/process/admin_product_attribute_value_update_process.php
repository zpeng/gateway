<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_product_update"; // target of the redirect
$tab_id ="Tabs-4";


$product_id = secureRequestParameter($_REQUEST["product_id"]);
$product_attribute_value_id_list = $_REQUEST["product_attribute_value_id_list"];
$product = new Product();
$product->load($product_id);
$product->set_product_attribute_value_id_list($product_attribute_value_id_list);

$product->update_product_attribute_value_List();

$url=$url."&product_id=".$product_id;
$url=$url."&tab_id=".$tab_id;
$msg = "The product attribute value has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


