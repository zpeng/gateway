<h1 class="content_title">Update Configuration</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    $config_id = secureRequestParameter($_REQUEST["config_id"]);
    $module_code = secureRequestParameter($_REQUEST["module_code"]);

    $config = new Configuration();
    $config->loadById($config_id);
    ?>
    <br/>
    <form id="ConfigUpdateForm" action="<?= SERVER_URL ?>modules/core/admin/control/config_update.php" method="post">
        <input type="hidden" value="<? echo $config_id ?>" name="config_id"/>
        <input type="hidden" value="<? echo $config->get_configuration_key() ?>" name="config_key"/>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
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
    </script>
</div>
