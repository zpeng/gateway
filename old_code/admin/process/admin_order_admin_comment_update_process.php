<?php

require_once('../../included/class_loader.php');
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_order_update"; // target of the redirect
$tab_id =secureRequestParameter($_REQUEST["tab_id"]);
$order_id = secureRequestParameter($_REQUEST["order_id"]);
$admin_comment =  secureRequestParameter($_REQUEST["admin_comment"]);

$order = new Order();
$order->loadByID($order_id);
$order->updateOrderAdminComment($admin_comment);


$url=$url."&tab_id=".$tab_id;
$url=$url."&order_id=".$order_id;
$msg = "The administrator comment has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

