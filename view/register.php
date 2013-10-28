<!-- the main content -->
<div id="main">

    <!-- Left Menu -->
    <? include_once("view/left_menu.php"); ?>


    <div class="content">
        <div class="subnav">
            <span class="page_title">Registration</span>
        </div>

        <form action="control/register.php">
            <table style="margin-left: 100px; margin-top: 30px;" width="500">
                <tr>
                    <td width="180" align="right">Email:</td>
                    <td><input id="email" name="email" type="text" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td><input id="password" name="password" type="password" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td align="right">Confirm your password:</td>
                    <td><input id="password_confirm" name="password_confirm" type="password" class="inputtext"
                               size="30">
                    </td>
                </tr>
                <tr>
                    <td height="30"></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="180" align="right">Title:</td>
                    <td><select id="title" name="title" type="text" class="searchselect">
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Ms.">Ms.</option>
                        </select>
                </tr>
                <tr>
                    <td width="180" align="right">Firstname:</td>
                    <td><input id="firstname" name="firstname" type="text" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td width="180" align="right">Surname:</td>
                    <td><input id="surname" name="surname" type="text" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td width="180" align="right">Date of Birth:</td>
                    <td><input id="dob" name="dob" type="text" class="inputtext" size="10"></td>
                </tr>
                <tr>
                    <td width="180" align="right">Telephone Number:</td>
                    <td><input id="tel" name="tel" type="text" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td width="180" align="right">Mobile Number:</td>
                    <td><input id="mobile" name="mobile" type="text" class="inputtext" size="30"></td>
                </tr>
                <tr>
                    <td width="180" align="right">Newsletter Signup:</td>
                    <td><input id="subscribed" name="subscribed"  type="checkbox" checked class="inputtext" size="30" value="Y"></td>
                </tr>
                <tr>
                    <td height="10"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="image" name="Submit" class="searchsubmit"
                               src="images/button_search.png"></td>
                    </td></tr>
                <tr>
                    <td height="30"></td>
                    <td></td>
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

        //date picker
        $('#dob').datepicker({
            dateFormat: "yy-mm-dd"
        });

        jQuery(function () {
            jQuery("#email").validate({
                expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                message: "Please enter a valid Email"
            });
            jQuery("#password").validate({
                expression: "if (VAL.length >= 8 && VAL) return true; else return false;",
                message: "Please enter a valid Password (the length of password must exceed 8 characters)"
            });

            jQuery("#password_confirm").validate({
                expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
                message: "Confirm password field doesn't match the password field"
            });

            jQuery("#firstname").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the Required field"
            });

            jQuery("#surname").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the Required field"
            });

            jQuery("#dob").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the Required field",
                live: false
            });
        });

    });
</script>