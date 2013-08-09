<h1 class="content_title">Update Menu</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $module_code = secureRequestParameter($_REQUEST["module_code"]);
    ?>
    <br/>

    <form id="MenuCreateForm" action="<?= SERVER_URL ?>modules/cms/control/menu_create.php" method="post">
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table class="general_table">
            <tr>
                <td width="150" align="right"><b>Menu Name: </b></td>
                <td><input name="menu_name" id="menu_name" style="width: 300px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Order: </b></td>
                <td><input name="menu_order" id="menu_order" style="width: 30px;"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Menu Type: </b></td>
                <td>
                    <?
                    use modules\cms\includes\classes\MenuManager;
                    $menuManager = new MenuManager();
                    echo createDropdownList("menu_type_selector", "menu_type_selector", "menu_type_selector", "width: 300px;", "3",
                        $menuManager->getMenuTypeListDataSource());
                    ?>
                </td>
            </tr>
            <tr id="menuLevelSelection"></tr>
            <tr>
                <td width="150" align="right"><b>Link Type:</b></td>
                <td>
                    <?
                    $dataSource = array(
                        "data" => array(
                            "Customize Link" => "0",
                            "Contents" => "1"
                        )
                    );
                    echo createDropdownList("link_type_selector", "link_type_selector", "link_type_selector", "width: 300px;", "2", $dataSource);
                    ?>
                </td>
            </tr>
            <tr id="MenuLinkSelection"></tr>
            <tr>
                <td></td>
                <td><input name='Create' id="update_btn" type='submit' value='Submit' title="Create"/></td>
            </tr>
        </table>
    </form>
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
            jQuery("#update_btn").button();

            jQuery(document).ready(function () {
                jQuery("#menu_type_selector").change(function () {
                    $("#menuLevelSelection").load(SERVER_URL + "modules/cms/view/ajax/MenuLevelSelection.php?menu_type_id=" + this.value);
                });
                jQuery("#link_type_selector").change(function () {
                    $("#MenuLinkSelection").load(SERVER_URL + "modules/cms/view/ajax/MenuLinkSelection.php?link_type_id=" + this.value);
                });
            });

            jQuery(function () {
                jQuery("#menu_name").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter a valid menu name"
                });
                jQuery("#menu_order").validate({
                    expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
                    message: "Please enter a valid menu name"
                });
                jQuery("#menu_level_selector").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#menu_type_selector").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
                jQuery("#link_type_selector").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please make a selection"
                });
            });
        });
    </script>
</div>
