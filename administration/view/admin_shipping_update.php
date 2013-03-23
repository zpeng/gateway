<?
require_once("../included/class_loader.php") ;
require_once('../included/html_functions.php');

$shipping_id = secureRequestParameter($_REQUEST["shipping_id"]);
$shipping = new Shipping();
$shipping->load($shipping_id);

?>
<form id="ShippingRegionEditForm"  action='process/admin_shipping_update_process.php' method='post'
      onsubmit='return checkShippingMethodUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Shipping Method Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_shipping_list">
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
                <td width="150" align="right"><b>Shipping ID: </b></td>
                <td><input name="shipping_id" id="shipping_id" style="width: 300px;"
                           readonly="true" value="<?=$shipping_id?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Shipping Region: </b></td>
                <td>
                    <? 
                    
                    echo outputShippingRegionListAsDropdownList('shipping_region', 300, $shipping->get_shipping_region_id());?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Shipping Type: </b></td>
                <td><input name="shipping_type" id="shipping_type" style="width: 300px;"
                           value="<?=$shipping->get_shipping_type()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Shipping Cost: </b></td>
                <td><input name="shipping_cost" id="shipping_cost" style="width: 300px;"
                           value="<?=$shipping->get_shipping_cost()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"></td>
                <td>
                    <textarea cols="30" rows="3" name="shipping_detail"
                              id="shipping_detail" style="width: 300px;"><?=$shipping->get_shipping_detail()?></textarea>
                </td>
            </tr>
        </table>

        <br/>
    </fieldset>
</form>