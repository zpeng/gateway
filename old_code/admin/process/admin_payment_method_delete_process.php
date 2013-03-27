<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_payment_method_list"; // target of the redirect

$paymentMethod_id = secureRequestParameter($_REQUEST["payment_method_id"]);

$paymentMethod = new PaymentMethod();
$paymentMethod->load($paymentMethod_id);
$paymentMethod->delete();


$msg = "The payment method [".$paymentMethod->get_payment_method_name()."] has been deleted.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


