<?php

session_start();
session_destroy();

unset($_SESSION['admin_name']);
unset($_SESSION['admin_access_code']);

header( "Location: ../../admin/login.php");

?>
