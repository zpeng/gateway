<h1 class="content_title">Update User Module Subscription</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $user_id = secureRequestParameter($_REQUEST["user_id"]);
    $module_code = secureRequestParameter($_REQUEST["module_code"]);

    $user = new User();
    $user->loadByID($user_id);
    ?>
    <br/>
    <form action="<?= SERVER_URL ?>admin/control/user_module_update.php" method="post">
        <input type="hidden" value="<? echo $user_id ?>" name="user_id"/>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="inputTable">
            <tr>
                <td>Currently subscribed modules:
                </td>
            </tr>
            <tr>
                <td>
                    <?
                    echo $user->outputUserSubscribeModuleAsHtmlCheckboxList();
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
    </script>
</div>
