<?php

// this is always required
require_once('includes/bootstrap.php');
use modules\core\includes\classes\ConfigurationManager;


// to start a session if there is none
if (session_id() == "") {
    session_start();
}

// to setup the configuration
if (!isset($_SESSION['configuration'])) {
    $s_configManager = new ConfigurationManager();
    unset($_SESSION['configuration']);
    $_SESSION['configuration'] = serialize($s_configManager);
} else {
    $str = unserialize($_SESSION['configuration']);
    $s_configManager = ConfigurationManager::cast($str);

    unset($_SESSION['configuration']);
    $_SESSION['configuration'] = serialize($s_configManager);
}

/*
// get Cart
if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
    //create a new cart in session
    $s_cart = new Cart();
    $order = new Order();
    $s_cart->set_order($order);
    $s_cart->set_customer_login(false);

    unset($_SESSION['cart']);
    $_SESSION['cart'] = serialize($s_cart);
} else {
    //reload cart from session
    $str = unserialize($_SESSION['cart']);
    $s_cart = Cart::cast($str);
    unset($_SESSION['cart']);
    $_SESSION['cart'] = serialize($s_cart);
}



// pre-check for certain pages
$page_view = secureRequestParameter($_REQUEST["view"]);
switch ($page_view) {
    case "customer_order_history" :
    case "customer_order_detail" :
    case "customer_address_update" :
    case "customer_detail_update" :
    case "customer_password_update" :
    case "customer_shipping_method_confirm" :
    case "customer_order_confirm" :
    case "customer_order_done" :
        if (!$s_cart->get_customer_login()) {
            header("Location: index.php?view=customer_login");
        }
        break;
}


*/

?>