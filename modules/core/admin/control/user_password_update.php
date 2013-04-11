<?
require_once('../../../../includes/bootstrap.php');


$user_id = secureRequestParameter($_REQUEST["user_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);
$new_password = secureRequestParameter($_REQUEST["password"]);

$user = new User();
$user->loadByID($user_id);
$user->updatePassword($new_password);

$url = SERVER_URL."admin/main.php?module_code=".$module_code."&view=user_list"; // target of the redirect
$msg = "The password for user account [".$user->get_user_name()."] has been updated";
$url=$url."&info=".$msg;

header( "Location: ".$url );
?>
