<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_shipping_region_list"; // target of the redirect


$shipping_region_id = secureRequestParameter($_REQUEST["shipping_region_id"]);


$shippingRegion = new ShippingRegion();
$shippingRegion->load($shipping_region_id);

$shippingRegion->delete();


$msg = "The shipping region [".$shippingRegion->get_shipping_region()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


