<h1 class="content_title">Deal Location/City</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <a id="add_new_city" class="anchor_button" href="#">Add New City</a>

    <?
    use modules\deal_steal\includes\classes\CityManager;
    $cityManager = new CityManager();
    echo createGenericTable("CityListGrid", "EditableGrid", $cityManager->getCityTableDataSource());
    ?>

</div>

<div id="dialog" title="Create New City">
    <br/>

    <form id="createCityForm" action="<?= SERVER_URL ?>modules/deal_steal/control/city_create.php" method='post'>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table width="500" border="0" class="dialogTable">
            <tr>
                <td width="150" align="right"><b>City Name: </b></td>
                <td><input name="city_name" id="city_name" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input name='Add' id="add_button" type='submit' value='Create'/>
                    <input name='Reset' id="reset_button" type='reset' value='Reset'/>
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "editablegrid-css",
    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "editablegrid",
    "jquery-ui",
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {
        $("a#add_new_city").button();
        $("#add_button").button();
        $("#reset_button").button();

        // Dialog
        $('#dialog').dialog({
            autoOpen: false, modal: true,
            width: 550,
            buttons: {
                "Cancel": function () {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('a#add_new_city').click(function () {
            $('#dialog').dialog('open');
            return false;
        });

        //form validation
        jQuery(function () {
            jQuery("input#city_name").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the city name"
            });
        });

        //data grid
        window.onload = function () {
            var CityListGrid = new EditableGrid("CityListGrid");

            // we build and load the metadata in Javascript
            CityListGrid.load({ metadata: [
                { name: "ID", datatype: "string", editable: false },
                { name: "City Name", datatype: "string", editable: false },
                { name: "Action", datatype: "html", editable: false }
            ]});

            // then we attach to the HTML table and render it
            CityListGrid.attachToHTMLTable('CityListGrid');
            CityListGrid.renderGrid();

            // Add Confirmation dialogs for all Deletes
            jQuery("a.confirm_delete").click(function (event) {
                return confirm('Are you sure you wish to delete this item?');
            });
        };
    });
</script>
