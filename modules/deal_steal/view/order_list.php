<script id="html_select_template" type="text/x-jquery-tmpl">
    <select id="order_status_dropdown" name="order_status_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if value === $item.selectedId}} selected="selected"{{/if}} value="${value}">${label}</option>
</script>
<h1 class="content_title">All Clients</h1>
<div id="notification"></div>
<div id="content">
    <div id="order_status_div"></div>
    <div id="order_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>
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
                { value: "P", label: "Pending" },
                { value: "D", label: "Delivered" },
                { value: "C", label: "Cancelled" }
            ],
            selected_value: "P"
        };
        $("#html_select_template").tmpl(model).appendTo("#order_status_div" );

        var order_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "order_code", name: "Order Code", field: "order_code", width: 150},
            {id: "client_name", name: "Client", field: "client_name", width: 100},
            {id: "deal_name", name: "Deal", field: "deal_name", width: 150},
            {id: "total_price", name: "Total Price", field: "total_price", width: 100},
            {id: "order_timestamp", name: "Ordered Date", field: "order_timestamp", width: 150},
            {id: "order_status", name: "Status", field: "order_status", width: 100},
            {id: "action", name: "Action", field: "action", width: 60,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='View Detail' href='" + SERVER_URL + "admin/main.php?view=order_detail&order_id=" +
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
                    operation_id: "fetch_order_table",
                    status: $("#order_status_dropdown option:selected").val()
                },
                dataType: "json",
                success: function (data) {
                    order_grid = new Slick.Grid("#order_grid", data, columns, options);
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
        $("#order_status_dropdown").change(function (e) {
            fetch_data();
        });
    });
</script>
