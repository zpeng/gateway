<?
require_once('../../includes/bootstrap.php');


$user_name = secureRequestParameter($_REQUEST["email"]);
$user_password = secureRequestParameter($_REQUEST["password"]);
$subscribe_module_id_list = $_REQUEST['subscribe_module_id_list'];

$module_code = secureRequestParameter($_REQUEST["module_code"]);

$userManager = new UserManager();
$result = $userManager->checkUserExistsByEmail($user_name);

if (!$result) {
    $user = new User();
    $user->set_user_name($user_name);
    $user->set_user_password(md5($_REQUEST["password"]));
    $user->user_subscribe_module_id_list = $subscribe_module_id_list;
    $user->insert();
    $user->updateUserSubscribeModuleList();

    $url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=user_list"; // target of the redirect
    $msg = "User account for [" . $user->get_user_name() . "] has been created";
    $url = $url . "&info=" . $msg;
    echo $url;
} else {
    $url = SERVER_URL . "admin/main.php?module_code=" . $module_code . "&view=user_create"; // target of the redirect
    $msg = "User account [" . $user_name . "] already exists";
    $url = $url . "&error=" . $msg;
    echo $url;
}

header("Location: " . $url);

?>
