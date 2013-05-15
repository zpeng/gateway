<?
require_once('../../../../includes/bootstrap.php');
use modules\cms\includes\classes\MenuManager;
?>

<td width="150" align="right"><b>Menu Parent:</b></td>
<td>
    <?
    $menuManager = new MenuManager();
    echo createDropdownList("menu_level_selector", "menu_level_selector", "menu_level_selector", "width: 300px;", "10",
        $menuManager->getMenuListDataSource($_REQUEST["menu_type_id"]));
    ?>
</td>


<script>
    jQuery("#menu_level_selector").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please make a selection"
    });
</script>



