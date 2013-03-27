<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_category_list"; // target of the redirect

$category_parent_id = secureRequestParameter($_REQUEST["category_parent_id"]);
$category_name =secureRequestParameter($_REQUEST["category_name"]);
$category_description =secureRequestParameter($_REQUEST["category_description"]);

$category = new Category();
$category->set_category_parent_id($category_parent_id);
$category->set_category_name($category_name);
$category->set_category_desc($category_description);

$category->insert();

$msg = "The new category [".$category_name."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


