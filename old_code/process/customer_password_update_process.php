<?php

require_once('../included/class_loader.php') ;

$password = secureRequestParameter($_REQUEST["password"]);
$customer_id = secureRequestParameter($_REQUEST["customer_id"]);

$customer = new Customer();
$customer->loadById($customer_id);
$customer->set_password(md5($password));

$customer->updateCustomerPassword();


header( "Location: ../index.php?view=customer_password_update&info=Client password has been updated" );

?>
