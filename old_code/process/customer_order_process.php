<?php
include_once '../session.php';
include_once '../included/class_loader.php';
include_once '../included/common_functions.php';

//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header( "Location: ../index.php?view=customer_login");
}

$order = new Order();
$order = $s_cart->get_order();


//check if this order is saved already

if ($order->get_order_id() != null) {
    // the order is exists in the database.
    // you can not proceed this order again
    //clean up your shopping_cart
    $error= "This order [".$order->get_order_code()."] has been placed before! Your shopping cart has been clean up.";
    $order = new Order();
    $s_cart->set_order($order);
    unset ($_SESSION['cart']);
    $_SESSION['cart'] = serialize($s_cart);
    
    header( "Location: ../index.php?view=customer_order_history&error=$error");


}else {
    //The order is new, so proceed
    // load the payment method
    $payment_method_id = secureRequestParameter($_REQUEST['payment_method_id']);
    $payment_method = new PaymentMethod();
    $payment_method->load($payment_method_id);
    $order->set_payment_method_id($payment_method_id);

    //assign customer comment
    $customer_comment = secureRequestParameter($_REQUEST['customer_comment']);
    $order->set_customer_comment($customer_comment);

    // assign customer id
    $order->set_customer_id($s_cart->get_customer_id());

    // assign order status
    $order->set_order_status_id(1); // pending from payment

    // assign payment status
    $order->set_payment_status_id(1); // pending from payment

    //assign customer email
    $order->set_customer_email($s_cart->get_customer()->get_email());

    // assign order a unique id
    $order->set_order_code(generateOrderCode($order->get_customer_id()));



    //save into database
    $order->insert();

    //now let's sort out the payment
    $paymentMethod = new PaymentMethod();
    $paymentMethod = $order->get_payment_method();
    $payment_path = $paymentMethod->get_payment_method_include_path();
    //$payment_path = $s_configManager->getValueByKey("domain_name").$paymentMethod->get_payment_method_include_path();
    //$payment_path = $payment_path."?order_code=".$order->get_order_code();

    // clean up the shopping cart
    $new_order = new Order();
    $s_cart->set_order($new_order);
    unset ($_SESSION['cart']);
    $_SESSION['cart'] = serialize($s_cart);


    //now include the paypal file
    include_once "../".$payment_path;
    
    //header( "Location: $payment_path");
}


        ?>
