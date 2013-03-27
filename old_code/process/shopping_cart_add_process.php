<?php
include_once '../session.php';


//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header( "Location: ../index.php?view=customer_login");
}

$order = new Order();
$order = $s_cart->get_order();

$product_id = secureRequestParameter($_REQUEST['product_id']);
$quantity = secureRequestParameter($_REQUEST['quantity']);

$product = new Product();
$product->load($product_id);

$orderProduct = new OrderProduct();
$orderProduct->set_order_quantity($quantity);
$orderProduct->set_product_id($product_id);
$orderProduct->set_selling_price($product->get_product_price());

$order->addOrderProduct($orderProduct);


unset ($_SESSION['cart']);
$_SESSION['cart'] = serialize($s_cart);

header( "Location: ../index.php?view=shopping_cart");


?>
