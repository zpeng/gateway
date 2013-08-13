<h1 class="content_title">All Suppliers</h1>
<div id="notification"></div>
<div id="content">
    <a id="add_new_supplier" class="anchor_button" href="#">Add New Supplier</a>
    <br class="clear"/>
    <?
    $dropdown_dataSource = array(
        "data" => array(
            "Active Supplier" => "N",
            "Inactive Supplier" => "Y"
        ));
    echo createDropdownList("supplier_status_dropdown","supplier_status_dropdown", "", "", "", $dropdown_dataSource);
    ?>
    <div id="supplier_grid" class="slickgrid_table" style="width:900px; height:600px"></div>
</div>

<div id="dialog" title="Create New Supplier">
    <br/>

    <form id="createSupplierForm" action="<?= SERVER_URL ?>modules/deal_steal/control/supplier_create.php"
          method='post'>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table width="500" border="0" class="dialogTable">
            <tr>
                <td width="150" align="right"><b>Supplier Name: </b></td>
                <td><input name="supplier_name" id="supplier_name" style="width: 200px;"/></td>
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
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {
        $("a#add_new_supplier").button();
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
        $('a#add_new_supplier').click(function () {
            $('#dialog').dialog('open');
            return false;
        });

        //form validation
        jQuery("input#supplier_name").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter the supplier name"
        });

        //data grid
        var supplier_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50, sortable: true},
            {id: "logo", name: "Logo", field: "logo", width: 100, sortable: false,
                formatter: function (row, cell, value, columnDef, dataContext) {
                    return  "<img border='' width='15' height='15' class='' src='<?=$GLOBAL_DEPS[$_REQUEST['module_code']]["supplier_logo_folder"]?>" + dataContext['logo'] + "' />";
                }
            },
            {id: "name", name: "Name", field: "name", width: 400, sortable: true },
            {id: "action", name: "Action", field: "mobile", width: 150,
                formatter: function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='Update supplier' href='" + SERVER_URL + "admin/main.php?view=supplier_update&supplier_id=" +
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code')+"'></a>";
                }
            }
        ];
        var options = {
            enableCellNavigation: true,
            enableColumnReorder: false,
            forceFitColumns: true
        };
        var dataView = new Slick.Data.DataView();

        supplier_grid = new Slick.Grid("#supplier_grid", dataView, columns, options);

        supplier_grid.onSort.subscribe(function (e, args) {
            // We'll use a simple comparer function here.
            var comparer = function (a, b) {
                return a[args.sortCol.field] > b[args.sortCol.field];
            }

            // Delegate the sorting to DataView.
            // This will fire the change events and update the grid.
            dataView.sort(comparer, args.sortAsc);
            supplier_grid.invalid
            supplier_grid.render();
        });

        dataView.onRowsChanged.subscribe(function (e, args) {
            supplier_grid.invalidateRows(args.rows);
            supplier_grid.render();
        });

        //use ajax to load data source
        function fetch_data() {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_supplier_list",
                    is_archived: $("#supplier_status_dropdown option:selected").val()
                },
                dataType: "json",
                success: function (data) {
                    dataView.beginUpdate();
                    dataView.setItems(data);
                    dataView.endUpdate();
                    supplier_grid.render();
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
        $("#supplier_status_dropdown").change(function(e) {
            fetch_data();
        });

    });
</script>
