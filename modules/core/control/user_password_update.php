<?
require_once('../../../includes/bootstrap.php');
use modules\core\includes\classes\User;

$user_id = secureRequestParameter($_REQUEST["user_id"]);
$new_password = secureRequestParameter($_REQUEST["password"]);

$user = new User();
$user->loadByID($user_id);
$result = $user->updatePassword($new_password);

if ($result){
    $response_array['status'] = 'success';
}else{
    $response_array['status'] = 'error';
}
header('Content-type: application/json');
echo json_encode($response_array);

?>
