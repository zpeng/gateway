<?php

require_once('../../php/shared/config.php');

$email = secureRequestParameter($_REQUEST['email']);
$password =  secureRequestParameter($_REQUEST['password']);

$adminManager = new AdministratorManager();
$result = true; //$adminManager->adminLogin($email, $password);

if ($result) {
    session_start();

    $admin = new Administrator();
    //$admin->loadByEmail($email);

    $_SESSION['admin_name'] = $email;
    $_SESSION['admin_access_code'] =md5($email); //md5($admin->get_admin_name());

    /*
    // to setup the configuration
    if (!isset ($_SESSION['configuration'])) {
        $s_configManager = new ConfigurationManager();
        unset ($_SESSION['$configManager']);
        $_SESSION['configuration'] = serialize($s_configManager);

    }else {
        $str =  unserialize($_SESSION['configuration']);
        $s_configManager = ConfigurationManager::cast($str);

        unset ($_SESSION['configuration']);
        $_SESSION['configuration'] = serialize($s_configManager);
    }
    */

    header( "Location: ../index.php?view=admin_cp" );


}else {
    header( "Location: ../login.php?error=Wrong username or password!" );
}
?>
