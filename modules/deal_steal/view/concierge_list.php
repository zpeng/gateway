<h1 class="content_title">Concierge Service</h1>
<div id="notification"></div>
<div id="content">
    <?
    $dropdown_dataSource = array(
        "data" => array(
            "Pending" => "Pending",
            "Negotiating" => "Negotiating",
            "Closed" => "Closed"
        ));
    $status ="Pending";
    if(isset($_REQUEST["status"])){
        $status = secureRequestParameter($_REQUEST["status"]);
        $dropdown_dataSource["selected"] = array($status => $status);
    }

    echo createDropdownList("status_dropdown","status_dropdown", "", "", "", $dropdown_dataSource);
    ?>

    <br/><br class="clear"/>
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
    "jquery-ui")
    , $JS_DEPS)?>, function () {
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
                    operation_id: "fetch_concierge_list",
                    status: $("#status_dropdown option:selected").val()
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
        $("#status_dropdown").change(function(e) {
            fetch_data();
        });

    });
</script>
