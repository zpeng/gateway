<?
require_once('../../../../includes/bootstrap.php');


$user_id = secureRequestParameter($_REQUEST["user_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);
$subscribe_module_code_list = $_REQUEST['subscribe_module_code_list'];

$user = new User();
$user->loadByID($user_id);
$user->user_subscribe_module_code_list = $subscribe_module_code_list;
$user->updateUserSubscribeModuleList();

$url = SERVER_URL."admin/main.php?module_code=".$module_code."&view=user_list"; // target of the redirect
$msg = "The module subscription for user account [".$user->get_user_name()."] has been updated";
$url=$url."&info=".$msg;

header( "Location: ".$url );
?>
