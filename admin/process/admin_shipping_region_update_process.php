<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_shipping_region_update"; // target of the redirect


$_shipping_region_id = secureRequestParameter($_REQUEST["shipping_region_id"]);
$_shipping_region = secureRequestParameter($_REQUEST["shipping_region"]);

$shippingRegion = new ShippingRegion();
$shippingRegion->load($_shipping_region_id);
$shippingRegion->set_shipping_region($_shipping_region);

$shippingRegion->update();

$url = $url."&shipping_region_id=".$_shipping_region_id;
$msg = "The Shipping Region [".$_shipping_region."] has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


