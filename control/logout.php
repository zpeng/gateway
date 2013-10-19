<?php

session_start();
session_destroy();

unset($_SESSION['client_name']);
unset($_SESSION['client_id']);
unset($_SESSION['client_email']);
unset($_SESSION['client_is_login']);

header("Location: ../login.php");

?>
