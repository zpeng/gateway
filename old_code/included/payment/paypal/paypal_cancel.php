<?php
include_once 'configuration.php';
include_once '../../class_loader.php';

//to start a session if there is none
if (session_id() == "" ) {
    session_start();
}

$order_code = secureRequestParameter($_REQUEST["order_code"]);

//Update database using $orderno, set status to Paid
$order = new Order();
$order->loadByCode($order_code);
$order->updateOrderPaymentStatus(3); // payment failed
$order->updateOrderStatus(5); // Cancelled
$customer_id = $order->get_customer_id();
$customer = new Customer();
$customer->loadById($customer_id);



//Redirect to order done page
$url = "../../../index.php?view=customer_order_done&payment_type=paypal&result=cancel&order_code=".$order_code;
header( "Location: $url");
?>
