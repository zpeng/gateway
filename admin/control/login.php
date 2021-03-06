<?php
require_once('../../includes/bootstrap.php');
include(BASE_PATH."modules/core/includes/classes/UserSession.php");
use modules\core\includes\classes\UserManager;
use modules\core\includes\classes\User;

$email = ($_REQUEST['email']);
$password = ($_REQUEST['password']);

$userManager = new UserManager();
$result = $userManager->login($email, $password);

if ($result) {
    session_start();

    $user = new User();
    $user->loadByEmail($email);

    $_SESSION['user_name'] = $email;
    $_SESSION['user_id'] = $user->get_user_id();
    $_SESSION['user_logged_in'] = $result;

    // to setup the configuration
    //setup_configuration_in_session();
    require_once('user_session_serialization.php');

    header("Location: " . SERVER_URL . "admin/landing.php");

} else {
    header("Location: " . SERVER_URL . "admin/login.php?error=Wrong username or password!");
}
?>
