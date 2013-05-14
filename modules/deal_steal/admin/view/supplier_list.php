<h1 class="content_title">All Suppliers</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <a id="add_new_supplier" class="anchor_button" href="#">Add New Supplier</a>
    <br class="clear"/>

    <!--  Number of rows per page and bars in chart -->
    <div id="pagecontrol" class="EditableGrid">
        <label for="pagecontrol">Rows per page: </label>
        <select id="pagesize" name="pagesize">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>

    <!-- Grid filter -->
    <label for="filter" class="EditableGrid">Filter :</label>
    <input type="text" id="filter" class="EditableGrid"/>

    <?
    use modules\deal_steal\includes\classes\SupplierManager;
    $supplierManager = new SupplierManager();
    echo createGenericTable("SupplierListGrid", "EditableGrid", $supplierManager->getSupplierTableDataSource($GLOBAL_DEPS[$_REQUEST['module_code']]["supplier_logo_folder"]));
    ?>
    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>

</div>

<div id="dialog" title="Create New Supplier">
    <br/>

    <form id="createSupplierForm" action="<?= SERVER_URL ?>modules/deal_steal/admin/control/supplier_create.php"
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
    jQuery(function () {
        jQuery("input#supplier_name").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter the supplier name"
        });
    });

    //data grid
    window.onload = function () {
        var SupplierListGrid = new EditableGrid("SupplierListGrid", {
            enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
            pageSize: 10
        });

        // we build and load the metadata in Javascript
        SupplierListGrid.load({ metadata: [
            { name: "ID", datatype: "string", editable: false },
            { name: "Name", datatype: "string", editable: false },
            { name: "Logo", datatype: "html", editable: false },
            { name: "Email", datatype: "string", editable: false },
            { name: "Tel", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        SupplierListGrid.attachToHTMLTable('SupplierListGrid');
        SupplierListGrid.initializeGrid();
    };
</script>
