<?php
require_once('../includes/bootstrap.php');
require_once('../external/php/Eden-3.1/eden.php');

$username= "pengziyang-facilitator_api1.gmail.com";
$password= "1383302139";
$signature= "AFcWxV21C7fd0v3bYYYRCpSSRl31A46uo1.BD0GvpslN.uNlIZjrl.gR";


$paypal = eden('paypal');
$paypal->authorization($user, $password, $signature, $certificate = NULL);



?>