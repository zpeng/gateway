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


if(isset($_POST['renmoveOrderProduct'])){
    //remove that Product
    $order->removeOrderProdcutFromList($product_id);
}

if(isset($_POST['updateOrderQuantity'])){
    //update the orderProduct Quantity
    $order->updateOrderProdcutQuantity($product_id, $quantity);
}

 
unset ($_SESSION['cart']);
$_SESSION['cart'] = serialize($s_cart);

header( "Location: ../index.php?view=shopping_cart");


?>
