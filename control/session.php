<?php

// this is always required
require_once('includes/bootstrap.php');
use modules\core\includes\classes\ConfigurationManager;
use modules\deal_steal\includes\classes\Order;

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


// get order
if (!isset($_SESSION['client_order']) || $_SESSION['client_order'] == null) {
    //create a new order in session if there is no
    $client_order = new Order();
    unset($_SESSION['cart']);
    $_SESSION['client_order'] = serialize($client_order);
} else {
    //reload order from session
    $str = unserialize($_SESSION['client_order']);
    $client_order = Order::cast($str);
    unset($_SESSION['client_order']);
    $_SESSION['client_order'] = serialize($client_order);
}


// pre-check for certain pages, the following only allow login client to access
$page_view = secureRequestParameter($_REQUEST["view"]);
switch ($page_view) {
    case "shopping_cart" :
        if (!$_SESSION['client_is_login']) {
            header("Location: index.php?view=login");
        }
        break;
}

?>