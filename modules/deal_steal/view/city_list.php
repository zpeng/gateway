<h1 class="content_title">Deal Location/City</h1>
<? include_once('view/notification_bar.php') ?>
<div id="notification"></div>
<div id="content">
    <a id="add_new_city" class="anchor_button" href="#">Add New City</a>
    <br/><br class="clear"/>
    <div id="city_grid" class="slickgrid_table" style="width:900px; height:600px"></div>

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
    "slickgrid-css",
    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "slickgrid",
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

        function confirmDeletion(){
            return confirm('Are you sure you wish to delete this item?');
        }

        //form validation
        jQuery(function () {
            jQuery("input#city_name").validate({
                expression: "if (VAL) return true; else return false;",
                message: "Please enter the city name"
            });
        });

        //data grid
        var city_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 100, sortable: true},
            {id: "name", name: "City Name", field: "name", width: 300, sortable: true },
            {id: "action", name: "Action", field: "mobile", width: 150,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_delete confirm_delete' title='Delete this city' href='" + SERVER_URL + "modules/deal_steal/control/city_delete.php?city_id=" +
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' onclick='confirmDeletion();'></a>" +
                        "<a class='icon_edit' title='Update City' href='" + SERVER_URL + "admin/main.php?view=city_update&city_id=" +
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "'></a>";
                }
            }
        ];
        var options = {
            enableCellNavigation: true,
            enableColumnReorder: false,
            forceFitColumns: true
        };
        var dataView = new Slick.Data.DataView();

        city_grid = new Slick.Grid("#city_grid", dataView, columns, options);

        city_grid.onSort.subscribe(function(e, args) {
            // We'll use a simple comparer function here.
            var comparer = function(a, b) {
                return a[args.sortCol.field] > b[args.sortCol.field];
            }

            // Delegate the sorting to DataView.
            // This will fire the change events and update the grid.
            dataView.sort(comparer, args.sortAsc);
            city_grid.invalid
            city_grid.render();
        });

        dataView.onRowsChanged.subscribe(function(e,args) {
            city_grid.invalidateRows(args.rows);
            city_grid.render();
        });

        //use ajax to load data source
        function fetch_data(){
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_city_list"
                },
                dataType: "json",
                success: function (data) {
                    dataView.beginUpdate();
                    dataView.setItems(data);
                    dataView.endUpdate();
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
        }

        //when page rendering is completed
        $(document).ready(function () {
            fetch_data();
        });

        // Add Confirmation dialogs for all Deletes
        jQuery("a.confirm_delete").click(function (event) {

        });





    });
</script>
