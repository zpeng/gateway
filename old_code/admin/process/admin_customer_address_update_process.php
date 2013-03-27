<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_customer_update"; // target of the redirect


$tab_id = secureRequestParameter($_REQUEST["tab_id"]);
$customer_id = secureRequestParameter($_REQUEST["customer_id"]);
$address_type = secureRequestParameter($_REQUEST["address_type"]);


if ($address_type == "billing") {
    $recipients = secureRequestParameter($_REQUEST["b_recipients"]);
    $street = secureRequestParameter($_REQUEST["b_street"]);
    $city = secureRequestParameter($_REQUEST["b_city"]);
    $postcode = secureRequestParameter($_REQUEST["b_postcode"]);
    $state = secureRequestParameter($_REQUEST["b_state"]);
    $country = secureRequestParameter($_REQUEST["b_country"]);
}

if ($address_type == "delivery") {
    $recipients = secureRequestParameter($_REQUEST["d_recipients"]);
    $street = secureRequestParameter($_REQUEST["d_street"]);
    $city = secureRequestParameter($_REQUEST["d_city"]);
    $postcode = secureRequestParameter($_REQUEST["d_postcode"]);
    $state = secureRequestParameter($_REQUEST["d_state"]);
    $country = secureRequestParameter($_REQUEST["d_country"]);
}

$address = new Address();

$address->set_recipients($recipients);
$address->set_street($street);
$address->set_city($city);
$address->set_postcode($postcode);
$address->set_state($state);
$address->set_country($country);
$address->set_customer_id($customer_id);
$address->set_address_type($address_type);



$address->replace();


$url=$url."&tab_id=".$tab_id;
$url=$url."&customer_id=".$customer_id;
$msg = "The customer ".$address_type." address has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


