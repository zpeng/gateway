<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_attribute_list"; // target of the redirect


$attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);

$attribute = new Attribute();
$attribute->load($attribute_id);


$attribute->delete();

$msg = "The new attribute [".$attribute->get_attribute_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


