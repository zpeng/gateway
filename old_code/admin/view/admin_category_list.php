<link rel="stylesheet" type="text/css" href="styles/category_tree.css" />
<script type="text/javascript" src='js/simpletree.js' ></script> 
<script type="text/javascript" >
    $(function(){

        // Dialog
        $('#dialog').dialog({
            autoOpen: false, modal: true,
            width: 550,
            buttons: {
                "Cancel": function() {
                    $(this).dialog("close");
                }
            }
        });

        // Dialog Link
        $('#dialog_link').click(function(){
            $('#dialog').dialog('open');
            return false;
        });
    });
</script>
<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title"> Category List</span>
    </div>
    <div class="button_block">
        <a href="#" id="dialog_link"><img src="images/add_24.png" alt="New Category" title="New Category" border="0" />
        </a>
        <br/>
        <b>New Category</b>
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
    ?>

    <ul id="categoryTreeView" class="categoryTreeView" style="margin-left:20px;">
        <?

        $categoryManager = new CategoryManager();
        $topCategoryList = $categoryManager->getTopCategoryList();

        if (sizeof($topCategoryList)>0) {
            foreach($topCategoryList as $category) {
                echo outputCategoryAsTreeNode($category);
            }
        }
        ?>
    </ul>

    <script type="text/javascript">
        ddtreemenu.createTree("categoryTreeView", false)
    </script>


    <div id="dialog" title="Create Root Category">
        <br/>
        <form id="ContentTypeCreationForm"  action='process/admin_category_add_process.php' method='post'
              onsubmit='return checkFormCategoryAdd(this)' >
            <input type="hidden" name="category_parent_id" id="category_parent_id" value="0" />
            <table width="500" border="0" class="dialogTable" >
                <tr>
                    <td width="35%" align="right"><b>Category Name: </b></td>
                    <td><input name="category_name" id="category_name" style="width: 200px;" />
                    </td>
                </tr>
                <tr >
                    <td width="35%" align="right"><b>Category Description: </b></td>
                    <td><input name="category_description" id="category_description" style="width: 200px;" />
                    </td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input name='Create' type='submit'  value='Create' class="ui-state-default ui-corner-all"/>
                        <input name='Reset' type='reset' value='Reset' class="ui-state-default ui-corner-all"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

</fieldset>
