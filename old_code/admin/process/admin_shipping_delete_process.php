<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_shipping_list"; // target of the redirect


$shipping_id = secureRequestParameter($_REQUEST["shipping_id"]);


$shipping = new Shipping();
$shipping->load($shipping_id);

$shipping->delete();


$msg = "The shipping method [".$shipping->get_shipping_type()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


