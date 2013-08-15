<script id="html_select_template" type="text/x-jquery-tmpl">
    <select id="concierge_status_dropdown" name="concierge_status_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if value === $item.selectedId}} selected="selected"{{/if}} value="${value}">${label}</option>
</script>

<h1 class="content_title">Concierge Service</h1>
<div id="notification"></div>
<div id="content">
    <div id="concierge_status_div"></div>
    <div id="concierge_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>
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
    "jquery-tmpl",
    "jquery-ui")
    , $JS_DEPS)?>, function () {
        //concierge status dropdown
        var model = {
            data: [
                { value: "Pending", label: "Pending" },
                { value: "Negotiating", label: "Negotiating" },
                { value: "Closed", label: "Closed" }
            ],
            selected_value: "Pending"
        };
        $("#html_select_template").tmpl(model).appendTo("#concierge_status_div" );

        //data grid
        var concierge_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "client", name: "Client Name", field: "client", width: 150},
            {id: "supplier", name: "Supplier", field: "supplier", width: 150},
            {id: "create_date", name: "Created Date", field: "create_date", width: 150},
            {id: "status", name: "status", field: "status", width: 150},
            {id: "action", name: "Action", field: "action", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='View Detail' href='" + SERVER_URL + "admin/main.php?view=concierge_update&con_id="+
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
                    operation_id: "fetch_concierge_table",
                    status: $("#concierge_status_dropdown option:selected").val()
                },
                dataType: "json",
                success: function (data) {
                    concierge_grid = new Slick.Grid("#concierge_grid", data, columns, options);
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

        //when the client status dropdown selection is changed
        $("#concierge_status_dropdown").change(function(e) {
            fetch_data();
        });

    });
</script>
