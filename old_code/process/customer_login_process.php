<?php

require_once('../included/class_loader.php');

$_email = secureRequestParameter($_REQUEST["email"]);
$_password = secureRequestParameter($_REQUEST["password"]);

$customerManager = new CustomerManager();
$result = $customerManager->customerLogin($_email, $_password);


if ($result == 0) {
    header("Location: ../index.php?view=customer_login&error=Wrong username or password!");
} else {

    // to start a session if there is none
    if (session_id() == "") {
        session_start();
    }

    $customer = new Customer();
    $customer->loadById($result);


    // get Cart
    if (!isset($_SESSION['cart'])) {
        //create a new cart in session
        $s_cart = new Cart();
        $order = new Order();
        $order->set_customer_id($customer->get_customer_id());
        $s_cart->set_order($order);
        $s_cart->set_customer_login(true);
        $s_cart->set_customer_id($customer->get_customer_id());
        $s_cart->set_customer($customer);

        unset($_SESSION['cart']);
        $_SESSION['cart'] = serialize($cart);
       
        header("Location: ../index.php");
    } else {
        //reload cart from session
        $str = unserialize($_SESSION['cart']);
        $s_cart = Cart::cast($str);

//        $order = new Order();
//        $s_cart->set_order($order);
//        $s_cart->set_customer_login(true);
//        $s_cart->set_customer_id($customer->get_customer_id());
//        $s_cart->set_customer($customer);

        $s_cart->set_customer($customer);
        $s_cart->set_customer_id($customer->get_customer_id());
        $s_cart->set_customer_login(true);

        unset($_SESSION['cart']);
        $_SESSION['cart'] = serialize($s_cart);

        header("Location: ../index.php?view=shopping_cart");
    }
}
?>
