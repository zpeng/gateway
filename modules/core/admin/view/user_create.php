<h1 class="content_title">Create a New User</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $module_code = secureRequestParameter($_REQUEST["module_code"]);
    ?>
    <br/>

    <form id="UserCreationForm" action="<?= SERVER_URL ?>modules/core/admin/control/user_create.php" method="post">
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>User Email: </b></td>
                <td><input name="email" id="email" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td align="right"><b>Password: </b></td>
                <td><input name="password" id="password" type="password" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td align="right"><b>Confirm Password: </b></td>
                <td><input name="confirm_password" id="confirm_password" type="password" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="right"><b>Subscribe Modules: </b></td>
                <td>
                    <?
                    $moduleManager = new ModuleManager();
                    echo createCheckboxList("checkbox_list","checkbox_list","subscribe_module_code_list[]",$moduleManager->getModuleCheckboxListDataSource())
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='Create' id="update_btn" type='submit' value='Create' title="Create"/></td>
            </tr>
        </table>
    </form>
    <script>
        jQuery("#update_btn").button();

        jQuery(function(){

            jQuery("#email").validate({
                expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                message: "Please enter a valid Email"
            });
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
