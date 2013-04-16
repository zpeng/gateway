<h1 class="content_title">Update User Password</h1>
<? include_once('view/notification_bar.php') ?>
<div id="notification"></div>
<div id="content">
    <?
    $user_id = secureRequestParameter($_REQUEST["user_id"]);
    $user = new User();
    $user->loadByID($user_id);
    ?>
    <br/>

    <form id="UserPasswordUpdateForm" method="post">
        <input type="hidden" value="<? echo $user_id ?>" name="user_id" id="user_id"/>
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

        jQuery(function () {
            jQuery("#password").validate({
                expression: "if (VAL.length >= 8 && VAL) return true; else return false;",
                message: "Please enter a valid Password (the length of password must exceed 8 characters)"
            });
            jQuery("#confirm_password").validate({
                expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
                message: "Confirm password field doesn't match the password field"
            });
        });

        jQuery('form#UserPasswordUpdateForm').validated(function () {
            var user_id = $("#user_id").val();
            var password = $("#password").val();
            $.ajax({
                url: SERVER_URL + "modules/core/admin/control/user_password_update.php",
                type: "POST",
                data: {user_id: user_id,
                    password: password },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success"){
                        jQuery("div#notification").html("<span class='info'>Password has been updated successfully!</span>");
                    }else{
                        jQuery("div#notification").html("<span class='error'>Unable to update the password. Try again please!</span>");
                    }
                },
                error: function () {
                    jQuery("div#notification").html("<span class='warning'>There was an error. Try again please!</span>");
                }
            });
            return false;
        });


    </script>
</div>
