<?php

require_once('../included/class_loader.php') ;

$customer_id = secureRequestParameter($_REQUEST["customer_id"]);


$b_address = new Address();
$b_address->set_recipients(secureRequestParameter($_REQUEST["b_recipients"]));
$b_address->set_street(secureRequestParameter($_REQUEST["b_street"]));
$b_address->set_city(secureRequestParameter($_REQUEST["b_city"]));
$b_address->set_postcode(secureRequestParameter($_REQUEST["b_postcode"]));
$b_address->set_state(secureRequestParameter($_REQUEST["b_state"]));
$b_address->set_country(secureRequestParameter($_REQUEST["b_country"]));
$b_address->set_customer_id($customer_id);
$b_address->set_address_type("billing");
$b_address->replace();

$d_address = new Address();
$d_address->set_recipients(secureRequestParameter($_REQUEST["d_recipients"]));
$d_address->set_street(secureRequestParameter($_REQUEST["d_street"]));
$d_address->set_city(secureRequestParameter($_REQUEST["d_city"]));
$d_address->set_postcode(secureRequestParameter($_REQUEST["d_postcode"]));
$d_address->set_state(secureRequestParameter($_REQUEST["d_state"]));
$d_address->set_country(secureRequestParameter($_REQUEST["d_country"]));
$d_address->set_customer_id($customer_id);
$d_address->set_address_type("delivery");
$d_address->replace();


header( "Location: ../index.php?view=customer_address_update&info=Client address has been updated" );

?>
