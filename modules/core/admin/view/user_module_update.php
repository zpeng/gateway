<h1 class="content_title">Update User Module Subscription</h1>
<div id="notification"></div>
<div id="content">
    <?
    $user_id = secureRequestParameter($_REQUEST["user_id"]);
    $user = new User();
    $user->loadByID($user_id);
    ?>
    <br/>

    <form id="UserModuleUpdateForm" method="post">
        <input type="hidden" value="<? echo $user_id ?>" name="user_id" id="user_id"/>
        <table class="inputTable">
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
                <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
    <script>
        $("#update_btn").button();

        jQuery('form#UserModuleUpdateForm').submit(function () {
            var user_id = $("#user_id").val();
            var subscribe_module_code_list = [];
            $('#subscribe_module_code_checkbox_list input:checked').each(function () {
                subscribe_module_code_list.push(this.value);
            });
            $.ajax({
                url: SERVER_URL + "modules/core/admin/control/user_module_update.php",
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
                error: function () {
                    jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                }
            });
            return false;
        });
    </script>
</div>
