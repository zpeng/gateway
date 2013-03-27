<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_category_list"; // target of the redirect

$category_id = secureRequestParameter($_REQUEST["category_id"]);

$category = new Category();
$category->load($category_id);
$category->delete();


$msg = "The category [".$category->get_category_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


