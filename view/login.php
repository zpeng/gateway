<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <div class="content">
        <div class="subnav">
            <span class="page_title">Customer Login</span>
        </div>

        <? include_once("view/notification_bar.php"); ?>


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