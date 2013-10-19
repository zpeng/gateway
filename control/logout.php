<?php

session_start();
session_destroy();

unset($_SESSION['client_name']);
unset($_SESSION['client_id']);
unset($_SESSION['client_email']);
unset($_SESSION['client_is_login']);
unset($_SESSION['client_order']);

header("Location: ../index.php");

?>
