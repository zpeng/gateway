<h1 class="content_title">All Templates</h1>
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
    use modules\deal_steal\includes\classes\TemplateManager;
    $templateManager = new TemplateManager();
    echo $templateManager->outputAllAsHtmlTable("TemplateListGrid", "EditableGrid");
    ?>
    <!-- Paginator control -->
    <div id="paginator" class="EditableGrid"></div>

</div>

<script>

    //data grid
    window.onload = function () {
        var TemplateListGrid = new EditableGrid("TemplateListGrid",{
            enableSort: true, // true is the default, set it to false if you don't want sorting to be enabled
            pageSize: 10
        });

        // we build and load the metadata in Javascript
        TemplateListGrid.load({ metadata: [
            { name: "ID", datatype: "string", editable: false },
            { name: "Key", datatype: "string", editable: false },
            { name: "Title", datatype: "string", editable: false },
            { name: "Description", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        TemplateListGrid.attachToHTMLTable('TemplateListGrid');
        TemplateListGrid.initializeGrid();
    };
</script>
