<?php

require_once('../../includes/bootstrap.php');

$email = ($_REQUEST['email']);
$password =  ($_REQUEST['password']);

$userManager = new UserManager();
$result = $userManager->login($email, $password);

if ($result) {
    session_start();

    $_SESSION['user_name'] = $email;
    $_SESSION['user_session_code'] =md5($email);

    // to setup the configuration
    //setup_configuration_in_session();
    require_once('userSessionSerialization.php');

    header( "Location: ../index.php?view=admin_cp" );


}else {
    header( "Location: ../login.php?error=Wrong username or password!" );
}
?>
