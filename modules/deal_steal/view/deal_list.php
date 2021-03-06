<script id="html_select_supplier_template" type="text/x-jquery-tmpl">
    <select id="supplier_dropdown" name="supplier_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_select_city_template" type="text/x-jquery-tmpl">
    <select id="city_dropdown" name="city_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_select_deal_type_template" type="text/x-jquery-tmpl">
    <select id="deal_type_dropdown" name="deal_type_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if id === $item.selectedId}} selected="selected"{{/if}} value="${id}">${name}</option>
</script>
<h1 class="content_title">All Deals</h1>
<div id="notification"></div>
<div id="content">
    <a id="add_new_deal" class="anchor_button" href="#">Add New Deal</a>

    <br/><br class="clear"/>
    <div id="deal_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>

</div>

<div id="dialog" title="Create New Deal">
    <br/>

    <form id="createDealForm" action="<?= SERVER_URL ?>modules/deal_steal/control/deal_create.php" method='post'>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table width="500" border="0" class="dialogTable">
            <tr>
                <td width="150" align="right"><b>Deal Title: </b></td>
                <td><input name="deal_title" id="deal_title" style="width: 200px;"/></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Supplier: </b></td>
                <td><div id="supplier_dropdown_div"></div></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>City: </b></td>
                <td><div id="city_dropdown_div"></div></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Deal Type: </b></td>
                <td><div id="deal_type_dropdown_div"></div></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Available Quantity: </b></td>
                <td><input name="available_quantity" id="available_quantity" style="width: 100px;"/></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Original Price: </b></td>
                <td><input name="original_price" id="original_price" style="width: 100px;"/></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Offer Price: </b></td>
                <td><input name="offer_price" id="offer_price" style="width: 100px;"/></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Online Date: </b></td>
                <td><input name="online_date" id="online_date" style="width: 120px;"/></td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Offline Date: </b></td>
                <td><input name="offline_date" id="offline_date" style="width: 120px;"/></td>
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
    "jquery-form-validate",
    "jquery-tmpl",
    "jquery-ui-timepicker")
    , $JS_DEPS)?>, function () {

        $("a#add_new_deal").button();
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
        $('a#add_new_deal').click(function () {
            $('#dialog').dialog('open');
            return false;
        });

        //date picker
        $('#online_date').datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "hh:mm:ss"
        });

        $("#offline_date").datetimepicker({
            dateFormat: "yy-mm-dd",
            timeFormat: "hh:mm:ss"
        });

        //form validation
        jQuery("input#deal_title").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter the deal title"
        });

        jQuery("#available_quantity").validate({
            expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
            message: "Please enter a valid integer"
        });

        jQuery("#original_price").validate({
            expression: "if (VAL.match(/^\\d+(?:\\.\\d{1,2})?$/) && VAL) return true; else return false;",
            message: "Please enter a valid price"
        });

        jQuery("#offer_price").validate({
            expression: "if (VAL.match(/^\\d+(?:\\.\\d{1,2})?$/) && VAL) return true; else return false;",
            message: "Please enter a valid price"
        });

        jQuery("#online_date").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter a valid Date"
        });

        jQuery("#offline_date").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter a valid Date"
        });

        //data grid
        var deal_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "supplier", name: "Supplier", field: "supplier", width: 100},
            {id: "category", name: "Category", field: "category", width: 100},
            {id: "city", name: "City", field: "city", width: 100},
            {id: "type", name: "Type", field: "type", width: 100},
            {id: "title", name: "Title", field: "title", width: 150},
            {id: "quantity", name: "Availability", field: "quantity", width: 100},
            {id: "online_date", name: "Online Date", field: "online_date", width: 150},
            {id: "offline_date", name: "Offline Date", field: "offline_date", width: 150},
            {id: "action", name: "Action", field: "action", width: 70,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='Update Deal' href='" + SERVER_URL + "admin/main.php?view=deal_update&deal_id="+
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>";
                }
            }
        ];
        var options = {
            enableCellNavigation: true,
            enableColumnReorder: false,
            forceFitColumns: true
        };

        //use ajax to load data source
        function fetch_data(){
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_deal_table"
                },
                dataType: "json",
                success: function (data) {
                    deal_grid = new Slick.Grid("#deal_grid", data, columns, options);
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
        }

        function fetch_supplier_dropdown_data() {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_supplier_dropdown_list",
                    active: "Y"
                },
                dataType: "json",
                success: function (data) {
                    $("#html_select_supplier_template").tmpl(data).appendTo("#supplier_dropdown_div" );
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
        }

        function fetch_city_dropdown_data() {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_city_dropdown_list"
                },
                dataType: "json",
                success: function (data) {
                    $("#html_select_city_template").tmpl(data).appendTo("#city_dropdown_div" );
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
        }

        function fetch_deal_type_dropdown_data() {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_deal_type_dropdown_list"
                },
                dataType: "json",
                success: function (data) {
                    $("#html_select_deal_type_template").tmpl(data).appendTo("#deal_type_dropdown_div" );
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
        }

        //when page rendering is completed
        $(document).ready(function () {
            fetch_data();

            fetch_supplier_dropdown_data();

            fetch_city_dropdown_data();

            fetch_deal_type_dropdown_data();

        });
    });
</script>
