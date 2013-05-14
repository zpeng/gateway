<?
require_once('../../../../includes/bootstrap.php');
use modules\core\includes\classes\User;

$user_id = secureRequestParameter($_REQUEST["user_id"]);
$module_code = secureRequestParameter($_REQUEST["module_code"]);

$user = new User();
$user->loadByID($user_id);
$user->delete();

$url = SERVER_URL."admin/main.php?module_code=".$module_code."&view=user_list"; // target of the redirect
$msg = "User account for [".$user->get_user_name()."] has been deleted";
$url=$url."&info=".$msg;

header( "Location: ".$url );

?>
