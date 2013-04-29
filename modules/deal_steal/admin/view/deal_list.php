<h1 class="content_title">All Deals</h1>
<div id="content">
    <a id="add_new_deal" class="anchor_button" href="#">Add New Deal</a>

    <br/><br/><br/>
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
    $dealManager = new DealManager();
    echo $dealManager->outputAllDealsAsHtmlTable("DealListGrid", "EditableGrid");
    ?>
    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>

</div>

<div id="dialog" title="Create New City">
    <br/>

    <form id="createCityForm" action="<?= SERVER_URL ?>modules/deal_steal/admin/control/city_create.php" method='post'>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
        <table width="500" border="0" class="dialogTable">
            <tr>
                <td width="150" align="right"><b>City Name: </b></td>
                <td><input name="city_name" id="city_name" style="width: 200px;"/></td>
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
    $("a#add_new_deal").button();
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
    $('a#add_new_deal').click(function () {
        $('#dialog').dialog('open');
        return false;
    });

    //form validation
    jQuery(function () {
        jQuery("input#city_name").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter the city name"
        });
    });

    //data grid
    window.onload = function () {
        var DealListGrid = new EditableGrid("DealListGrid", {
            enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
            pageSize: 10
        });

        // we build and load the metadata in Javascript
        DealListGrid.load({ metadata: [
            { name: "ID", datatype: "string", editable: false },
            { name: "Supplier", datatype: "string", editable: false },
            { name: "Category", datatype: "string", editable: false },
            { name: "City", datatype: "string", editable: false },
            { name: "Title", datatype: "string", editable: false },
            { name: "Type", datatype: "string", editable: false },
            { name: "Running Quantity", datatype: "string", editable: false },
            { name: "Online Date", datatype: "string", editable: false },
            { name: "Offline Date", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        DealListGrid.attachToHTMLTable('DealListGrid');
        DealListGrid.initializeGrid();

    };
</script>
