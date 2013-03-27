<?
require_once('../../included/class_loader.php');
$url = "../index.php?view=admin_admin_list"; // target of the redirect

$admin_id = secureRequestParameter($_REQUEST["admin_id"]);

$admin = new Administrator();
$admin->loadByID($admin_id);
$admin->delete();


$msg = "Administrator account for [".$admin->get_admin_name()."] has been deleted";
$url=$url."&info=".$msg;
header( "Location: ".$url );

?>
