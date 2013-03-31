<?php

require_once("../../includes/config.php");

if (session_id() == "") {session_start();}

$admin_email = $_SESSION['admin_name'];
$admin_access_code = $_SESSION['admin_access_code'];

if (md5($admin_email) != $admin_access_code){
    // did not pass the authentication, kick back to login page
    header( "Location: login.php");
}else{
    // to setup the configuration
    setup_configuration_in_session();
}

?>
