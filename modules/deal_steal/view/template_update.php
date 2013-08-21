<h1 class="content_title">Update Template</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Template;
    $template_id = secureRequestParameter($_REQUEST["template_id"]);
    $template = new Template();
    $template->loadByID($template_id);
    ?>
    <br/>

    <form id="TemplateUpdateForm" method="post">
        <input type="hidden" value="<? echo $module_code ?>" name="module_code" id="module_code"/>
        <input type="hidden" value="<? echo $template_id ?>" name="template_id" id="template_id"/>
        <table class="general_table">
            <tr>
                <td width="150" align="right"><b>Template Key: </b></td>
                <td><input type="text" value="<? echo $template->getKey() ?>" name="template_key" id="template_key"
                           readonly="true" style="width: 400px"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right"><b>Title: </b></td>
                <td><input type="text" value="<? echo $template->getTitle() ?>" name="template_title"
                           id="template_title" style="width: 400px"/>
                </td>
            </tr>
            <tr>
                <td width="150" align="right" style="vertical-align: top"><b>Content: </b></td>
                <td><textarea name='template_content' id='template_content' rows="30"
                              cols="90"><?=$template->getContent()?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
            </tr>
        </table>
    </form>
    <br/>
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
            $("#update_btn").button();

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

            jQuery('form#TemplateUpdateForm').submit(function () {
                var template_id = $("#template_id").val();
                var template_title = $("#template_title").val();
                var template_content = tinyMCE.get('template_content').getContent()

                $.ajax({
                    url: SERVER_URL + "modules/deal_steal/control/template_update.php",
                    type: "POST",
                    data: {
                        template_id: template_id,
                        template_title: template_title,
                        template_content: template_content
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Template content has been updated successfully!</span>");
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update this template. Try again please!</span>");
                        }
                    },
                    error: function (msg) {
                        ajaxFailMsg(msg);
                    }
                });
                return false;
            });
        });
    </script>
</div>
