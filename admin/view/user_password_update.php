<h1 class="content_title">Update User Password</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $user_id = secureRequestParameter($_REQUEST["user_id"]);
    $module_code = secureRequestParameter($_REQUEST["module_code"]);

    $user = new User();
    $user->loadByID($user_id);
    ?>
    <br/>
    <form id="UserPasswordUpdateForm" action="<?= SERVER_URL ?>admin/control/user_password_update.php" method="post">
        <input type="hidden" value="<? echo $user_id ?>" name="user_id"/>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>User Name: </b></td>
                <td><? echo $user->get_user_name()?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>New Password: </b></td>
                <td><input name="password" id="password" type="password" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td align="right"><b>Confirm Password: </b></td>
                <td><input name="confirm_password" id="confirm_password" type="password" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
    <script>
        jQuery("#update_btn").button();

        jQuery(function(){
            jQuery("#password").validate({
                expression: "if (VAL.length >= 8 && VAL) return true; else return false;",
                message: "Please enter a valid Password (the length of password must exceed 8 characters)"
            });
            jQuery("#confirm_password").validate({
                expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
                message: "Confirm password field doesn't match the password field"
            });
        });
    </script>
</div>
