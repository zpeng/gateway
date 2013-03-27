<?
require_once("../included/class_loader.php") ;
require_once('../included/html_functions.php');

$shipping_region_id = secureRequestParameter($_REQUEST["shipping_region_id"]);
$shipping_region = new ShippingRegion();
$shipping_region->load($shipping_region_id);

?>
<form id="ShippingRegionEditForm"  action='process/admin_shipping_region_update_process.php' method='post'
      onsubmit='return checkShippingRegionUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Shipping Region Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_shipping_region_list">
                <img src="images/go_back_24.png" />
                <br/>
                <b>Go Back</b>
            </a>
        </div>
    </fieldset>
    <?
    include_once 'admin_msg_view.php';
    ?>
    <fieldset class="content_fieldset">
        <br/>
        <table width="800" border="0" class="dialogTable" >
            <tr>
                <td width="150" align="right"><b>Shipping Region ID: </b></td>
                <td><input name="shipping_region_id" id="shipping_region_id" style="width: 300px;"
                           readonly="true" value="<?=$shipping_region_id?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Shipping Region: </b></td>
                <td><input name="shipping_region" id="shipping_region" style="width: 300px;"
                           value="<?=$shipping_region->get_shipping_region()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"></td>
                <td></td>
            </tr>
        </table>

        <br/>
    </fieldset>
</form>