<?
require_once("../included/class_loader.php") ;
require_once('../included/html_functions.php');

$attribute_id = secureRequestParameter($_REQUEST["attribute_id"]);
$attribute = new Attribute();
$attribute->load($attribute_id);

?>
<form id="attributeEditForm"  action='process/admin_attribute_update_process.php' method='post'
      onsubmit='return checkFormAttributeUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Attribute Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_attribute_list">
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
                <td width="150" align="right"><b>Attribute ID: </b></td>
                <td><input name="attribute_id" id="attribute_id" style="width: 300px;"
                           readonly="true" value="<?=$attribute_id?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Attribute Name: </b></td>
                <td><input name="attribute_name" id="attribute_name" style="width: 300px;"
                           value="<?=$attribute->get_attribute_name()?>"/>
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