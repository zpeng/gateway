<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_brand_list"; // target of the redirect

$brand_id = secureRequestParameter($_REQUEST["brand_id"]);

$brand = new Manufacturer();
$brand->load($brand_id);
$brand->delete();


$msg = "The brand/manufacturer [".$brand->get_manufacturer_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


