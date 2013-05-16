<h1 class="content_title">Create a Article</h1>
<? include_once('view/notification_bar.php') ?>
<div id="main_content">
    <?
    $module_code = secureRequestParameter($_REQUEST["module_code"]);
    ?>
    <br/>

    <form id="ArticleCreationForm" action="<?= SERVER_URL ?>modules/cms/control/content_create.php" method="post">
        <input type="hidden" value="<? echo $module_code ?>" name="module_code" id="module_code"/>
        <input type="hidden" value="<? echo $_SESSION['user_id'] ?>" name="user_id" id="user_id"/>
        <table class="inputTable">
            <tr>
                <td width="100" align="right"><b>Article Title: </b></td>
                <td><input name="title" id="title" style="width: 670px;"/></td>
            </tr>
            <tr>
                <td align="right"></td>
                <td>
                    <textarea name='article_content' id='article_content' style="height: 400px"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input name='Create' id="update_btn" type='submit' value='Create' title="Create"/></td>
            </tr>
        </table>
    </form>
    <script>
        // load css
        head.js(<?=outputDependencies(
    array(
    "jquery-ui-css",
    "jquery-form-validate-css",
    "tiny_mce-css")
    , $CSS_DEPS)?>);

        // load js
        head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate",
    "tiny_mce")
    , $JS_DEPS)?>, function () {
            jQuery("#update_btn").button();

            jQuery(function () {
                jQuery("#title").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the article title"
                });
            });

            tinyMCE.init({
                // General options
                mode: "textareas",
                theme: "advanced",
                plugins: "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                // Theme options
                theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,

                // Skin options            skin: "o2k7",
                //skin_variant: "silver",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url: "js/template_list.js",
                external_link_list_url: "js/link_list.js",
                external_image_list_url: "js/image_list.js",
                media_external_list_url: "js/media_list.js"

            });
        });
    </script>
</div>
