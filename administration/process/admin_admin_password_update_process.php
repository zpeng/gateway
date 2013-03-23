<?
require_once('../../included/class_loader.php') ;
$url = "../index.php?view=admin_admin_password_update"; // target of the redirect

$admin_id = secureRequestParameter($_REQUEST["admin_id"]);
$password = secureRequestParameter($_REQUEST["password"]);

$admin = new Administrator();
$admin->loadByID($admin_id);
$admin->updatePassword($password);

$msg = "The password for administrator [".$admin->get_admin_name()."] has been updated.";
$url=$url."&info=".$msg."&admin_id=".$admin_id;
header( "Location: ".$url );

?>
