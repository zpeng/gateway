<?php

if (session_id() == "") {
    session_start();
}

if (empty($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    // did not pass the authentication, kick back to login page
    header("Location: " . SERVER_URL . "admin/login.php?error=Please login to access the content!");
} else {

    // to setup the configuration
    require_once('user_session_serialization.php');

    if (empty($_REQUEST['module_code'])) {
        // module_code is not set, then re-direct to landing page
        header("Location: " . SERVER_URL . "admin/landing.php?info=No module code presents");
    } else {
        // ok, we have module_code, now check again the available list
        if (!in_array($_REQUEST['module_code'], $s_user_session->userModuleAccessCodeList)) {
            header("Location: " . SERVER_URL . "admin/landing.php?info==Invalid module code");
        }
    }
}

?>
