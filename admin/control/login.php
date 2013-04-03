<?php

require_once('../../includes/bootstrap.php');

$email = ($_REQUEST['email']);
$password = ($_REQUEST['password']);

$userManager = new UserManager();
$result = $userManager->login($email, $password);

if ($result) {
    session_start();

    $_SESSION['user_name'] = $email;
    $_SESSION['user_logged_in'] = $result;

    // to setup the configuration
    //setup_configuration_in_session();
    require_once('user_session_serialization.php');

    header("Location: " . SERVER_URL . "admin/landing.php");

} else {
    header("Location: " . SERVER_URL . "admin/login.php?error=Wrong username or password!");
}
?>
