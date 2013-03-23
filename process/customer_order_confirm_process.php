<?php
include_once '../session.php';


//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header( "Location: ../index.php?view=customer_login");
}

$order = new Order();
$order = $s_cart->get_order();

// assign shipping detail to the order
$shipping_method_id = secureRequestParameter($_REQUEST['shipping_id']);
$shipping_method = new Shipping();
$shipping_method->load($shipping_method_id);
$order->set_shipping_id($shipping_method_id);
$order->set_shipping_cost($shipping_method->get_shipping_cost());

$shippingAddress = new Address();
$shippingAddress->set_recipients(secureRequestParameter($_REQUEST["d_recipients"]));
$shippingAddress->set_street(secureRequestParameter($_REQUEST["d_street"]));
$shippingAddress->set_city(secureRequestParameter($_REQUEST["d_city"]));
$shippingAddress->set_postcode(secureRequestParameter($_REQUEST["d_postcode"]));
$shippingAddress->set_state(secureRequestParameter($_REQUEST["d_state"]));
$shippingAddress->set_country(secureRequestParameter($_REQUEST["d_country"]));
$shippingAddress->set_customer_id($customer_id);
$shippingAddress->set_address_type("delivery");
$order->set_shipping_address($shippingAddress->outputAsHTMLString());




unset ($_SESSION['cart']);
$_SESSION['cart'] = serialize($s_cart);

header( "Location: ../index.php?view=customer_order_confirm");
?>
