<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_payment_method_update"; // target of the redirect


$payment_method_name =        secureRequestParameter($_REQUEST["payment_method_name"]);
$payment_method_include_path =secureRequestParameter($_REQUEST["payment_method_include_path"]);


$paymentMethod = new PaymentMethod();
$paymentMethod->set_payment_method_name($payment_method_name);
$paymentMethod->set_payment_method_include_path($payment_method_include_path);

$paymentMethod->insert();

$msg = "Please complete the payment method detail.";
$url=$url."&info=".$msg;
$url=$url."&payment_method_id=".$paymentMethod->get_payment_method_id();
header( "Location: ".$url );

?>


