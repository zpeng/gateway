<?php
// this is always required
require_once('control/session.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<? echo  outputHTMLStartFrontend($JS_FRONTEND, array("css/style.css"), $s_configManager) ?>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">var switchTo5x = true;</script>
<script type="text/javascript">
    stLight.options({publisher: "ur-822fd650-6b38-3317-b453-e3ff450cae3a", doNotHash: false, doNotCopy: false, hashAddressBar: false});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#tab-container').easytabs();
    });
</script>

</head><body class='dealdetails'>
<div id="wrapper">

<!-- Top Header -->
<? include_once("view/top_header.php"); ?>

<!-- Top Menu -->
<? include_once("view/top_menu.php"); ?>

<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <?
    // get the view parameter from the url
    $view = secureRequestParameter($_REQUEST["view"]);

    switch ($view) {
        case "main" :
            include_once 'view/main.php';
            break;
        case "login" :
            include_once 'view/login.php';
            break;
        case "password_retrieve" :
            include_once 'view/password_retrieve.php';
            break;
        case "register" :
            include_once 'view/register.php';
            break;
        case "shopping_cart" :
            include_once 'view/shopping_cart.php';
            break;
        case "deal" :
            include_once 'view/deal.php';
            break;

        case "404" :
            include_once 'view/404.php';
            break;
        default :
            include_once 'view/main.php';
    }
    ?>
</div>


</div>

<!-- Footer -->
<? include_once("view/footer.php"); ?>

<?= outputHTMLEnd() ?>