<?php

require_once('../included/class_loader.php') ;

$customer_id = secureRequestParameter($_REQUEST["customer_id"]);

$customer = new Customer();
$customer->loadById($customer_id);
$customer->set_firstname(secureRequestParameter($_REQUEST["firstname"]));
$customer->set_lastname(secureRequestParameter($_REQUEST["lastname"]));
if (secureRequestParameter($_REQUEST["newsletter"]) == "on") {
    $customer->set_newsletter("Y");
}else {
    $customer->set_newsletter("N");
}
$customer->set_mobile(secureRequestParameter($_REQUEST["mobile"]));
$customer->set_telephone(secureRequestParameter($_REQUEST["telephone"]));
$customer->updateCustomerDetail();


// to start a session if there is none
if (session_id() == "" ) {
    session_start();
}

    // get Cart
    if (!isset ($_SESSION['cart'])) {
        //create a new cart in session
        $s_cart = new Cart();
        $order = new Order();
        $order->set_customer_id($customer->get_customer_id());
        $s_cart->set_order($order);
        $s_cart->set_customer_login(true);
        $s_cart->set_customer_id($customer->get_customer_id());
        $s_cart->set_customer($customer);

        unset ($_SESSION['cart']);
        $_SESSION['cart'] = serialize($cart);
    }else {
        //reload cart from session
        $str =  unserialize($_SESSION['cart']);
        $s_cart = Cart::cast($str);

        $s_cart->set_customer($customer);
        unset ($_SESSION['cart']);
        $_SESSION['cart'] = serialize($s_cart);
    }

header( "Location: ../index.php?view=customer_detail_update&info=Client detail has been updated" );

?>
