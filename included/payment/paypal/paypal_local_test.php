<?php

// this file for testing under the local machine
$test_payment_result = true;

include_once '../session.php';
include_once '../included/class_loader.php';

//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header( "Location: ../index.php?view=customer_login");
}



if ($test_payment_result) {


    $order_code = $order->get_order_code();
    $order->updateOrderPaymentStatus(2); // payment received
    $order->updateOrderStatus(2); // Due to delivery (Payment receive)


    //Redirect to thank you page
    $url = "../index.php?view=customer_order_done&payment_type=paypal&result=success&order_code=".$order_code;
    header( "Location: $url");
}else {



    $order_code = $order->get_order_code();

    $order->updateOrderPaymentStatus(3); // payment failed
    $order->updateOrderStatus(5); // Cancelled

    //Redirect to order done page
    $url = "../index.php?view=customer_order_done&payment_type=paypal&result=failed&order_code=".$order_code;
    header( "Location: $url");
}


?>
