<?php

if (session_id() == "") {
    session_start();
}

if (md5($_SESSION['user_name']) != $_SESSION['user_session_code']) {
    // did not pass the authentication, kick back to login page
    header("Location: " . SERVER_URL . "admin/login.php?error=Please login to access the content!");
} else {
    // to setup the configuration
    require_once('user_session_serialization.php');

}

?>
