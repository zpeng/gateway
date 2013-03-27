<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_menu_list"; // target of the redirect

$menu_id = secureRequestParameter($_REQUEST["menu_id"]);
$menu = new Menu();
$menu->load($menu_id);

$menu->delete();

$msg = "The Menu Item has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


