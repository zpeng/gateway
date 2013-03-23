<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_shipping_region_list"; // target of the redirect


$_shipping_region = secureRequestParameter($_REQUEST["shipping_region"]);


$shippingRegion = new ShippingRegion();
$shippingRegion->set_shipping_region($_shipping_region);


$shippingRegion->insert();


$msg = "The new Shipping Region [".$_shipping_region."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


