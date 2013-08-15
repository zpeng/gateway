<script id="html_select_template" type="text/x-jquery-tmpl">
    <select id="supplier_status_dropdown" name="supplier_status_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if value === $item.selectedId}} selected="selected"{{/if}} value="${value}">${label}</option>
</script>

<h1 class="content_title">Supplier Information</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Supplier;
    $supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
    $supplier = new Supplier();
    $supplier->loadByID($supplier_id);
    ?>
    <br/>

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Basic Info</a></li>
            <li><a href="#tabs-2">Change Status</a></li>
            <li><a href="#tabs-3">Deals</a></li>
            <li><a href="#tabs-4">Concierge Detail</a></li>
        </ul>

        <div id="tabs-1">
            <form id="SupplierUpdateForm" action="<?= SERVER_URL ?>modules/deal_steal/control/supplier_update.php"
                  method="post"
                  enctype='multipart/form-data'>
                <input type="hidden" value="<? echo $module_code ?>" name="module_code" id="module_code"/>
                <table class="general_table">
                    <tr>
                        <td width="150" align="right"><b>Supplier ID: </b></td>
                        <td><input type="text" value="<? echo $supplier->getSupplierId() ?>" name="supplier_id"
                                   id="supplier_id"
                                   readonly="true"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Name: </b></td>
                        <td><input type="text" value="<? echo $supplier->getSupplierName() ?>" name="supplier_name"
                                   id="supplier_name" style="width: 400px"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Logo: </b></td>
                        <td>
                            <?=$supplier->outputLogoAsImage($GLOBAL_DEPS[$_REQUEST['module_code']]["supplier_logo_folder"], "supplier_logo", 50, 50, 0)?>
                            <input name="logo_image_uploaded" id="logo_image_uploaded" type="file"/>
                            <span id="file_size"></span>
                            <br/>
                            <span>(Support Type:jpg, jpeg, png, gif.  Maximum file size: 2Mb)</span>
                            <br/>
                            <span>(It is better to keep image width/height ratio at 1 : 0.64)</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>URL: </b></td>
                        <td><input type="text" value="<? echo $supplier->getSupplierUrl() ?>" name="supplier_url"
                                   id="supplier_url" style="width: 400px"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Email: </b></td>
                        <td><input type="text" value="<? echo $supplier->getSupplierEmail() ?>" name="supplier_email"
                                   id="supplier_email" style="width: 400px"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Tel: </b></td>
                        <td><input type="text" value="<? echo $supplier->getSupplierTel() ?>" name="supplier_tel"
                                   id="supplier_tel" style="width: 400px"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Address: </b></td>
                        <td><textarea name='supplier_address' id='supplier_address' rows="4"
                                      cols="50"><?=$supplier->getSupplierAddress()?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Business Description: </b></td>
                        <td><textarea name='supplier_desc' id='supplier_desc' rows="4"
                                      cols="50"><?=$supplier->getSupplierDesc()?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name='update' id="update_btn" type='submit' value='update' title="update"/></td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="tabs-2">
            <table class="general_table">
                <tr>
                    <td width="150" align="right"><b>Change status to: </b></td>
                    <td>
                        <div id="supplier_status_div"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="tabs-3">
        </div>

        <div id="tabs-4">
        </div>

    </div>
</div>
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
    "jquery-tmpl",
    "tiny_mce")
    , $JS_DEPS)?>, function () {
        $("#tabs").tabs();

        tinyMCE.init({
            // General options
            elements: "supplier_desc",
            mode: "exact",
            theme: "advanced",
            plugins: "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3: "",
            theme_advanced_buttons4: "",
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

        $("#update_btn").button();

        var isFormValid = true;
        var max_size = 2097152;
        var support_type = ["jpg", "png", "jpeg", "gif"];
        $('#logo_image_uploaded').bind('change', function () {
            var iSize = (Math.round((this.files[0].size / 1024 / 1024) * 100) / 100)
            jQuery("#file_size").html(iSize + "Mb");
            var ext = $('#logo_image_uploaded').val().split('.').pop().toLowerCase();

            if (this.files[0].size > max_size) {
                alert("File size should not exceed 2mb!");
                this.files = [];
                jQuery("#file_size").html("");
                jQuery("input#logo_image_uploaded").val("");
            }

            if ($.inArray(ext, support_type) == -1) {
                alert("Un-supported file type!");
                this.files = [];
                jQuery("#file_size").html("");
                jQuery("input#logo_image_uploaded").val("");
            }
        });


        //supplier status dorpdowm
        var model = {
            data: [
                { value: "Y", label: "Active Supplier" },
                { value: "N", label: "Inactive Supplier" }
            ],
            selected_value: "<?=$supplier->getActive()?>"
        };
        $("#html_select_template").tmpl(model).appendTo("#supplier_status_div" );


        $("#supplier_status_dropdown").change(function(e) {
            var supplier_id = $("#supplier_id").val();
            var active = $("#supplier_status_dropdown option:selected").val();

            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/supplier_status_update.php",
                type: "POST",
                data: {
                    supplier_id: supplier_id,
                    active: active
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        jQuery("div#notification").html("<span class='info'>Supplier status has been updated successfully!</span>");
                    } else {
                        jQuery("div#notification").html("<span class='error'>Unable to update this client status. Try again please!</span>");
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

