<script id="html_select_city_template" type="text/x-jquery-tmpl">
    <select id="deal_city" name="deal_city">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_select_supplier_template" type="text/x-jquery-tmpl">
    <select id="deal_supplier" name="deal_supplier">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_select_deal_type_template" type="text/x-jquery-tmpl">
    <select id="deal_type_dropdown" name="deal_type_dropdown">
        {{tmpl(data, {selectedId:selected_value }) "#html_option_template"}}
    </select>
</script>

<script id="html_option_template" type="text/x-jquery-tmpl">
    <option {{if id == $item.selectedId}} selected="selected"{{/if}} value="${id}">${name}</option>
</script>
<h1 class="content_title">Update Deal</h1>
<div id="notification"></div>
<div id="content">
    <?
    use modules\deal_steal\includes\classes\Deal;
    $deal_id = secureRequestParameter($_REQUEST["deal_id"]);
    $deal = new Deal();
    $deal->loadById($deal_id);
    ?>
    <br/>

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Basic Detail</a></li>
            <li><a href="#tabs-2">Deal Description</a></li>
            <li><a href="#tabs-3">Fine Print</a></li>
            <li><a href="#tabs-4">Category</a></li>
            <li><a href="#tabs-5">Deal Tags</a></li>
            <li><a href="#tabs-6">Image</a></li>
        </ul>

        <div id="tabs-1">
            <form id="DealDetailUpdateForm" method='post'>
                <input type="hidden" value="<? echo $deal_id ?>" id="deal_id" name="deal_id"/>
                <table width="500" border="0" class="dialogTable">
                    <tr>
                        <td width="150" align="right"><b>Deal Title: </b></td>
                        <td><input name="deal_title" id="deal_title" style="width: 200px;"
                                   value="<?= $deal->getTitle() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Supplier: </b></td>
                        <td><div id="supplier_dropdown_div"></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>City: </b></td>
                        <td><div id="city_dropdown_div"></div></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Deal Type: </b></td>
                        <td><div id="deal_type_dropdown_div"></div></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Original Quantity: </b></td>
                        <td><input name="original_quantity" id="original_quantity" style="width: 100px;"
                                   value="<?= $deal->getOriginalQuantity() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Current Available Quantity: </b></td>
                        <td><input name="available_quantity" id="available_quantity" style="width: 100px;"
                                   value="<?= $deal->getQuantity() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Original Price: </b></td>
                        <td><input name="original_price" id="original_price" style="width: 100px;"
                                   value="<?= $deal->getOriginalPrice() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Offer Price: </b></td>
                        <td><input name="offer_price" id="offer_price" style="width: 100px;"
                                   value="<?= $deal->getOfferPrice() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Online Date: </b></td>
                        <td><input name="online_date" id="online_date" style="width: 120px;"
                                   value="<?= $deal->getOnlineDate() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Offline Date: </b></td>
                        <td><input name="offline_date" id="offline_date" style="width: 120px;"
                                   value="<?= $deal->getOfflineDate() ?>"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input name='"update_detail' id="update_detail_button" type='submit' value='Update'/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="tabs-2">
            <form id="DealDescUpdateForm" method='post'>
                <input type="hidden" value="<? echo $deal_id ?>" id="deal_id" name="deal_id"/>
                <textarea name='deal_desc' id='deal_desc' rows="4"
                          cols="60"><?=$deal->getDesc()?></textarea>
                <input name='"update_deal_desc_button' id="update_deal_desc_button" type='submit' value='Update'/>
            </form>
        </div>

        <div id="tabs-3">
            <form id="DealFinePrintUpdateForm" method='post'>
                <input type="hidden" value="<? echo $deal_id ?>" id="deal_id" name="deal_id"/>
                <textarea name='fine_print' id='fine_print' rows="8"
                          cols="60"><?=$deal->getFinePrint()?></textarea>
                <input name='"update_fine_print' id="update_fine_print_button" type='submit' value='Update'/>
            </form>
        </div>

        <div id="tabs-4">
            <form id="DealCategoryUpdateForm" method='post'>
                <?php
                use modules\deal_steal\includes\classes\CategoryManager;
                $category_manager = new CategoryManager();
                echo createTreeviewRadioList("deal_category_list", "treeview", "deal_category_id", $category_manager->getCategoryTreeviewDataSource(), $deal->getCategoryId());
                ?>
                <input name='update_deal_category_button' id="update_deal_category_button" type='submit'
                       value='Update Category'/>
            </form>
        </div>

        <div id="tabs-5">
            <form id="DealTagsUpdateForm" method='post'>
                <table width="400" border="0" class="dialogTable">
                    <tr>
                        <td width="200" align="left">
                            <?php
                            echo createMultipleDropdownList("tag_list", "tag_list", "multiple_selector", "width:180px;height:300px", $deal->getAvailableTagsDataSource());
                            ?>
                        </td>
                        <td width="200" align="left">
                            <?php
                            echo createMultipleDropdownList("deal_tag_list", "deal_tag_list", "multiple_selector", "width:180px;height:300px", $deal->getDealTagsDataSource());
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="left">
                            <a href="#" id="add_deal_tag">add &gt;&gt;</a>
                        </td>
                        <td width="150" align="left">
                            <a href="#" id="remove_deal_tag">&lt;&lt; remove</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="tabs-6">
            <form id="DealImagaeUpdateForm" action="<?= SERVER_URL ?>modules/deal_steal/control/deal_update.php"
                  method="post"
                  enctype='multipart/form-data'>
                <input type="hidden" value="<? echo $deal_id ?>" id="deal_id" name="deal_id"/>
                <input type="hidden" value="update_deal_image" id="operation" name="operation"/>
                <input type="hidden" value="<? echo $module_code ?>" name="module_code" id="module_code"/>
                <table class="general_table">
                    <tr>
                        <td width="150" align="right"></td>
                        <td>
                            <?=createImage($GLOBAL_DEPS[$_REQUEST['module_code']]["deal_image_folder"] . $deal->getImage(), "deal_image", 300, "", 0)?>
                            <input name="deal_image_uploaded" id="deal_image_uploaded" type="file"/>
                            <span id="file_size"></span>
                            <br/>
                            <span>(Support Type:jpg, jpeg, png, gif.  Maximum file size: 2Mb)</span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name='update_deal_image_button' id="update_deal_image_button" type='submit'
                                   value='update'
                                   title="update"/></td>
                    </tr>
                </table>
            </form>
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
    "tiny_mce",
    "jquery-tmpl",
    "jquery-ui-timepicker")
    , $JS_DEPS)?>, function () {

    $("#tabs").tabs();

    // **** tab 1 logic ****
    $("#update_detail_button").button();

    //date picker
    $('#online_date').datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "hh:mm:ss"
    });

    $("#offline_date").datetimepicker({
        dateFormat: "yy-mm-dd",
        timeFormat: "hh:mm:ss"
    });

    //form validation
    jQuery(function () {
        jQuery("input#deal_title").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter the deal title"
        });
        jQuery("#original_quantity").validate({
            expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
            message: "Please enter a valid integer"
        });

        jQuery("#available_quantity").validate({
            expression: "if (VAL.match(/^[0-9]*$/) && VAL) return true; else return false;",
            message: "Please enter a valid integer"
        });

        jQuery("#original_price").validate({
            expression: "if (VAL.match(/^\\d+(?:\\.\\d{1,2})?$/) && VAL) return true; else return false;",
            message: "Please enter a valid price"
        });

        jQuery("#offer_price").validate({
            expression: "if (VAL.match(/^\\d+(?:\\.\\d{1,2})?$/) && VAL) return true; else return false;",
            message: "Please enter a valid price"
        });

        jQuery("#online_date").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter a valid Date"
        });

        jQuery("#offline_date").validate({
            expression: "if (VAL) return true; else return false;",
            message: "Please enter a valid Date"
        });

        jQuery('form#DealDetailUpdateForm').validated(function () {
            var deal_id = $("#deal_id").val();
            var deal_title = $("#deal_title").val();
            var deal_supplier = $("#deal_supplier").val();
            var deal_city = $("#deal_city").val();
            var deal_type = $("#deal_type").val();
            var original_quantity = $("#original_quantity").val();
            var available_quantity = $("#available_quantity").val();
            var original_price = $("#original_price").val();
            var offer_price = $("#offer_price").val();
            var online_date = $("#online_date").val();
            var offline_date = $("#offline_date").val();
            var deal_desc = $("#deal_desc").val();
            $.ajax({
                url: SERVER_URL + "modules/deal_steal/control/deal_update.php",
                type: "POST",
                data: {
                    operation: "deal_detail_update",
                    deal_id: deal_id,
                    deal_title: deal_title,
                    deal_supplier: deal_supplier,
                    deal_city: deal_city,
                    deal_type: deal_type,
                    original_quantity: original_quantity,
                    available_quantity: available_quantity,
                    original_price: original_price,
                    offer_price: offer_price,
                    online_date: online_date,
                    offline_date: offline_date
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        jQuery("div#notification").html("<span class='info'>Deal detail has been updated successfully!</span>");
                    } else {
                        jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                    }
                },
                error: function (msg) {
                    ajaxFailMsg(msg);
                }
            });
            return false;
        });
    });

    //get the city dropdown
    $.ajax({
        url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
        type: "POST",
        data: {
            operation_id: "fetch_city_dropdown_list"
        },
        dataType: "json",
        success: function (data) {
            data.selected_value = <?=$deal->getCityId()?>;
            $("#html_select_city_template").tmpl(data).appendTo("#city_dropdown_div" );
        },
        error: function (msg) {
            ajaxFailMsg(msg);
        }
    });

    //get the supplier dropdown
    $.ajax({
        url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
        type: "POST",
        data: {
            operation_id: "fetch_supplier_dropdown_list",
            active: "Y"
        },
        dataType: "json",
        success: function (data) {
            data.selected_value = <?=$deal->getSupplierId()?>;
            $("#html_select_supplier_template").tmpl(data).appendTo("#supplier_dropdown_div" );
        },
        error: function (msg) {
            ajaxFailMsg(msg);
        }
    });

    //get the dael type dropdown
    $.ajax({
        url: SERVER_URL + "modules/deal_steal/control/fetch_service.php",
        type: "POST",
        data: {
            operation_id: "fetch_deal_type_dropdown_list"
        },
        dataType: "json",
        success: function (data) {
            data.selected_value = "<?=$deal->getType()?>";
            $("#html_select_deal_type_template").tmpl(data).appendTo("#deal_type_dropdown_div" );
        },
        error: function (msg) {
            ajaxFailMsg(msg);
        }
    });

    // **** tab 2 logic ****
    tinyMCE.init({
        // General options
        elements: "deal_desc",
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

    $("#update_deal_desc_button").button();

    $("#update_deal_desc_button").click(function () {
        var deal_id = $("#deal_id").val();
        var deal_desc = tinyMCE.get('deal_desc').getContent()
        $.ajax({
            url: SERVER_URL + "modules/deal_steal/control/deal_update.php",
            type: "POST",
            data: {
                operation: "deal_desc_update",
                deal_id: deal_id,
                deal_desc: deal_desc
            },
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    jQuery("div#notification").html("<span class='info'>Deal description has been updated successfully!</span>");
                } else {
                    jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                }
            },
            error: function (msg) {
                ajaxFailMsg(msg);
            }
        });
        return false;
    });


    // **** tab 3 logic ****
    tinyMCE.init({
        // General options
        elements: "fine_print",
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

    $("#update_fine_print_button").button();

    $("#update_fine_print_button").click(function () {
        var deal_id = $("#deal_id").val();
        var fine_print = tinyMCE.get('fine_print').getContent()
        $.ajax({
            url: SERVER_URL + "modules/deal_steal/control/deal_update.php",
            type: "POST",
            data: {
                operation: "fine_print_update",
                deal_id: deal_id,
                fine_print: fine_print
            },
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    jQuery("div#notification").html("<span class='info'>Deal fine print has been updated successfully!</span>");
                } else {
                    jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                }
            },
            error: function (msg) {
                ajaxFailMsg(msg);
            }
        });
        return false;
    });


    // **** tab 4 logic ****
    $("#update_deal_category_button").button();
    $("#update_deal_category_button").click(function () {
        var category_id = $('input[name="deal_category_id"]:checked', '#DealCategoryUpdateForm').val();
        var deal_id = $("#deal_id").val();
        $.ajax({
            url: SERVER_URL + "modules/deal_steal/control/deal_update.php",
            type: "POST",
            data: {
                operation: "deal_category_update",
                category_id: category_id,
                deal_id: deal_id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    jQuery("div#notification").html("<span class='info'>Deal category has been updated successfully!</span>");
                } else {
                    jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                }
            },
            error: function (msg) {
                ajaxFailMsg(msg);
            }
        });
        return false;
    });


    // **** tab 5 logic ****
    var updateDealTagsCallBack = function () {
        var deal_id = $("#deal_id").val();
        var deal_tag_id_list = [];
        $('#deal_tag_list option:selected').each(function (i, selected) {
            deal_tag_id_list[i] = $(selected).val();
        });
        $.ajax({
            url: SERVER_URL + "modules/deal_steal/control/deal_update.php",
            type: "POST",
            data: {
                operation: "deal_tag_update",
                deal_tag_id_list: deal_tag_id_list,
                deal_id: deal_id
            },
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    jQuery("div#notification").html("<span class='info'>Deal tags has been updated successfully!</span>");
                } else {
                    jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                }
            },
            error: function (msg) {
                ajaxFailMsg(msg);
            }
        });
    };

    $().ready(function () {
        $("#add_deal_tag").button();
        $("#remove_deal_tag").button();
        $('#add_deal_tag').click(function () {
            $('#tag_list option:selected').remove().appendTo('#deal_tag_list');
            $('#deal_tag_list option').each(function (i) {
                $(this).attr("selected", "selected");
            });

            updateDealTagsCallBack();
            return false;
        });
        $('#remove_deal_tag').click(function () {
            $('#deal_tag_list option:selected').remove().appendTo('#tag_list');
            $('#deal_tag_list option').each(function (i) {
                $(this).attr("selected", "selected");
            });
            updateDealTagsCallBack();
            return false;
        });
    });

    $('DealTagsUpdateForm').submit(function () {
        $('#deal_tag_list option').each(function (i) {
            $(this).attr("selected", "selected");
        });

        console.log("fire!");
    });


    // **** tab 6 logic ****
    $("#update_deal_image_button").button();
    var max_size = 2097152;
    var support_type = ["jpg", "png", "jpeg", "gif"];
    $('#deal_image_uploaded').bind('change', function () {
        var iSize = (Math.round((this.files[0].size / 1024 / 1024) * 100) / 100)
        jQuery("#file_size").html(iSize + "Mb");
        var ext = $('#deal_image_uploaded').val().split('.').pop().toLowerCase();

        if (this.files[0].size > max_size) {
            alert("File size should not exceed 2mb!");
            this.files = [];
            jQuery("#file_size").html("");
            jQuery("input#deal_image_uploaded").val("");
        }

        if ($.inArray(ext, support_type) == -1) {
            alert("Un-supported file type!");
            this.files = [];
            jQuery("#file_size").html("");
            jQuery("input#deal_image_uploaded").val("");
        }
    });
});


</script>