<?php

require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_admin_list"; // target of the redirect


$_email = secureRequestParameter($_REQUEST["email"]);
$_password =md5(secureRequestParameter($_REQUEST["password"]));

$admin = new Administrator();
$admin->set_admin_name($_email);
$admin->set_admin_password($_password);

$admin->insert();

$msg = "The new administrator account [".$admin->get_admin_name()."] has been created.";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>


