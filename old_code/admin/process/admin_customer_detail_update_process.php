<?php

require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_customer_update"; // target of the redirect
$tab_id ="Tabs-1";


$customer_id = secureRequestParameter($_REQUEST["customer_id"]);


$firstname = secureRequestParameter($_REQUEST["firstname"]);
$lastname =  secureRequestParameter($_REQUEST["lastname"]);
$telephone = secureRequestParameter($_REQUEST["telephone"]);
$mobile =    secureRequestParameter($_REQUEST["mobile"]);
$newsletter =secureRequestParameter($_REQUEST["newsletter"]);


$customer = new Customer();
$customer->loadById($customer_id);

$customer->set_firstname($firstname);
$customer->set_lastname($lastname);
$customer->set_telephone($telephone);
$customer->set_mobile($mobile);
$customer->set_newsletter($newsletter);



$customer->updateCustomerDetail();


$url=$url."&tab_id=".$tab_id;
$url=$url."&customer_id=".$customer_id;
$msg = "The customer deatils has been updated.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


