<?php
session_start();

include_once '../external/php/securimage/securimage.php';
$securimage = new Securimage();
echo $_REQUEST['captcha_code'];

echo "<br><br>";
if (!isset($_REQUEST['captcha_code']) || $securimage->check($_REQUEST['captcha_code']) == false) {
    // the code was incorrect
    echo "the code was incorrect";
} else {
    echo "the code was correct";
}

?>