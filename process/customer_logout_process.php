<?php

session_start();

session_destroy();

unset($_SESSION['cart']);
unset($_SESSION['configuration']);
unset($_SESSION['language_id']);


header( "Location: ../index.php?view=main_page" );



?>
