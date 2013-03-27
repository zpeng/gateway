<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_attribute_list"; // target of the redirect


$attribute_name = secureRequestParameter($_REQUEST["attribute_name"]);

$attribute = new Attribute();
$attribute->set_attribute_name($attribute_name);

$attribute->insert();

$msg = "The new attribute [".$attribute_name."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


