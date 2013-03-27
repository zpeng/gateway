<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_category_list"; // target of the redirect

$category_id = secureRequestParameter($_REQUEST["category_id"]);
$category_name = secureRequestParameter($_REQUEST["category_name"]);
$category_description = secureRequestParameter($_REQUEST["category_description"]);

$category = new Category();
$category->load($category_id);

$category->set_category_name($category_name);
$category->set_category_desc($category_description);


$category->update();

$msg = "The category [".$category_name."] has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


