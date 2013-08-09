<?php
include_once("../includes/bootstrap.php");
?>
<?=outputHTMLStartBackend("Admin Control Panel", $GLOBAL_DEPS["a74ad8dfacd4f985eb3977517615ce25"]);
?>

<div class='content'>
    <div id="client_grid" style="width: 800px; height:600px"></div>

</div>
<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "slickgrid-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
            array(
            "slickgrid")
            , $JS_DEPS)?>, function () {
        var client_grid;
        var columns = [
            {id: "id", name: "ID", field: "id", width: 50},
            {id: "email", name: "Email", field: "email", width: 150},
            {id: "name", name: "Name", field: "name", width: 150},
            {id: "tel", name: "Telephone", field: "tel", width: 150},
            {id: "mobile", name: "Mobile", field: "mobile", width: 150},
            {id: "action", name: "Action", field: "mobile", width: 100,
                formatter: linkFormatter = function (row, cell, value, columnDef, dataContext) {
                    return "<a class='icon_edit' title='View Detail' href='" + SERVER_URL + "admin/main.php?view=client_detail&client_id="+
                        dataContext['id'] + "&module_code=" + getParameterByName('module_code') + "' ></a>";
                }
            },
        ];
        var options = {
            enableCellNavigation: true,
            enableColumnReorder: false
        };

        //when page rendering is completed
        $(document).ready(function () {
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
                type: "POST",
                data: {
                    operation_id: "fetch_client_list",
                    is_archived: "N"
                },
                dataType: "json",
                success: function (data) {

                    client_grid = new Slick.Grid("#client_grid", data, columns, options);
                },
                error: function (msg) {
                    jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                }
            });
        });


    });
</script>

<?= outputHTMLEnd() ?>
