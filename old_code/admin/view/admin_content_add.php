<?php
include_once("../fckeditor/fckeditor.php") ;
require_once("../included/class_loader.php") ;

$languageManager = new LanguageManager();
$languageList = $languageManager->getLanguageList();

?>
<form action='process/admin_content_add_process.php' method='post'>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title"> Create New Content</span>
        </div>
        <div class="button_block">
            <a>
                <input name='Publish' type='image'  value='Publish' title="Publish" src="images/save_24.png"/>
            </a><br/>
            <b>Publish</b>
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
                        echo " <dt>".$language->get_language_icon_as_image()."</dt>
                            <dd>
                            <center>
                            <br/>
                            <table width='850' border='0' style='font:100%;' cellpadding='3' >
                                <tr>
                                    <td width='100' align='right'><b>Title: </b></td>
                                    <td align='left'><input name='title".$language->get_language_id()."' style='width: 800px;' /></td>
                                </tr>
                                <tr>
                                    <td width='100' align='right'><b>Abstract: </b></td>
                                    <td align='left'><input name='abstract".$language->get_language_id()."' style='width: 800px;' /></td>
                                </tr>
                                <tr>
                                  <td align='left' height='500' colspan='2'>  ";
                        $article = "article".$language->get_language_id();
                        $oFCKeditor = new FCKeditor($article) ;
                        $oFCKeditor->Height = '512' ;
                        $oFCKeditor->BasePath = '../fckeditor/' ;
                        $oFCKeditor->Create() ;

                        echo "
                                    </td>
                                </tr>
                            </table>
                            <br/>
                            </center>
                            </dd>";
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

