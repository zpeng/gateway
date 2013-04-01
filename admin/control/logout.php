<?php

session_start();
session_destroy();

unset($_SESSION['user_name']);
unset($_SESSION['user_session_code']);

header( "Location: ../../admin/login.php");

?>
