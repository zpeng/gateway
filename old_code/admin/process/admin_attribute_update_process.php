<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_attribute_list"; // target of the redirect

$attribute_id =  secureRequestParameter($_REQUEST["attribute_id"]);
$attribute_name =secureRequestParameter($_REQUEST["attribute_name"]);


$attribute = new Attribute();
$attribute->load($attribute_id);
$attribute->set_attribute_name($attribute_name);


$attribute->update();

$msg = "The attribute [".$attribute_name."] has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


