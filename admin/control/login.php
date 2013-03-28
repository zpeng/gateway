<?php

require_once('../../php/shared/config.php');

echo "i am here";

$email = ($_REQUEST['email']);
$password =  ($_REQUEST['password']);

$adminManager = new AdministratorManager();
$result = $adminManager->adminLogin($email, $password);

if ($result) {
    session_start();

    $_SESSION['admin_name'] = $email;
    $_SESSION['admin_access_code'] =md5($email);

    // to setup the configuration
    setup_configuration_in_session();

    header( "Location: ../index.php?view=admin_cp" );


}else {
    header( "Location: ../login.php?error=Wrong username or password!" );
}
?>
