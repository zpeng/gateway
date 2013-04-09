<?
require_once('../../../../../includes/bootstrap.php');
?>

    <td width="150" align="right"><b>Menu Parent:</b></td>
    <td>
        <?
        $menuManager = new MenuManager();
        echo $menuManager->outputMenuListAsListbox($_REQUEST["menu_type_id"], "menu_level_selector", "menu_level_selector", "width: 300px;");
        ?>
    </td>




<script>
    jQuery("#menu_level_selector").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please make a selection"
    });
</script>



