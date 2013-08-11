<h1 class="content_title">Client Detail</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Client;
    $client_id = secureRequestParameter($_REQUEST["client_id"]);
    $client = new Client();
    $client->loadById($client_id);
    ?>
    <br/>

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Client Detail</a></li>
            <li><a href="#tabs-2">Purchase History</a></li>
            <li><a href="#tabs-3">Concierge History</a></li>
        </ul>

        <div id="tabs-1">
            <form id="DealDetailUpdateForm" method='post'>
                <input type="hidden" value="<? echo $client_id ?>" id="client_id" name="client_id"/>
                <table class="general_table">
                    <tr>
                        <td width="150" align="right"><b>Client ID: </b></td>
                        <td><?= $client->getClientId() ?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Client Email: </b></td>
                        <td><?= $client->getClientEmail() ?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Title: </b></td>
                        <td><?= $client->getClientTitle() ?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Name: </b></td>
                        <td><?= $client->getClientFirstname() . " " . $client->getClientSurname()?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Date of Birth: </b></td>
                        <td><?= $client->getClientDob()?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Telephone: </b></td>
                        <td><?= $client->getClientTel()?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Mobile Phone: </b></td>
                        <td><?= $client->getClientMobile()?></td>
                    </tr>

                    <tr>
                        <td width="150" align="right"><b>Is Subscribed: </b></td>
                        <td><?= $client->getSubscribed()?></td>
                    </tr>

                    <tr>
                        <td width="150" align="right"><b>Client Status: </b></td>
                        <td>
                            <?
                            $dropdown_dataSource = array(
                                "data" => array(
                                    "Active User" => "N",
                                    "Inactive User" => "Y"
                                ));
                            $dropdown_dataSource["selected"] = array($client->getClientArchived() => $client->getClientArchived());
                            echo createDropdownList("client_status_dropdown","client_status_dropdown", "", "", "", $dropdown_dataSource);
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="tabs-2">
        </div>

        <div id="tabs-3">
        </div>

    </div>

</div>

<script>
    // load css
    head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css",
    "tiny_mce-css")
    , $CSS_DEPS)?>);

    // load js
    head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate",
    "tiny_mce",
    "jquery-ui-timepicker")
    , $JS_DEPS)?>, function () {

        $("#tabs").tabs();

        // **** tab 1 logic ****
        $("#client_status_dropdown").change(function(e) {
            var client_id = $("#client_id").val();
            var is_archived = $("#client_status_dropdown option:selected").val();

            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/client_status_update.php",
                type: "POST",
                data: {client_id: client_id,
                       is_archived: is_archived
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        jQuery("div#notification").html("<span class='info'>Client status has been updated successfully!</span>");
                    } else {
                        jQuery("div#notification").html("<span class='error'>Unable to update this client status. Try again please!</span>");
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