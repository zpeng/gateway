<?php
include_once("../fckeditor/fckeditor.php") ;
require_once('../included/class_loader.php') ;
$content_id = secureRequestParameter($_REQUEST["content_id"]);
$content = new Content();
$content->load($content_id);

$categoryManager = new CategoryManager();
$topCategoryList = $categoryManager->getTopCategoryList();

$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

?>
<form action='process/admin_content_update_process.php' method='post'>
    <input type='hidden' value='<?=$content->get_content_id()?>' name='content_id' />
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Content Edit</span>
        </div>
        <div class="button_block">
            <a>
                <input name='Publish' type='image'  value='Publish' title="Publish" src="images/save_24.png"/>
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href='process/admin_content_delete_process.php?content_id=<?=$content->get_content_id()?>'
               onclick='return confirmDeletion()'>
                <img src="images/delete_24.png" alt="Delete" title="Delete" border="0"/>
            </a><br/>
            <b>Delete</b>
        </div>        
    </fieldset>
    <?
    include_once 'admin_msg_view.php';
    ?>

    <fieldset class="content_fieldset">
        <div id="accordion">
            <dl class="accordion" id="my_accordion" >

                <?
                if (sizeof($languageList) > 0) {
                    $language = new Language();
                    foreach($languageList as $language) {
                        $contentDescription = new ContentDescription();
                        $contentDescription = $content->loadContentDescriptionByLanguageID($language->get_language_id());

                        if ($contentDescription != null) {
                            echo "<dt>".$language->get_language_icon_as_image()."</dt>
                          <dd>
                            <center><br/>
                            <table width='850' border='0' style='font:100%;' cellpadding='3' >
                            <input type='hidden' value='".$contentDescription->get_content_description_id()."' name='content_description_id".$language->get_language_id()."' />
							<tr>
                                    <td width='100' align='right'><b>Title: </b></td>
                                    <td align='left'><input name='title".$language->get_language_id()."' style='width: 800px;' value='".$contentDescription->get_title()."' /></td>
                                </tr>
                                <tr>
                                    <td width='100' align='right'><b>Abstract: </b></td>
                                    <td align='left'><input name='abstract".$language->get_language_id()."' style='width: 800px;' value='".$contentDescription->get_abstract()."' /></td>
                                </tr>
                                <tr>
                                    <td align='left' height='500' colspan='2'> ";
                            $article = "article".$language->get_language_id();
                            $oFCKeditor = new FCKeditor($article) ;
                            $oFCKeditor->Height = '512' ;
                            $oFCKeditor->BasePath = '../fckeditor/' ;
                            $oFCKeditor->Value = $contentDescription->get_article();
                            $oFCKeditor->Create() ;

                            echo "
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            </center>
                        </dd>
                        ";
                        }else {
                            echo " <dt>".$language->get_language_icon_as_image()."</dt>
                           <dd>
                            <center>
                            <table width='850' border='0' style='font:100%;' cellpadding='3' >
							<tr>
                            <input type='hidden' value='0' name='content_description_id".$language->get_language_id()."' />
                                    <td width='100' align='right'><b>Title: </b></td>
                                    <td align='left'><input name='title".$language->get_language_id()."' style='width: 800px;'  /></td>
                                </tr>
                                <tr>
                                    <td width='100' align='right'><b>Abstract: </b></td>
                                    <td align='left'><input name='abstract".$language->get_language_id()."' style='width: 800px;'  /></td>
                                </tr>
                                <tr>
                                    <td align='left' height='500' colspan='2'> ";
                            $article = "article".$language->get_language_id();
                            $oFCKeditor = new FCKeditor($article) ;
                            $oFCKeditor->Height = '512' ;
                            $oFCKeditor->BasePath = '../fckeditor/' ;
                            $oFCKeditor->Create() ;

                            echo "
                                    </td>
                                </tr>
                            </table>
                            </center>
                        </dd>";
                        }
                        $count++;
                    }
                }

                ?>
            </dl>
        </div>
    </fieldset>
    <br/>

</form>
<script type="text/javascript">
    var my_accordion=new accordion.slider("my_accordion");
    my_accordion.init("my_accordion",0,"open");
</script>





