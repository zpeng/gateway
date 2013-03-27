<?php

include_once '../session.php';

//is not logged in, redirect to login page
if (!$s_cart->get_customer_login()) {
    header("Location: ../index.php?view=customer_login");
} else {
    header("Location: ../index.php?view=customer_shipping_method_confirm");
}
?>
