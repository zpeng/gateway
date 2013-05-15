<h1 class="content_title">All Menus</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <ul>
        <li><a href="#tabs-1">Top Menu</a></li>
        <li><a href="#tabs-2">Bottom Menu</a></li>
    </ul>
    <div id="tabs-1">
        <?
        use modules\cms\includes\classes\MenuManager;

        $menuManager = new MenuManager();
        echo createGenericTable("TopMenuListGrid", "EditableGrid", $menuManager->getMenuTableDataSource(1));
        ?>
    </div>
    <div id="tabs-2">
        <?
        echo createGenericTable("BottomMenuListGrid", "EditableGrid", $menuManager->getMenuTableDataSource(2));
        ?>
    </div>
</div>
<br/>
<script>
    jQuery(function () {
        jQuery("#content").tabs();
    });

    window.onload = function () {
        var TopMenuListGrid = new EditableGrid("TopMenuListGrid");
        // we build and load the metadata in Javascript
        TopMenuListGrid.load({ metadata: [
            { name: "ID", datatype: "integer", editable: false },
            { name: "Menu Title", datatype: "string", editable: false },
            { name: "Link", datatype: "string", editable: false },
            { name: "Order", datatype: "integer", editable: false },
            { name: "Description", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        TopMenuListGrid.attachToHTMLTable('TopMenuListGrid');
        TopMenuListGrid.renderGrid();


        var BottomMenuListGrid = new EditableGrid("BottomMenuListGrid");
        // we build and load the metadata in Javascript
        BottomMenuListGrid.load({ metadata: [
            { name: "ID", datatype: "integer", editable: false },
            { name: "Menu Title", datatype: "string", editable: false },
            { name: "Link", datatype: "string", editable: false },
            { name: "Order", datatype: "integer", editable: false },
            { name: "Description", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        BottomMenuListGrid.attachToHTMLTable('BottomMenuListGrid');
        BottomMenuListGrid.renderGrid();
    };


</script>