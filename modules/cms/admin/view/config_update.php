<h1 class="content_title">Update Configuration</h1>
<div id="notification"></div>
<div id="content">
    <?
    $config_id = secureRequestParameter($_REQUEST["config_id"]);
    $config = new Configuration();
    $config->loadById($config_id);
    ?>
    <br/>
    <form id="ConfigUpdateForm" method="post">
        <input type="hidden" value="<? echo $config_id ?>" name="config_id" id="config_id"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>Config Title: </b></td>
                <td><? echo $config->get_configuration_title()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Config Module: </b></td>
                <td><? echo $config->get_configuration_module_name()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Config Description: </b></td>
                <td><? echo $config->get_configuration_desc()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Config Key: </b></td>
                <td><? echo $config->get_configuration_key()?>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Config Value: </b></td>
                <td><textarea  name='config_value' id='config_value' rows="4" cols="50"><?=$config->get_configuration_value()?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
    <script>
        $("#update_btn").button();

        jQuery('form#ConfigUpdateForm').submit(function () {
            var config_id = $("#config_id").val();
            var config_value = $("#config_value").val();

            $.ajax({
                url: SERVER_URL + "modules/cms/admin/control/config_update.php",
                type: "POST",
                data: {config_id: config_id,
                    config_value: config_value
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success"){
                        jQuery("div#notification").html("<span class='info'>Configuration value has been updated successfully!</span>");
                    }else{
                        jQuery("div#notification").html("<span class='error'>Unable to update this configuration value. Try again please!</span>");
                    }
                },
                error: function () {
                    jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                }
            });
            return false;
        });
    </script>
</div>
