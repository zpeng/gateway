<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_brand_update"; // target of the redirect


$brand_name = secureRequestParameter($_REQUEST["brand_name"]);

$brand = new Manufacturer();
$brand->set_manufacturer_name($brand_name);

$brand->insert();

$msg = "Please complete the brand/manufacturer detail.";
$url=$url."&info=".$msg;
$url=$url."&brand_id=".$brand->get_manufacturer_id();
header( "Location: ".$url );

?>


