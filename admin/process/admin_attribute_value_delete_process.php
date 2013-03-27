<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_attribute_value_list"; // target of the redirect


$_attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);
$_attribute_value_id = secureRequestParameter($_REQUEST["attribute_value_id"]);


$attribute_value = new AttributeValue();
$attribute_value->load($_attribute_value_id);



$attribute_value->delete();

$url=$url."&attribute_id=".$_attribute_id;

$msg = "The new attribute value[".$attribute_value->get_attribute_value()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


