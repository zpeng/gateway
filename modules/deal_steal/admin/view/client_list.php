<h1 class="content_title">All Clients</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">

    <?
    $clientManager = new ClientManager();
    echo $clientManager->outputClientsAsHtmlTable("ClientListGrid", "EditableGrid");
    ?>

</div>

<script>
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
</script>
