<h1 class="content_title">User List</h1>
<div id="notification"></div>
<div id="content">
    <div id="user_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>
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
    "slickgrid")
    , $JS_DEPS)?>, function () {
        var user_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "name", name: "User Name", field: "name", width: 150},
            {id: "modules", name: "Subscribed Modules", field: "modules", width: 550},
            {id: "action", name: "Action", field: "action", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='Update User' href='" + SERVER_URL +  "admin/main.php?view=user_update&user_id="+
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
                url: SERVER_URL + "modules/core/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_user_table",
                    module_code: getParameterByName('module_code')
                },
                dataType: "json",
                success: function (data) {
                    user_grid = new Slick.Grid("#user_grid", data, columns, options);
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
    });
</script>