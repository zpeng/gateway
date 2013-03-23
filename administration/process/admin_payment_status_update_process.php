<?php

require_once('../../included/class_loader.php') ;
require_once('../../included/common_functions.php');

$url = "../index.php?view=admin_order_update"; // target of the redirect
$tab_id = secureRequestParameter($_REQUEST["tab_id"]);
$order_id = secureRequestParameter($_REQUEST["order_id"]);
$payment_status_id =  secureRequestParameter($_REQUEST["payment_status_id"]);

$order = new Order();
$order->loadByID($order_id);
$order->updateOrderPaymentStatus($payment_status_id);


$url=$url."&tab_id=".$tab_id;
$url=$url."&order_id=".$order_id;
$msg = "The payment status has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );
?>

