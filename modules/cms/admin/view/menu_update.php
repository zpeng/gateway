<h1 class="content_title">Update Menu</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $menu_id = secureRequestParameter($_REQUEST["menu_id"]);
    $module_code = secureRequestParameter($_REQUEST["module_code"]);

    $menu = new Menu();
    $menu->load($menu_id);
    ?>
    <br/>
    <form id="MenuUpdateForm" action="<?= SERVER_URL ?>modules/cms/admin/control/menu_update.php" method="post">
        <input type="hidden" value="<? echo $menu_id ?>" name="menu_id"/>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>Menu Name: </b></td>
                <td><input name="menu_name" id="menu_name" value="<?=$menu->get_menu_name()?>" style="width: 400px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Link: </b></td>
                <td><input name="menu_link" id="menu_link" value="<?=$menu->get_menu_link()?>" style="width: 400px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Order: </b></td>
                <td><input name="menu_order" id="menu_order" value="<?=$menu->get_menu_order()?>" style="width: 100px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Description: </b></td>
                <td><textarea name="menu_desc" id="menu_desc" cols="48" rows="3"><?=$menu->get_menu_desc()?></textarea>
                </td>
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
            jQuery("#menu_name").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter a valid menu name"
            });
            jQuery("#menu_link").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter a valid menu link"
            });
            jQuery("#menu_order").validate({
                expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
                message: "Please enter a valid menu name"
            });
        });
    </script>
</div>
