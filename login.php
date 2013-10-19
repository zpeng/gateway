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

</head>
<body class='dealdetails'>
<div id="wrapper">

    <!-- Top Header -->
    <? include_once("view/top_header.php"); ?>

    <!-- Top Menu -->
    <? include_once("view/top_menu.php"); ?>

    <!-- the main content -->
    <div id="main">

        <!-- Left Menu -->
        <? include_once("view/left_menu.php"); ?>


        <div class="content">
            <div class="subnav">
                <span class="page_title">Customer Login</span>
            </div>

            <form action="control/login.php">
                <table style="margin-left: 200px; margin-top: 60px;" width="300">
                    <tr>
                        <td width="100" align="right">Email:</td>
                        <td width="200" align="right">
                            <input id="email" name="email" type="text" class="searchtext">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Password:</td>
                        <td align="right">
                            <input id="password" name="password" type="password" class="searchtext">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="right"><input type="image" name="login" class="searchsubmit"
                                                 src="images/button_search.png"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="clear"></div>
    </div>


</div>

<!-- Footer -->
<? include_once("view/footer.php"); ?>
<?= outputHTMLEnd() ?>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {

        jQuery("#login").button();

        jQuery(function () {
            jQuery("#email").validate({
                expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                message: "Please enter a valid Email"
            });
            jQuery("#password").validate({
                expression: "if (VAL.length >= 8 && VAL) return true; else return false;",
                message: "Please enter a valid Password (the length of password must exceed 8 characters)"
            });
        });

    });
</script>