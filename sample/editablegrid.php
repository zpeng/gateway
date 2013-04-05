<?php
include_once("../includes/bootstrap.php");
$configManager = new ConfigurationManager(1);

?>


<?= outputHTMLStartFrontend($GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]["js_frontend_list"], $GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]["css_frontend_list"], $configManager) ?>

<div class='content'>


    <?
    $userManager = new UserManager();
    echo $userManager->outputAsHtmlTable("UserListGrid", "EditableGrid");
    ?>


</div>
<script>
    window.onload = function() {
        var editableGrid = new EditableGrid("UserListGrid");

        // we build and load the metadata in Javascript
        editableGrid.load({ metadata: [
            { name: "ID", datatype: "integer", editable: false },
            { name: "User Name", datatype: "string", editable: false },
            { name: "Accessible Modules", datatype: "string", editable: false },
            { name: "Action", datatype: "html", editable: false }
        ]});

        // then we attach to the HTML table and render it
        editableGrid.attachToHTMLTable('UserListGrid');
        editableGrid.renderGrid();
    }
</script>

<?= outputHTMLEnd() ?>
