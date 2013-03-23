<script type="text/javascript" >
    $(function(){
        // Dialog
        $('#dialog').dialog({
            autoOpen: false,
            modal: true,
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

    function InsertEmailTag(tag)
    {
        //var Source = document.getElementById("<%=MergeFields.ClientID %>");
        // Get the editor instance that we want to interact with.
        var oEditor = FCKeditorAPI.GetInstance('email_template') ;

        // Check the active editing mode.
        if ( oEditor.EditMode == FCK_EDITMODE_WYSIWYG )
        {
            // Insert the desired HTML.
            // oEditor.InsertHtml( '- This is some <a href="/Test1.html">sample<\/a> HTML -' ) ;
            if ((tag != null)) {
                oEditor.InsertHtml(tag);
                // to close the jquery dialog
                $('#dialog').dialog("close");
            }
        }
        else
        {
            alert( 'You must be on WYSIWYG mode!' ) ;
            // to close the jquery dialog
            $('#dialog').dialog("close");
        }

    }
</script>
<?
require_once("../included/class_loader.php") ;
require_once("../included/html_functions.php") ;
include_once("../fckeditor/fckeditor.php") ;

$email_template_id = secureRequestParameter($_REQUEST["email_template_id"]);
$emailTemplate = new EmailTemplate();
$emailTemplate->loadByID($email_template_id);
?>
<form  action='process/admin_email_template_update_process.php' method='post'W>
    <fieldset class="title_fieldset">
        <div class="title_block">
            <span class="title">Email Template Edit</span>
        </div>
        <div class="button_block">
            <a href="process/admin_email_template_send_test_mail_process.php?email_template_id=<?=$email_template_id?>">
                <img src="images/mail_24.png" />
                <br/>
                <b>Send Test Email</b>
            </a>
        </div>
        <div class="button_block">
            <a>
                <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  />
            </a><br/>
            <b>Save</b>
        </div>
        <div class="button_block">
            <a href="index.php?view=admin_email_template_list">
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
        <table width='800' border='0' style='font:100%;' cellpadding='3' >
            <tr>
                <td width='150' align='right'><b>ID: </b></td>
                <td align='left'><input name='email_template_id' readonly="true" style='width: 300px;' value='<?=$emailTemplate->get_email_template_id()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Key: </b></td>
                <td align='left'><input name='email_template_key' readonly="true" style='width: 300px;' value='<?=$emailTemplate->get_email_template_key()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Description: </b></td>
                <td align='left'><input name='email_template_comment' readonly="true" style='width: 300px;' value='<?=$emailTemplate->get_email_template_comment()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Title: </b></td>
                <td align='left'><input name='email_template_title' style='width: 300px;' value='<?=$emailTemplate->get_email_template_title()?>' /></td>
            </tr>
            <tr>
                <td align='right'><b>Email Tags: </b></td>
                <td align='left'><a href="#" id="dialog_link">Load Email Tags</a></td>
            </tr>
            <tr>
                <td align='right' valign="top"><b>Template: </b></td>
                <td align='left' height='500' >
                    <?
                    $article = "email_template";
                    $oFCKeditor = new FCKeditor($article) ;
                    $oFCKeditor->Height = '512' ;
                    $oFCKeditor->BasePath = '../fckeditor/' ;
                    $oFCKeditor->Value = $emailTemplate->get_email_template();
                    $oFCKeditor->Create();
                    ?>
                </td>
            </tr>


        </table>
        <br/>
        <div id="dialog" title="Insert Email Tag">
            <br/>
            <?
            $emailTemplateManager = New EmailTemplateManager();
            $emailTagList = $emailTemplateManager->loadEmailTagsByEmailTemplateID($email_template_id);
            if($emailTagList != null && sizeof($emailTagList)>0) {
                foreach ($emailTagList as $emailTag) {
                    echo "<a href=\"#\" onclick=\"InsertEmailTag('".$emailTag->get_email_tag()."');return false;\">".$emailTag->get_email_tag_name()."</a> (".$emailTag->get_email_tag_description().")<br/>";
                }
            }else {
                echo" <p>There is no email tag available for this template.</p>";
            }

            ?>
        </div>
        <br/>
    </fieldset>
</form>