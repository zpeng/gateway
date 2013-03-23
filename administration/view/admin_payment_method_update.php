<?
require_once("../included/class_loader.php") ;
require_once("../included/html_functions.php") ;
include_once("../fckeditor/fckeditor.php") ;

$payment_method_id = secureRequestParameter($_REQUEST["payment_method_id"]);
$paymentMethod = new PaymentMethod();
$paymentMethod->load($payment_method_id);
?>
<form  action='process/admin_payment_method_update_process.php' method='post' enctype='multipart/form-data'
      onsubmit='return checkPaymentMethodUpdateForm(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title">Payment Method Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_payment_method_list">
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
        <table width='800' border='0' style='font:100%;' cellpadding='3' >
            <tr>
                <td width='150' align='right'><b>Payment Method ID: </b></td>
                <td align='left'><input id='payment_method_id' name='payment_method_id' readonly="true" style='width: 300px;' value='<?=$paymentMethod->get_payment_method_id()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Name: </b></td>
                <td align='left'><input id='payment_method_name' name='payment_method_name' style='width: 300px;' value='<?=$paymentMethod->get_payment_method_name()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Include Path: </b></td>
                <td align='left'><input id='payment_method_include_path' name='payment_method_include_path' style='width: 300px;' value='<?=$paymentMethod->get_payment_method_include_path()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Logo: </b></td>
                <td align='left'>
                    <?=$paymentMethod->get_payment_method_logo_as_image("110", "40", $s_configManager->getValueByKey("domain_name"))?>
                    <input name="image_uploaded" type='file'  />
                </td>
            </tr>
            <tr>
                <td align='right' valign="top"><b>Description: </b></td>
                <td align='left' >
                    <textarea cols="35" rows="10" name="payment_method_desc"><?=$paymentMethod->get_payment_method_desc()?></textarea>
                </td>
            </tr>
        </table>
        <br/>

    </fieldset>
</form>