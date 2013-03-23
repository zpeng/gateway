<form id="ContentTypeCreationForm"  action='process/admin_category_add_process.php' method='post'
      onsubmit='return checkFormCategoryAdd(this)' >
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Add Sub Category</span>
        </div>
        <div class="button_block">
            <a>
                <input name='Save' type='image' value='Save' src="images/save_24.png"  />
            </a>
            <br/>
            <b>Save</b>
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
        <?
        require_once("../included/class_loader.php") ;
        require_once("../included/html_functions.php") ;
        $parent_category_id = secureRequestParameter($_REQUEST["parent_category_id"]);
        $parent_category = new Category();
        $parent_category->load($parent_category_id);
        ?>

        <br/>

        <input type="hidden" name="category_parent_id" id="category_parent_id" value="<?=$parent_category_id?>" />
        <table width="800" border="0" class="dialogTable" >
            <tr>
                <td width="150" align="right"><b>Parent Category Name: </b></td>
                <td><input readonly="true" name="parent_category_name" id="parent_category_name" style="width: 200px;"
                           value="<?=$parent_category->get_category_name()?>"/>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Category Name: </b></td>
                <td><input name="category_name" id="category_name" style="width: 200px;" />
                </td>
            </tr>
            <tr >
                <td align="right"><b>Category Description: </b></td>
                <td><input name="category_description" id="category_description" style="width: 200px;" />
                </td>
            </tr>
            <tr>
                <td align="right"></td>
                <td></td>
            </tr>
        </table>
    </fieldset>
</form>