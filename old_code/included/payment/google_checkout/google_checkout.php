<?php

include_once '../included/payment/google_checkout/configuration.php';
include_once '../included/class_loader.php';
include_once '../session.php';


//$order_code= $_REQUEST["order_code"];
$orderManager = new OrderManager();

if ($order->get_order_code() != "" && $orderManager->checkOrderExist($order->get_order_code())) {


    //Order Detail
    $customer_email = $order->get_customer_email();
    $company_name = $s_configManager->getValueByKey("shop_name");
    $order_code = $order->get_order_code();
    $amount_before_shipping = $order->get_order_total_amount_exclude_shipping();
    $currency_code = $s_configManager->getValueByKey("currency_Name");
    $shipping_cost = $order->get_shipping_cost();
    $customer_name = $order->get_customer()->get_full_name();
    $customer_address = $order->get_shipping_address();
    $shipping = new Shipping();
    $shipping = $order->get_shipping_method();
    $shipping_type = $shipping->get_shipping_type();

    //hacked the paypal cancel url, return me the order code
    $cancelURL = $cancelURL . "?order_code=" . $order_code;

    echo "Please do not close your page and wait it to be redirect to google checkout...";

    $buffer = "
    <form method='post' action='$url' accept-charset='utf-8' name='frmGoogleCheckout'>\n

    <input type='hidden' name='item_name_1' value='$company_name'/>
    <input type='hidden' name='item_description_1' value='$order_code'/>
    <input type='hidden' name='item_quantity_1' value='1'/>
    <input type='hidden' name='item_price_1' value='$amount_before_shipping'/>
    <input type='hidden' name='item_currency_1' value='$currency_code'/>

    <input type='hidden' name='ship_method_name_1' value='$shipping_type'/>
    <input type='hidden' name='ship_method_price_1' value='$shipping_cost'/>
    <input type='hidden' name='ship_method_currency_1' value='$currency_code'/>

    <input type='hidden' name='_charset_'/>
    
    </form>
    <script language='javascript'>document.frmGoogleCheckout.submit();</script>";

    echo $buffer;
} else {
    //Redirect to order done page
    $url = "../index.php?view=customer_order_done&payment_type=paypal&result=failed&order_code=" . $order_code;
    header("Location: $url");
}
?>
