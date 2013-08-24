<?
require_once('../../../includes/bootstrap.php');
$link_type_id = $_REQUEST["link_type_id"];
use modules\cms\includes\classes\ContentManager;
?>



<?
if ($link_type_id == 0) {
    //Customize Link
    echo "<td width='150' align='right'><b>Menu Link:</b></td><td><input name='menu_link' id='menu_link' style='width: 300px;' value='http://' ></td>";
} else if ($link_type_id == 1) {
    $contentManager = new ContentManager();
    echo "<td width='150' align='right'><b>Link to an article:</b></td><td>";
    echo createDropdownList("content_list_selector", "content_list_selector", "content_list_selector", "width: 300px;", "8", $contentManager->getContentDropdownDataSource());
    echo "</td>";
}
?>

<script>
    jQuery("#menu_link").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please specify a link"
    });
    jQuery("#content_list_selector").validate({
        expression: "if (VAL) return true; else return false;",
        message: "Please make a selection"
    });
</script>
