<?php

if (session_id() == "") {session_start();}

$user_name = $_SESSION['user_name'];
$user_session_code = $_SESSION['user_session_code'];

if (md5($user_name) != $user_session_code){
    // did not pass the authentication, kick back to login page
    header( "Location: ".BASE_PATH."/admin/login.php");
}else{
    // to setup the configuration
    setup_configuration_in_session();
}

?>
