<h1 class="content_title">System User Detail</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\core\includes\classes\User;
    $user_id = secureRequestParameter($_REQUEST["user_id"]);
    $user = new User();
    $user->loadByID($user_id);
    ?>
    <br/>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Update Modules</a></li>
            <li><a href="#tabs-2">Update Password</a></li>
        </ul>

        <div id="tabs-1">
            <form id="UserModuleUpdateForm" method="post">
        <input type="hidden" value="<? echo $user_id ?>" name="user_id" id="user_id"/>
        <table class="general_table">
            <tr>
                <td>Currently subscribed modules:
                </td>
            </tr>
            <tr>
                <td>
                    <?
                    echo createCheckboxList("subscribe_module_code_checkbox_list", "checkbox_list", "subscribe_module_code_list[]", $user->getUserSubscribeModuleDataSource());
                    ?>
                </td>
            </tr>
            <tr>
                <td><input name='update' id="user_module_update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
        </div>

        <div id="tabs-2">
            <form id="UserPasswordUpdateForm" method="post">
                <input type="hidden" value="<? echo $user_id ?>" name="user_id" id="user_id"/>
                <table class="general_table">
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
                        <td><input name='update' id="password_update_btn" type='submit' value='update' title="update"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
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
            $("#tabs").tabs();

            $("#password_update_btn").button();
            jQuery(function () {
                jQuery("#password").validate({
                    expression: "if (VAL.length >= 8 && VAL) return true; else return false;",
                    message: "Please enter a valid Password (the length of password must exceed 8 characters)"
                });
                jQuery("#confirm_password").validate({
                    expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",
                    message: "Confirm password field doesn't match the password field"
                });

                jQuery('form#UserPasswordUpdateForm').validated(function () {
                    var user_id = $("#user_id").val();
                    var password = $("#password").val();
                    $.ajax({
                        url: SERVER_URL + "modules/core/control/user_password_update.php",
                        type: "POST",
                        data: {user_id: user_id,
                            password: password },
                        dataType: "json",
                        success: function (data) {
                            if (data.status == "success") {
                                jQuery("div#notification").html("<span class='info'>Password has been updated successfully!</span>");
                            } else {
                                jQuery("div#notification").html("<span class='error'>Unable to update the password. Try again please!</span>");
                            }
                        },
                        error: function (msg) {
                            ajaxFailMsg(msg);
                        }
                    });
                    return false;
                });
            });

            $("#user_module_update_btn").button();
            jQuery('form#UserModuleUpdateForm').submit(function () {
                var user_id = $("#user_id").val();
                var subscribe_module_code_list = [];
                $('#subscribe_module_code_checkbox_list input:checked').each(function () {
                    subscribe_module_code_list.push(this.value);
                });
                $.ajax({
                    url: SERVER_URL + "modules/core/control/user_module_update.php",
                    type: "POST",
                    data: {user_id: user_id,
                        subscribe_module_code_list: subscribe_module_code_list },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Module subscription has been updated successfully!</span>");
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update the module subscription. Try again please!</span>");
                        }
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
                return false;
            });



        });
    </script>


