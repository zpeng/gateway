<h1 class="content_title">Configuration List</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
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
    $configManager = new ConfigurationManager();
    echo $configManager->outputModuleConfigsAsHtmlTable($_REQUEST["module_code"],"CoreConfigListGrid", "EditableGrid");
    ?>

    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>

</div>
<script>
    window.onload = function() {
        var CoreConfigListGrid = new EditableGrid("CoreConfigListGrid",{
            enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
            pageSize: 10
        });

        // we build and load the metadata in Javascript
        CoreConfigListGrid.load({ metadata: [
            { name: "Config Title", datatype: "string", editable: false },
            { name: "Config Key", datatype: "string", editable: false },
            { name: "Config Value", datatype: "string", editable: false },
            { name: "Config Description", datatype: "string", editable: false },
            { name: "Config Datatype", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        CoreConfigListGrid.attachToHTMLTable('CoreConfigListGrid');
        CoreConfigListGrid.initializeGrid();
    };
</script>
