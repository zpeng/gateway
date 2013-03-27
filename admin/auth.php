<?php

require_once('../php/shared/config.php');

if (session_id() == "") {session_start();}

$admin_email = $_SESSION['admin_name'];
$admin_access_code = $_SESSION['admin_access_code'];

// to setup the configuration
if (!isset ($_SESSION['configuration'])) {
    //$s_configManager = new ConfigurationManager();
    //unset ($_SESSION['$configManager']);
    //$_SESSION['configuration'] = serialize($s_configManager);

}else {
    //$str =  unserialize($_SESSION['configuration']);
    //$s_configManager = ConfigurationManager::cast($str);

    //unset ($_SESSION['configuration']);
    //$_SESSION['configuration'] = serialize($s_configManager);
}



if (md5($admin_email) != $admin_access_code){
    // did not pass the authentication, kick back to login page
    header( "Location: login.php");
}


?>
