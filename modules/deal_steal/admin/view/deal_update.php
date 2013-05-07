<h1 class="content_title">Update Deal</h1>
<? include_once('view/notification_bar.php') ?>
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
            <form id="createDealForm" action="<?= SERVER_URL ?>modules/deal_steal/admin/control/deal_create.php"
                  method='post'>
                <input type="hidden" value="<? echo $module_code ?>" name="module_code"/>
                <table width="500" border="0" class="dialogTable">
                    <tr>
                        <td width="150" align="right"><b>Deal Title: </b></td>
                        <td><input name="deal_title" id="deal_title" style="width: 200px;"
                                   value="<?= $deal->getTitle() ?>"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Supplier: </b></td>
                        <td><?php
                            $supplier_manager = new SupplierManager();
                            echo createDropdownList("deal_supplier", "deal_supplier", "deal_supplier", "width: 150px;", "",
                                $supplier_manager->getSupplierListDataSource());
                            ?></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>City: </b></td>
                        <td><?php
                            $city_manager = new CityManager();
                            echo createDropdownList("deal_city", "deal_city", "deal_city", "width: 150px;", "",
                                $city_manager->getCityListDataSource());
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Deal Type: </b></td>
                        <td><?php
                            $deal_type_ds = array(
                                "data" => array(
                                    "Single" => "S",
                                    "Multiple" => "M"
                                ),
                            );
                            echo createDropdownList("deal_type", "deal_type", "deal_type", "width: 80px;", "", $deal_type_ds)
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><b>Original Quantity: </b></td>
                        <td><input name="available_quantity" id="available_quantity" style="width: 100px;"
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
                        <td><textarea name='supplier_desc' id='supplier_desc' rows="4"
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
        </div>
        <div id="tabs-2">

        </div>
        <div id="tabs-3">

        </div>
    </div>

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

        $("#tabs").tabs();


    </script>
</div>
