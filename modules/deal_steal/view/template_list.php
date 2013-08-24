<h1 class="content_title">All Templates</h1>
<div id="notification"></div>
<div id="content">
    <div id="template_grid" class="slickgrid_table" style="width:900px; height:600px"></div>
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
        var template_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "key", name: "Key", field: "key", width: 200},
            {id: "title", name: "Title", field: "title", width: 200},
            {id: "desc", name: "Description", field: "desc", width: 300},
            {id: "action", name: "Action", field: "action", width: 50,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='Edit Template' href='" + SERVER_URL + "admin/main.php?view=template_update&template_id="+
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
                    operation_id: "fetch_template_table"
                },
                dataType: "json",
                success: function (data) {
                    template_grid = new Slick.Grid("#template_grid", data, columns, options);
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
