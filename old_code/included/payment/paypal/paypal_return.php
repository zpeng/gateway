<?php
include_once 'configuration.php';
include_once '../../class_loader.php';

//to start a session if there is none
if (session_id() == "" ) {
    session_start();
}


$tx = $_REQUEST["tx"]; //this value is return by PayPal
$cmd = "_notify-synch";
$post = "tx=$tx&at=$at&cmd=$cmd";

//Send request to PayPal server using CURL
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);

$result = curl_exec ($ch); //returned result is key-value pair string
$error = curl_error($ch);

if (curl_errno($ch) != 0) //CURL error
    exit("ERROR: Failed updating order. PayPal PDT service failed.");

$longstr = str_replace("\r", "", $result);
$lines = split("\n", $longstr);

//echo "payment result: ".$lines ."<br/><br/>";

//parse the result string and store information to array
if ($lines[0] == "SUCCESS") {
    //successful payment
    $ppInfo = array();
    for ($i=1; $i<count($lines); $i++) {
        $parts = split("=", $lines[$i]);
        if (count($parts)==2) {
            $ppInfo[$parts[0]] = urldecode($parts[1]);
        }
    }

    $curtime = gmdate("d/m/Y H:i:s");
    //capture the PayPal returned information as order remarks
    $oremarks = "##$curtime##\n".
            "PayPal Transaction Information...\n".
            "Txn Id: ".$ppInfo["txn_id"]."\n".
            "Txn Type: ".$ppInfo["txn_type"]."\n".
            "Item Number: ".$ppInfo["item_number"]."\n".
            "Payment Date: ".$ppInfo["payment_date"]."\n".
            "Payment Type: ".$ppInfo["payment_type"]."\n".
            "Payment Status: ".$ppInfo["payment_status"]."\n".
            "Currency: ".$ppInfo["mc_currency"]."\n".
            "Payment Gross: ".$ppInfo["payment_gross"]."\n".
            "Payment Fee: ".$ppInfo["payment_fee"]."\n".
            "Payer Email: ".$ppInfo["payer_email"]."\n".
            "Payer Id: ".$ppInfo["payer_id"]."\n".
            "Payer Name: ".$ppInfo["customer_name"]."\n".
            "Payer Status: ".$ppInfo["payer_status"]."\n".
            "Country: ".$ppInfo["residence_country"]."\n".
            "Business: ".$ppInfo["business"]."\n".
            "Receiver Email: ".$ppInfo["receiver_email"]."\n".
            "Receiver Id: ".$ppInfo["receiver_id"]."\n";

    //Update database using $orderno, set status to Paid
    $order_code =$ppInfo["item_number"];
    $order = new Order();
    $order->loadByCode($order_code);
    $order->updateOrderPaymentStatus(2); // payment received
    $order->updateOrderStatus(2); // Due to delivery (Payment receive)
    $customer_id = $order->get_customer_id();
    $customer = new Customer();
    $customer->loadById($customer_id);

    //if the session is lost during the transaction, then receate everything
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
        // if the session is not lost, get session back
        $s_cart = new Cart();
        $str =  unserialize($_SESSION['cart']);
        $s_cart = Cart::cast($str);

        // if the session is not for the right client
        // unset the old one and set the new client session
        if ($s_cart->get_customer_id() != $customer_id) {
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
            unset ($_SESSION['cart']);
            $_SESSION['cart'] = serialize($s_cart);
        }
    }

    //Redirect to order done page
    $url = "../../../index.php?view=customer_order_done&payment_type=paypal&result=success&order_code=".$order_code;
    header( "Location: $url");


}else {
    //The payment is  failed
    $ppInfo = array();
    for ($i=1; $i<count($lines); $i++) {
        $parts = split("=", $lines[$i]);
        if (count($parts)==2) {
            $ppInfo[$parts[0]] = urldecode($parts[1]);
        }
    }

    //Update database using $orderno, set status to Paid
    $order_code =$ppInfo["item_number"];
    $order = new Order();
    $order->loadByCode($order_code);
    $order->updateOrderPaymentStatus(3); // payment failed
    $order->updateOrderStatus(5); // Cancelled
    $customer_id = $order->get_customer_id();
    $customer = new Customer();
    $customer->loadById($customer_id);


    //if the session is lost during the transaction, then receate everything
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
        // if the session is not lost, get session back
        $s_cart = new Cart();
        $str =  unserialize($_SESSION['cart']);
        $s_cart = Cart::cast($str);
        
        // if the session is not for the right client
        // unset the old one and set the new client session
        if ($s_cart->get_customer_id() != $customer_id) {
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
            unset ($_SESSION['cart']);
            $_SESSION['cart'] = serialize($s_cart);
        }
    }

    //Redirect to order done page
    $url = "../../../index.php?view=customer_order_done&payment_type=paypal&result=failed&order_code=".$order_code;
    header( "Location: $url");

}
?>
