<?php

session_start();

session_destroy();

unset($_SESSION['role']);
unset($_SESSION['login']);


header( "Location: admin_login.php" );

?>
