<h1 class="content_title">Edit Article</h1>
<div id="notification"></div>
<div id="main_content">
    <?
    $content_id = $_REQUEST["content_id"];

    use modules\cms\includes\classes\Content;
    $content = new Content();
    $content->loadByID($content_id);
    ?>
    <br/>

    <form id="ArticleCreationForm" method="post">
        <input type="hidden" value="<?= $_SESSION['user_id'] ?>" name="user_id" id="user_id"/>
        <input type="hidden" value="<?= $content_id ?>" name="content_id" id="content_id"/>
        <table class="general_table">
            <tr>
                <td width="100" align="right"><b>Article Title: </b></td>
                <td><input name="title" id="title" style="width: 670px;" value="<?= $content->get_title() ?>"/></td>
            </tr>
            <tr>
                <td align="right"></td>
                <td>
                    <textarea name='article_content' id='article_content'
                              style="height: 400px"><?=$content->get_article()?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input name='Update' id="update_btn" type='submit' value='Update' title="Update"/></td>
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
                //skin_variant: "default",

                // Drop lists for link/image/media/template dialogs
                template_external_list_url: "js/template_list.js",
                external_link_list_url: "js/link_list.js",
                external_image_list_url: "js/image_list.js",
                media_external_list_url: "js/media_list.js"
            });

            jQuery(function () {
                jQuery("#title").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the article title"
                });

                jQuery('form#ArticleCreationForm').validated(function () {
                    var user_id = $("#user_id").val();
                    var content_id = $("#content_id").val();
                    var title = $("#title").val();
                    var article_content = tinyMCE.get('article_content').getContent()
                    $.ajax({
                        url: SERVER_URL + "modules/cms/control/content_update.php",
                        type: "POST",
                        data: {user_id: user_id,
                            content_id: content_id,
                            title: title,
                            article_content: article_content
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.status == "success") {
                                jQuery("div#notification").html("<span class='info'>The content has been updated successfully!</span>");
                            } else {
                                jQuery("div#notification").html("<span class='error'>Unable to update the content. Try again please!</span>");
                            }
                        },
                        error: function () {
                            jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                        }
                    });
                    return false;
                });
            });

        });


    </script>
</div>
