<?
require_once("../included/class_loader.php") ;
require_once("../included/html_functions.php") ;
include_once("../fckeditor/fckeditor.php") ;

$brand_id = secureRequestParameter($_REQUEST["brand_id"]);
$brand = new Manufacturer();
$brand->load($brand_id);
?>
<form  action='process/admin_brand_update_process.php' method='post' enctype='multipart/form-data'
      onsubmit='return checkBrandUpdateForm(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title">Brand/Manufacturer Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_brand_list">
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
                <td width='150' align='right'><b>ID: </b></td>
                <td align='left'><input id='brand_id'  name='brand_id' readonly="true" style='width: 300px;' value='<?=$brand->get_manufacturer_id()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Name: </b></td>
                <td align='left'><input id='brand_name' name='brand_name' style='width: 300px;' value='<?=$brand->get_manufacturer_name()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>URL: </b></td>
                <td align='left'><input id='brand_url' name='brand_url' style='width: 300px;' value='<?=$brand->get_manufacturer_url()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Logo: </b></td>
                <td align='left'>
                    <?=$brand->get_brand_logo_as_image(50,50, $s_configManager->getValueByKey("domain_name"))?>
                    <input name="image_uploaded" type='file'  />
                </td>
            </tr>
            <tr>
                <td align='right' valign="top"><b>Description: </b></td>
                <td align='left' height='500' >
                    <?
                    $article = "brand_desc";
                    $oFCKeditor = new FCKeditor($article) ;
                    $oFCKeditor->Height = '512' ;
                    $oFCKeditor->BasePath = '../fckeditor/' ;
                    $oFCKeditor->Value = $brand->get_manufacturer_desc();
                    $oFCKeditor->Create();
                    ?>
                </td>
            </tr>


        </table>
        <br/>

    </fieldset>
</form>