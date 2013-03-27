<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_attribute_value_list"; // target of the redirect


$_attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);
$_attribute_value = secureRequestParameter($_REQUEST["attribute_value"]);


$attribute_value = new AttributeValue();
$attribute_value->set_attribute_id($_attribute_id);
$attribute_value->set_attribute_value($_attribute_value);



$attribute_value->insert();

$url=$url."&attribute_id=".$_attribute_id;

$msg = "The new attribute [".$attribute_name."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


