<h1 class="content_title">Concierge Service</h1>
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

    <br/><br/>

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

    use modules\deal_steal\includes\classes\ConciergeManager;
    $conciergeManager = new ConciergeManager();
    echo createGenericTable("ConciergeListGrid", "EditableGrid", $conciergeManager->getConciergeListDataSource($status));
    ?>
    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>

</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "editablegrid-css",

    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "editablegrid",
    "jquery-ui")
    , $JS_DEPS)?>, function () {
        //data grid
        window.onload = function () {
            var ConciergeListGrid = new EditableGrid("ConciergeListGrid", {
                enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
                pageSize: 10
            });

            // we build and load the metadata in Javascript
            ConciergeListGrid.load({ metadata: [
                { name: "Concierge ID", datatype: "string", editable: false },
                { name: "Client Name", datatype: "string", editable: false },
                { name: "Supplier", datatype: "string", editable: false },
                { name: "Created Date", datatype: "string", editable: false },
                { name: "Status", datatype: "string", editable: false },
                { name: "Action", datatype: "html", editable: false }
            ]});

            // then we attach to the HTML table and render it
            ConciergeListGrid.attachToHTMLTable('ConciergeListGrid');
            ConciergeListGrid.initializeGrid();
        };
    });


    $("#status_dropdown").change(function(e) {
        window.location = updateParameter("status", $("#status_dropdown option:selected").text());
    });


</script>
