<h1 class="content_title">Update Menu</h1>
<div id="notification"></div>
<div id="content">
    <?
    $menu_id = secureRequestParameter($_REQUEST["menu_id"]);
    use modules\cms\includes\classes\Menu;

    $menu = new Menu();
    $menu->load($menu_id);
    ?>
    <br/>

    <form id="MenuUpdateForm"  method="post">
        <input type="hidden" value="<? echo $menu_id ?>" name="menu_id" id="menu_id"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>Menu Name: </b></td>
                <td><input name="menu_name" id="menu_name" value="<?= $menu->get_menu_name() ?>" style="width: 400px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Link: </b></td>
                <td><input name="menu_link" id="menu_link" value="<?= $menu->get_menu_link() ?>" style="width: 400px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Order: </b></td>
                <td><input name="menu_order" id="menu_order" value="<?= $menu->get_menu_order() ?>"
                           style="width: 100px;"/>
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

        jQuery(function () {
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

            jQuery('form#MenuUpdateForm').validated(function () {
                var menu_id = $("#menu_id").val();
                var menu_name = $("#menu_name").val();
                var menu_link = $("#menu_link").val();
                var menu_order = $("#menu_order").val();
                var menu_desc = $("#menu_desc").val();

                $.ajax({
                    url: SERVER_URL + "modules/cms/admin/control/menu_update.php",
                    type: "POST",
                    data: {menu_id: menu_id,
                        menu_name: menu_name,
                        menu_link: menu_link,
                        menu_order: menu_order,
                        menu_desc: menu_desc
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Menu item has been updated successfully!</span>");
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update this menu item. Try again please!</span>");
                        }
                    },
                    error: function () {
                        jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                    }
                });
                return false;
            });

        });
    </script>
</div>
