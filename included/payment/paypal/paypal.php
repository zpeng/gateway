<?php
include_once '../included/payment/paypal/configuration.php';
include_once '../included/class_loader.php';
include_once '../session.php';


//$order_code= $_REQUEST["order_code"];
$orderManager = new OrderManager();

if ( $order->get_order_code() != "" && $orderManager->checkOrderExist($order->get_order_code()) ) {
    //Order Detail
    $customer_email = $order->get_customer_email();
    $company_name = $s_configManager->getValueByKey("shop_name");
    $order_code = $order->get_order_code();
    $amount_before_shipping = $order->get_order_total_amount_exclude_shipping();
    $currency_code = $s_configManager->getValueByKey("currency_Name");
    $shipping_cost = $order->get_shipping_cost();
    $customer_name = $order->get_customer()->get_full_name();
    $customer_address = $order->get_shipping_address();

    //hacked the paypal cancel url, return me the order code
    $cancelURL = $cancelURL."?order_code=".$order_code;

    echo "Please do not close your page and wait it to be redirect to paypal...";

    $buffer = "
            <form action='$url' method='post' name='frmPayPal'>\n
            <input type='hidden' name='redirect_cmd' value='_xclick'>
            <input type='hidden' name='cmd' value='_ext-enter'>
            <input type='hidden' name='business' value='$ppAcc'>
            <input type='hidden' name='email' value='$customer_email'>
            <input type='hidden' name='item_name' value='$company_name'>
            <input type='hidden' name='item_number' value='$order_code'>
            <input type='hidden' name='amount' value='$amount_before_shipping'>
            <input type='hidden' name='no_shipping' value='1'>
            <input type='hidden' name='currency_code' value='$currency_code'>
            <input type='hidden' name='handling' value='$shipping_cost'>
            <input type='hidden' name='cancel_return' value='$cancelURL'>
            <input type='hidden' name='return' value='$returnURL'>
            <input type='hidden' name='custom' value='$order_code'>
            <input type='hidden' name='customer_name' value='$customer_name'>
            <input type='hidden' name='customer_address' value='$customer_address'>
            </form>
            <script language='javascript'>document.frmPayPal.submit();</script>";

    echo $buffer;

}else {
    //Redirect to order done page
    $url = "../index.php?view=customer_order_done&payment_type=paypal&result=failed&order_code=".$order_code;
    header( "Location: $url");
}

?>
