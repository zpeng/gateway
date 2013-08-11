<h1 class="content_title">All Articles</h1>
<div id="notification"></div>
<div id="content">
    <div id="article_grid" class="slickgrid_table" style="width:900px; height:600px"></div>
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
        var article_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "title", name: "Title", field: "title", width: 200},
            {id: "author", name: "Author", field: "author", width: 200},
            {id: "create_date", name: "Create Date", field: "create_date", width: 200},
            {id: "modified_by", name: "Modified By", field: "modified_by", width: 200},
            {id: "modified_by_date", name: "Modified By Date", field: "modified_by_date", width: 200},
            {id: "action", name: "Action", field: "action", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_delete confirm_delete' title='Delete this article' href='" + SERVER_URL + "modules/cms/control/content_delete.php?content_id="+
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>" +
                        "<a class='icon_edit' title='Edit Content' href='" + SERVER_URL + "admin/main.php?view=content_update&content_id="+
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
                url: SERVER_URL + "modules/cms/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_article_list"
                },
                dataType: "json",
                success: function (data) {
                    article_grid = new Slick.Grid("#article_grid", data, columns, options);
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