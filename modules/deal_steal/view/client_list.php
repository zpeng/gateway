<h1 class="content_title">All Clients</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $dropdown_dataSource = array(
        "data" => array(
            "Active User" => "N",
            "Inactive User" => "Y"
        ));
    $archived ="N";
    if(isset($_REQUEST["archived"])){
        $archived = secureRequestParameter($_REQUEST["archived"]);
        $dropdown_dataSource["selected"] = array($archived => $archived);
    }

    echo createDropdownList("client_status_dropdown","client_status_dropdown", "", "", "", $dropdown_dataSource);
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
    use modules\deal_steal\includes\classes\ClientManager;
    $clientManager = new ClientManager();
    echo createGenericTable("ClientListGrid", "EditableGrid", $clientManager->getClientTableDataSource($archived));
    ?>

    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>
</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "editablegrid-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "editablegrid")
    , $JS_DEPS)?>, function () {
        //data grid
        window.onload = function () {
            var ClientListGrid = new EditableGrid("ClientListGrid");

            // we build and load the metadata in Javascript
            ClientListGrid.load({ metadata: [
                { name: "ID", datatype: "string", editable: false },
                { name: "Email", datatype: "string", editable: false },
                { name: "Title", datatype: "string", editable: false },
                { name: "Name", datatype: "string", editable: false },
                { name: "Telephone", datatype: "string", editable: false },
                { name: "Mobile", datatype: "string", editable: false },
                { name: "Action", datatype: "html", editable: false }
            ]});

            // then we attach to the HTML table and render it
            ClientListGrid.attachToHTMLTable('ClientListGrid');
            ClientListGrid.renderGrid();
        };

    });

    $("#client_status_dropdown").change(function(e) {
        window.location = updateParameter("archived", $("#client_status_dropdown option:selected").val());
    });



</script>
