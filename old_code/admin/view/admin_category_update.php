<?
require_once("../included/class_loader.php") ;
require_once('../included/html_functions.php');

$category_id = secureRequestParameter($_REQUEST["id"]);
$category = new Category();
$category->load($category_id);

?>
<form id="userContentTypeEditForm"  action='process/admin_category_update_process.php' method='post'
      onsubmit='return checkFormCategoryUpdate(this)'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Category Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href='process/admin_category_delete_process.php?category_id=<?=$category_id?>'   onclick='return confirmDeletion()' style="padding: 0">
                <img src="images/delete_24.png" alt="Delete" title="Delete" border="0" />
            </a><br/>
            <b>Delete</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_category_list">
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
                <td width="150" align="right"><b>Category ID: </b></td>
                <td><input name="category_id" id="category_id" style="width: 300px;"
                           readonly="true" value="<?=$category->get_category_id()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Category Name: </b></td>
                <td><input name="category_name" id="category_name" style="width: 300px;"
                           value="<?=$category->get_category_name()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Category Description: </b></td>
                <td><input name="category_description" id="category_description" style="width: 300px;"
                           value="<?=$category->get_category_desc()?>"/>
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