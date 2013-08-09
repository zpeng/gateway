<h1 class="content_title">Configuration List</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <div id="config_grid" class="slickgrid_table" style="width: 900px; height:600px"></div>
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

        var config_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "title", name: "Config Title", field: "title", width: 150},
            {id: "key", name: "Config Key", field: "key", width: 150},
            {id: "value", name: "Config Value", field: "value", width: 150},
            {id: "desc", name: "Description", field: "desc", width: 150},
            {id: "type", name: "Data Type", field: "type", width: 100},
            {id: "action", name: "Action", field: "action", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='Update Configuration' href='" + SERVER_URL +  "admin/main.php?view=config_update&config_id="+
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
                    operation_id: "fetch_config_list",
                    module_code: getParameterByName('module_code')
                },
                dataType: "json",
                success: function (data) {
                    config_grid = new Slick.Grid("#config_grid", data, columns, options);
                },
                error: function (msg) {
                    jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                }
            });
        }

        //when page rendering is completed
        $(document).ready(function () {
            fetch_data();
        });
    });
</script>
