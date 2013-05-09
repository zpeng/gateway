<h1 class="content_title">Update Deal</h1>
<div id="notification"></div>
<div id="content">
<?
$deal_id = secureRequestParameter($_REQUEST["deal_id"]);
$deal = new Deal();
$deal->loadById($deal_id);
?>
<br/>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Deal Detail</a></li>
        <li><a href="#tabs-2">Category</a></li>
        <li><a href="#tabs-3">Others</a></li>
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
                    <td><?php
                        echo createDropdownList("deal_supplier", "deal_supplier", "deal_supplier", "width: 150px;", "",
                            $deal->getSelectedSupplierListDataSource());
                        ?></td>
                </tr>
                <tr>
                    <td width="150" align="right"><b>City: </b></td>
                    <td><?php
                        echo createDropdownList("deal_city", "deal_city", "deal_city", "width: 150px;", "",
                            $deal->getSelectedCityListDataSource());
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="150" align="right"><b>Deal Type: </b></td>
                    <td><?php
                        echo createDropdownList("deal_type", "deal_type", "deal_type", "width: 80px;", "", $deal->getSelectedDealTypeListDataSource())
                        ?>
                    </td>
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
                    <td width="150" align="right"><b>Deal Description: </b></td>
                    <td><textarea name='deal_desc' id='deal_desc' rows="4"
                                  cols="60"><?=$deal->getDesc()?>
                        </textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input name='Update' id="update_detail_button" type='submit' value='Update'/>
                        <input name='Reset' id="reset_detail_button" type='reset' value='Reset'/>
                    </td>
                </tr>
            </table>
        </form>
        <script>
            $("#update_detail_button").button();
            $("#reset_detail_button").button();

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
                    url: SERVER_URL + "modules/deal_steal/admin/control/deal_update.php",
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
                        offline_date: offline_date,
                        deal_desc: deal_desc
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "success") {
                            jQuery("div#notification").html("<span class='info'>Deal has been updated successfully!</span>");
                        } else {
                            jQuery("div#notification").html("<span class='error'>Unable to update this deal. Try again please!</span>");
                        }
                    },
                    error: function () {
                        jQuery("div#notification").html("<span class='warning'>There was a connection error. Try again please!</span>");
                    }
                });
                return false;
            });

        </script>

    </div>


    <div id="tabs-2">

    </div>
    <div id="tabs-3">

    </div>
</div>

</div>

<script>
    $("#tabs").tabs();
</script>