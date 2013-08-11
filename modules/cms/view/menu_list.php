<h1 class="content_title">All Menus</h1>
<div id="notification"></div>
<div id="content">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Top Menu</a></li>
            <li><a href="#tabs-2">Bottom Menu</a></li>
        </ul>
        <div id="tabs-1">
            <div id="top_menu_grid" class="slickgrid_table" style="width:900px; height:600px"></div>
        </div>
        <div id="tabs-2">
            <div id="bottom_menu_grid" class="slickgrid_table" style="width:900px; height:600px"></div>
        </div>
    </div>
</div>
<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "slickgrid-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "slickgrid",
    "jquery-ui")
    , $JS_DEPS)?>, function () {
            var top_menu_grid;
            var bottom_menu_grid;
            var top_menu_data =[];
            var bottom_menu_data =[];

            var top_menu_indentFormatter = function (row, cell, value, columnDef, dataContext) {
                    var spacer = "<span style='display:inline-block;height:1px;width:" + (20 * dataContext["level"]) + "px'></span>";
                    var idx = top_menu_dataView.getIdxById(dataContext.id);
                    if (top_menu_data[idx + 1] && top_menu_data[idx + 1].level > top_menu_data[idx].level) {
                        if (dataContext._collapsed) {
                            return spacer + " <span class='toggle expand'></span>&nbsp;" + value;
                        } else {
                            return spacer + " <span class='toggle collapse'></span>&nbsp;" + value;
                        }
                    } else {
                        return spacer + " <span class='toggle'></span>&nbsp;" + value;
                    }
                };

            var bottom_menu_indentFormatter = function (row, cell, value, columnDef, dataContext) {
                    var spacer = "<span style='display:inline-block;height:1px;width:" + (20 * dataContext["level"]) + "px'></span>";
                    var idx = bottom_menu_dataView.getIdxById(dataContext.id);
                    if (bottom_menu_data[idx + 1] && bottom_menu_data[idx + 1].level > bottom_menu_data[idx].level) {
                        if (dataContext._collapsed) {
                            return spacer + " <span class='toggle expand'></span>&nbsp;" + value;
                        } else {
                            return spacer + " <span class='toggle collapse'></span>&nbsp;" + value;
                        }
                    } else {
                        return spacer + " <span class='toggle'></span>&nbsp;" + value;
                    }
                };


            var top_menu_columns = [
                {id: "id", name: "ID", field: "id", width: 50},
                {id: "title", name: "Title", field: "title", width: 200, formatter: top_menu_indentFormatter},
                {id: "link", name: "Link", field: "link", width: 200},
                {id: "order", name: "Order", field: "order", width: 50},
                {id: "desc", name: "Description", field: "desc", width: 100},
                {id: "action", name: "Action", field: "action", width: 80,
                    formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                        return "<a class='icon_delete confirm_delete' title='Delete this menu' href='" + SERVER_URL + "modules/cms/control/menu_delete.php?menu_id=" +
                            dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>" +
                            "<a class='icon_edit' title='Update Menu' href='" + SERVER_URL + "admin/main.php?view=menu_update&menu_id=" +
                            dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>";
                    }
                }
            ];

            var bottom_menu_columns = [
                {id: "id", name: "ID", field: "id", width: 50},
                {id: "title", name: "Title", field: "title", width: 200, formatter: bottom_menu_indentFormatter},
                {id: "link", name: "Link", field: "link", width: 200},
                {id: "order", name: "Order", field: "order", width: 50},
                {id: "desc", name: "Description", field: "desc", width: 100},
                {id: "action", name: "Action", field: "action", width: 80,
                    formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                        return "<a class='icon_delete confirm_delete' title='Delete this menu' href='" + SERVER_URL + "modules/cms/control/menu_delete.php?menu_id=" +
                            dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>" +
                            "<a class='icon_edit' title='Update Menu' href='" + SERVER_URL + "admin/main.php?view=menu_update&menu_id=" +
                            dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>";
                    }
                }
            ];

            var options = {
                enableCellNavigation: true,
                enableColumnReorder: false,
                forceFitColumns: true,
                asyncEditorLoading: false
            };

            var top_menu_dataView = new Slick.Data.DataView();

            var bottom_menu_dataView = new Slick.Data.DataView();

            top_menu_grid = new Slick.Grid("#top_menu_grid", top_menu_dataView, top_menu_columns, options);
            top_menu_grid.onClick.subscribe(function (e, args) {
                if ($(e.target).hasClass("toggle")) {
                    var item = top_menu_dataView.getItem(args.row);
                    if (item) {
                        if (!item._collapsed) {
                            item._collapsed = true;
                        } else {
                            item._collapsed = false;
                        }

                        top_menu_dataView.updateItem(item.id, item);
                    }
                    e.stopImmediatePropagation();
                }
            });

            bottom_menu_grid = new Slick.Grid("#bottom_menu_grid", bottom_menu_dataView, bottom_menu_columns, options);
            bottom_menu_grid.onClick.subscribe(function (e, args) {
                if ($(e.target).hasClass("toggle")) {
                    var item = bottom_menu_dataView.getItem(args.row);
                    if (item) {
                        if (!item._collapsed) {
                            item._collapsed = true;
                        } else {
                            item._collapsed = false;
                        }

                        bottom_menu_dataView.updateItem(item.id, item);
                    }
                    e.stopImmediatePropagation();
                }
            });

            // wire up model events to drive the grid
            top_menu_dataView.onRowCountChanged.subscribe(function (e, args) {
                top_menu_grid.updateRowCount();
                top_menu_grid.render();
            });

            top_menu_dataView.onRowsChanged.subscribe(function (e, args) {
                top_menu_grid.invalidateRows(args.rows);
                top_menu_grid.render();
            });

            // wire up model events to drive the grid
            bottom_menu_dataView.onRowCountChanged.subscribe(function (e, args) {
                bottom_menu_grid.updateRowCount();
                bottom_menu_grid.render();
            });

            bottom_menu_dataView.onRowsChanged.subscribe(function (e, args) {
                bottom_menu_grid.invalidateRows(args.rows);
                bottom_menu_grid.render();
            });

            //use ajax to load data source
            function fetch_data() {
                $.ajax({
                    url: SERVER_URL + "modules/cms/control/fetch_service.php",
                    type: "POST",
                    data: {
                        menu_type_id: 1,
                        operation_id: "fetch_menu_list"
                    },
                    dataType: "json",
                    success: function (data) {
                        top_menu_data = data;
                        top_menu_dataView.beginUpdate();
                        top_menu_dataView.setItems(top_menu_data);
                        top_menu_dataView.endUpdate();
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });

                $.ajax({
                    url: SERVER_URL + "modules/cms/control/fetch_service.php",
                    type: "POST",
                    data: {
                        menu_type_id: 2,
                        operation_id: "fetch_menu_list"
                    },
                    dataType: "json",
                    success: function (data) {
                        bottom_menu_data = data;
                        bottom_menu_dataView.beginUpdate();
                        bottom_menu_dataView.setItems(bottom_menu_data);
                        bottom_menu_dataView.endUpdate();
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
            }



            //when page rendering is completed
            $(document).ready(function () {
                fetch_data();

                jQuery("#tabs").tabs();
            });
        }
    )
    ;
</script>