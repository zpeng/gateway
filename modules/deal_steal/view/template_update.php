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
                <td><textarea name='template_content' id='template_content' rows="40"
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
    "jquery-form-validate-css")
    , $CSS_DEPS)?>);

        // load js
        head.js(<?=outputDependencies(
    array(
    "jquery-ui",
    "jquery-form-validate")
    , $JS_DEPS)?>, function () {
            $("#update_btn").button();

            jQuery('form#TemplateUpdateForm').submit(function () {
                var template_id = $("#template_id").val();
                var template_title = $("#template_title").val();
                var template_content = $("#template_content").val();

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
                    error: function () {
                        jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                    }
                });
                return false;
            });
        });
    </script>
</div>
