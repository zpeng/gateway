<?php

require_once('../included/class_loader.php') ;

if (session_id() == "") {session_start();}

$login = $_SESSION['login'];

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



if (!$login){
    // did not pass the authenticaion, kick back to login page
    header( "Location: login.php");

}


?>
