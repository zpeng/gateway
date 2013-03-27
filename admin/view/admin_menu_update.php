<?
require_once("../included/class_loader.php") ;

$menu_id = secureRequestParameter($_REQUEST["menu_id"]);
$menu = new Menu();
$menu->load($menu_id);
$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

?>
<form action='process/admin_menu_update_process.php' method='post'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Menu Update</span>
        </div>
        <div class="button_block">
            <a>
            <input name='Publish' type='image'  value='Publish' title="Publish" src="images/save_24.png"/>
            </a><br/>
            <b>Publish</b>
        </div>
        <div class="button_block">
            <a href='process/admin_menu_delete_process.php?menu_id=<?=$menu_id?>'
                       onclick='return confirmDeletion()'>
                <img src="images/delete_24.png" alt="Delete" title="Delete" border="0" />
            </a><br/>
            <b>Delete</b>
        </div>
    </fieldset>
<?
include_once 'admin_msg_view.php';
?>
    <fieldset class="content_fieldset">
        <br/>
        <table width="800" border="0" style="font-size:100%;" cellpadding="3"  >
            <input name="menu_id" value="<? echo $menu_id; ?>" type="hidden"/>
            <?
            if (sizeof($languageList) > 0) {
                $language = new Language();
                $count=0;
                foreach($languageList as $language) {
                    $menuDescription = new MenuDescription();
                    $menuDescription = $menu->loadMenuDescriptionByLanguageID($language->get_language_id());

                    if ($menuDescription != null) {
                        echo "
                                <tr>
                                    <td width='150' align='right'><b>Menu Name:</b></td>
                                    <td align='left'><input name='menu_name".$count."' value='".$menuDescription->get_menu_name()."' style='width: 150px;' />".$language->get_language_icon_as_image()."</td>
                                </tr>";

                    }else {
                        echo "
                                <tr>
                                    <td width='150' align='right'><b>Menu Name:</b></td>
                                    <td align='left'><input name='menu_name".$count."' style='width: 150px;' />".$language->get_language_icon_as_image()."</td>
                                </tr>";
                    }
                    $count++;
                }
            }

            ?>

            <tr>
                <td width="150" align='right'><b>Display Order:</b></td>
                <td align='left'><input name="menu_order" style="width: 150px;" value="<? echo $menu->get_menu_order(); ?>"
                                        /></td>
            </tr>

            <tr>
                <td width="150" align='right'><b>Link:</b></td>
                <td align='left'><input name="menu_link" style="width: 600px;" value="<? echo $menu->get_menu_link(); ?>"
                                        /></td>
            </tr>
            <tr>
                <td width="150" ></td>
                <td align='left'></td>
            </tr>
        </table>
        <br/>
    </fieldset>

</form>

