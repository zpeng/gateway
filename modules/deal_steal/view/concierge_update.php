<h1 class="content_title">Concierge Request Detail</h1>
<div id="notification"></div>
<div id="content">
    <?
    $con_id = secureRequestParameter($_REQUEST["con_id"]);

    use modules\deal_steal\includes\classes\Concierge;
    $concierge = new Concierge();
    $concierge->loadById($con_id);
    ?>
    <br/>

    <form id="ConciergeUpdateForm" method="post">
        <input type="hidden" value="<? echo $con_id ?>" name="con_id" id="con_id"/>
        <table class="general_table">
            <tr>
                <td width="150" align="right"><b>Concierge ID: </b></td>
                <td><? echo $concierge->getId()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Client Name: </b></td>
                <td><? echo $concierge->getClientName()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Supplier: </b></td>
                <td><? echo $concierge->getSupplierName()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Created at: </b></td>
                <td><? echo $concierge->getTimestamp()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Request Detail: </b></td>
                <td><? echo $concierge->getRequestDetail()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Request Date: </b></td>
                <td><? echo $concierge->getRequestDate()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Budget: </b></td>
                <td><? echo $concierge->getRequestBudget()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Status: </b></td>
                <td><?
                    $dropdown_dataSource = array(
                        "data" => array(
                            "Pending" => "Pending",
                            "Negotiating" => "Negotiating",
                            "Closed" => "Closed"
                        ),
                        "selected" =>array(
                            $concierge->getStatus() => $concierge->getStatus()
                        ));
                    echo createDropdownList("status_dropdown","status_dropdown", "", "", "", $dropdown_dataSource);
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
    <script>
        // load css
        head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

        // load js
        head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {
            $("#update_btn").button();

            jQuery('form#ConciergeUpdateForm').submit(function () {
                var con_id = $("#con_id").val();
                var status = $("#status_dropdown option:selected").text();

                $.ajax({
                    url: SERVER_URL + "modules/deal_steal/control/concierge_update.php",
                    type: "POST",
                    data: {con_id: con_id,
                           status: status
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Concierge status has been updated successfully!</span>");
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update this concierge status. Try again please!</span>");
                        }
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
                return false;
            });

        });
    </script>
</div>
