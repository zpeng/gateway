<script id="html_select_template" type="text/x-jquery-tmpl">
    <select id="client_status_dropdown" name="client_status_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if value === $item.selectedId}} selected="selected"{{/if}} value="${value}">${label}</option>
</script>
<h1 class="content_title">All Clients</h1>
<div id="notification"></div>
<div id="content">
    <div id="client_status_div"></div>
    <div id="client_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>
</div>




<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "slickgrid-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "slickgrid",
    "jquery-tmpl")
    , $JS_DEPS)?>, function () {

        var model = {
            data: [
                { value: "Y", label: "Active User" },
                { value: "N", label: "Inactive User" }
            ],
            selected_value: "Y"
        };
        $("#html_select_template").tmpl(model).appendTo("#client_status_div" );

        var client_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "email", name: "Email", field: "email", width: 150},
            {id: "name", name: "Name", field: "name", width: 150},
            {id: "tel", name: "Telephone", field: "tel", width: 150},
            {id: "mobile", name: "Mobile", field: "mobile", width: 150},
            {id: "action", name: "Action", field: "action", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='View Detail' href='" + SERVER_URL + "admin/main.php?view=client_detail&client_id=" +
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
        function fetch_data() {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_client_table",
                    active: $("#client_status_dropdown option:selected").val()
                },
                dataType: "json",
                success: function (data) {
                    client_grid = new Slick.Grid("#client_grid", data, columns, options);
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
        $("#client_status_dropdown").change(function (e) {
            fetch_data();
        });
    });
</script>
