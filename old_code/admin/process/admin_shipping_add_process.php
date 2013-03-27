<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_shipping_list"; // target of the redirect


$_shipping_type = secureRequestParameter($_REQUEST["shipping_type"]);
$_shipping_cost = secureRequestParameter($_REQUEST["shipping_cost"]);
$_shipping_region_id = secureRequestParameter($_REQUEST["shipping_region"]);
$_shipping_detail = secureRequestParameter($_REQUEST["shipping_detail"]);


$shipping = new Shipping();
$shipping->set_shipping_cost($_shipping_cost);
$shipping->set_shipping_type($_shipping_type);
$shipping->set_shipping_region_id($_shipping_region_id);
$shipping->set_shipping_detail($_shipping_detail);


$shipping->insert();


$msg = "The new Shipping Method [".$_shipping_type."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


