<?
require_once('../../../includes/bootstrap.php');
use modules\core\includes\classes\User;

$user_id = secureRequestParameter($_REQUEST["user_id"]);
$subscribe_module_code_list = $_REQUEST['subscribe_module_code_list'];

$user = new User();
$user->loadByID($user_id);
$user->user_subscribe_module_code_list = $subscribe_module_code_list;
$user->updateUserSubscribeModuleList();

$response_array['status'] = 'success';
header('Content-type: application/json');
echo json_encode($response_array);
?>
