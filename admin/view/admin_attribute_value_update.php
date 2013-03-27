<?
require_once("../included/class_loader.php") ;
require_once('../included/html_functions.php');

$_attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);
$_attribute_value_id = secureRequestParameter($_REQUEST["attribute_value_id"]);

$attributeValue = new AttributeValue();
$attributeValue->load($_attribute_id);

?>
<form id="attributeValueEditForm"  action='process/admin_attribute_value_update_process.php' method='post'
      onsubmit='return checkFormAttributeValueUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Attribute Value Update</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_attribute_value_list&attribute_id=<?=$_attribute_id?>">
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
                <td width="150" align="right"><b>Attribute Value ID: </b></td>
                <td>
                    <input name="attribute_id" id="attribute_id" type="hidden" value="<?=$_attribute_id?>"/>
                    <input name="attribute_value_id" id="attribute_value_id" style="width: 300px;"
                           readonly="true" value="<?=$_attribute_value_id?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Attribute Value: </b></td>
                <td><input name="attribute_value" id="attribute_value" style="width: 300px;"
                           value="<?=$attributeValue->get_attribute_value()?>"/>
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