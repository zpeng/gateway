<h1 class="content_title">Update Supplier</h1>
<? include_once('view/notification_bar.php') ?>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Supplier;
    $supplier_id = secureRequestParameter($_REQUEST["supplier_id"]);
    $supplier = new Supplier();
    $supplier->loadByID($supplier_id);
    ?>
    <br/>

    <form id="SupplierUpdateForm" action="<?= SERVER_URL ?>modules/deal_steal/control/supplier_update.php"
          method="post"
          enctype='multipart/form-data'>
        <input type="hidden" value="<? echo $module_code ?>" name="module_code" id="module_code"/>
        <table class="inputTable">
            <tr>
                <td width="150" align="right"><b>Supplier ID: </b></td>
                <td><input type="text" value="<? echo $supplier->getSupplierId() ?>" name="supplier_id" id="supplier_id"
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

        });
    </script>
</div>
