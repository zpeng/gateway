<h1 class="content_title">All Clients</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\ClientManager;
    $clientManager = new ClientManager();
    echo createGenericTable("ClientListGrid", "EditableGrid", $clientManager->getClientTableDataSource());
    ?>
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
</script>
