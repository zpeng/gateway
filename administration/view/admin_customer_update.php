<script type="text/javascript" >
    function getQuerystring(key, default_)
    {
        if (default_==null) default_="";
        key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
        var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
        var qs = regex.exec(window.location.href);
        if(qs == null)
            return default_;
        else
            return qs[1];
    }

    var tab_id = getQuerystring('tab_id','tabs-1');

    $(function(){
        // Tabs
        $("#Tabs").tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
        $("#Tabs").tabs('select', '#'+tab_id);
        $("#Tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
    });

</script>

<style type="text/css">
    /* Vertical Tabs
    ----------------------------------*/
    .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
    .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0;  }
    .ui-tabs-vertical .ui-tabs-nav li a { display:block;  }
    .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
    .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em; }
</style>


<fieldset class="title_fieldset">
    <div class="title_block">
        <span class="title"> Customer Information</span>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_customer_list">
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
    <?
    require_once("../included/class_loader.php") ;
    require_once('../included/html_functions.php');

    $customer_id = secureRequestParameter($_REQUEST["customer_id"]);
    $customer = new Customer();
    $customer->loadById($customer_id);

    ?>
    <div id="Tabs" style="width:100%; min-width:1000px;font-size:100%; margin: 0px; ">
        <ul>
            <li style="font-size:80%"><a href="#Tabs-1">Customer Detail</a></li>
            <li style="font-size:80%"><a href="#Tabs-2">Billing Address</a></li>
            <li style="font-size:80%"><a href="#Tabs-3">Delivery Address</a></li>
            <li style="font-size:80%"><a href="#Tabs-4">Customer Review</a></li>
        </ul>

        <!--  Customer Detail -->
        <div id="Tabs-1" style="float: left">
            <form id="customerDetailUpdateForm"  action='process/admin_customer_detail_update_process.php' method='post'
                  onsubmit='return checkAdminCustomerDetailUpdateForm(this)'>
                <table width="700" border="0"  >
                    <tr>
                        <td align="right" width="30%"></td>
                        <td align="left">
                            <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td>
                    </tr>
                    <tr>
                        <td  align="right"</td>
                        <td align="left"></td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><b>Customer ID: </b></td>
                        <td><input name="customer_id" id="customer_id" style="width: 100px;"
                                   readonly="true" value="<?=$customer_id?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%" align="right"><b>Email: </b></td>
                        <td><input name="email" id="email" style="width: 200px;"
                                   readonly="true" value="<?=$customer->get_email()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Firstname: </b></td>
                        <td>
                            <input name="firstname" id="firstname" style="width: 200px;"  value="<?=$customer->get_firstname()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Lastname: </b></td>
                        <td>
                            <input name="lastname" id="lastname" style="width: 200px;"  value="<?=$customer->get_lastname()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Telephone: </b></td>
                        <td>
                            <input name="telephone" id="telephone" style="width: 200px;"  value="<?=$customer->get_telephone()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Mobile: </b></td>
                        <td><input name="mobile" id="mobile" style="width: 200px;"    value="<?=$customer->get_mobile()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Newsletter Subscribe: </b></td>
                        <td>
                            <?
                            echo outputBooleanValueAsDropdownList("newsletter", 50, $customer->get_newsletter());
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Register Date: </b></td>
                        <td>
                            <input name="register_date" id="register_date" style="width: 200px;"  value="<?=$customer->get_register_date()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Last Visit at: </b></td>
                        <td>
                            <input name="last_visit" id="last_visit" style="width: 200px;"  value="<?=$customer->get_last_visit_time()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Last Edit at: </b></td>
                        <td>
                            <input name="last_edit" id="last_edit" style="width: 200px;"  value="<?=$customer->get_last_edit_time()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>


                </table>
            </form>
        </div>

        <!--  Billing Address -->
        <div id="Tabs-2" style="float: left">
            <?

            $billing_address = new Address();
            $billing_address = $customer->load_billing_address();
            ?>
            <form id="customerBillingAddressUpdateForm"  action='process/admin_customer_address_update_process.php' method='post'
                  onsubmit='return checkAdminCustomerBillingAddressUpdateForm(this)'>
                <input name="tab_id" id="tab_id" type="hidden" value='Tabs-2' />
                <input name="customer_id" id="customer_id" type="hidden" value="<?=$customer_id?>" />
                <table width="700" border="0"  >
                    <tr>
                        <td align="right" width="30%"></td>
                        <td align="left">
                            <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td>
                    </tr>
                    <tr>
                        <td  align="right"><b>Address Type: </b></td>
                        <td align="left">
                            <input name="address_type" id="address_type"  readonly="true" value="billing" style="width: 200px;" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Recipients: </b></td>
                        <td>
                            <input name="b_recipients" id="b_recipients" style="width: 200px;"  value="<?=$billing_address->get_recipients()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Street: </b></td>
                        <td>
                            <input name="b_street" id="b_street" style="width: 200px;"  value="<?=$billing_address->get_street()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>City: </b></td>
                        <td>
                            <input name="b_city" id="b_city" style="width: 200px;"  value="<?=$billing_address->get_city()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Postcode: </b></td>
                        <td><input name="b_postcode" id="b_postcode" style="width: 200px;"    value="<?=$billing_address->get_postcode()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>State/Province: </b></td>
                        <td>
                            <input name="b_state" id="b_state" style="width: 200px;"    value="<?=$billing_address->get_state()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Country: </b></td>
                        <td>
                            <input name="b_country" id="b_country" style="width: 200px;"  value="<?=$billing_address->get_country()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>

        <!--  Delivery Address -->
        <div id="Tabs-3" style="float: left">
            <?
            $delivery_address = new Address();
            $delivery_address = $customer->load_delivery_address();
            ?>
            <form id="customerBillingAddressUpdateForm"  action='process/admin_customer_address_update_process.php' method='post'
                  onsubmit='return checkAdminCustomerDeliveryAddressUpdateForm(this)'>
                <input name="tab_id" id="tab_id" type="hidden" value='Tabs-3' />
                <input name="customer_id" id="customer_id" type="hidden" value="<?=$customer_id?>" />
                <table width="700" border="0"  >
                    <tr>
                        <td align="right" width="30%"></td>
                        <td align="left">
                            <input name="Save" type="image"  value="Save" title="Save" src="images/save_24.png"  /></td>
                    </tr>
                    <tr>
                        <td  align="right"><b>Address Type: </b></td>
                        <td align="left">
                            <input name="address_type" id="address_type"  readonly="true" value="delivery" style="width: 200px;" />

                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Recipients: </b></td>
                        <td>
                            <input name="d_recipients" id="d_recipients" style="width: 200px;"  value="<?=$delivery_address->get_recipients()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Street: </b></td>
                        <td>
                            <input name="d_street" id="d_street" style="width: 200px;"  value="<?=$delivery_address->get_street()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>City: </b></td>
                        <td>
                            <input name="d_city" id="d_city" style="width: 200px;"  value="<?=$delivery_address->get_city()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Postcode: </b></td>
                        <td><input name="d_postcode" id="d_postcode" style="width: 200px;"    value="<?=$delivery_address->get_postcode()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>State/Province: </b></td>
                        <td>
                            <input name="d_state" id="d_state" style="width: 200px;"    value="<?=$delivery_address->get_state()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Country: </b></td>
                        <td>
                            <input name="d_country" id="d_country" style="width: 200px;"  value="<?=$delivery_address->get_country()?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>


        <!--  Customer Review -->
        <div id="Tabs-4" style="float: left">
            <table width="700" border="0">
                <tr>
                    <td align="left">
                        <?
                        $review_list = $customer->loadCustomerReviews();

                        ?>

                        <div id="tablewrapper" style="width: 700px;">
                            <div id="tableheader" style="width: 700px;">
                                <div class="search">
                                    <select id="columns" onchange="sorter.search('query')"></select>
                                    <input type="text" id="query" onkeyup="sorter.search('query')" />
                                </div>
                                <span class="details">
                                    <div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
                                    <div><a href="javascript:sorter.reset()">reset</a></div>
                                </span>
                            </div>
                            <table cellpadding="0" cellspacing="0" border="0" id="table"  class="tinytable" style="width: 700px;">
                                <thead >
                                    <tr>
                                        <th><h3>Product Name</h3></th>
                                        <th><h3>Rate</h3></th>
                                        <th><h3>Reviews</h3></th>
                                        <th><h3>Date</h3></th>
                                        <th><h3>Operations</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    if (sizeof($review_list) > 0 ) {
                                        foreach($review_list as $review) {
                                            $product = new Product();
                                            $product->load($review->get_product_id());
                                            echo "  <tr>
                                                <td>".$product->getProductDescriptionByLanguageID(1)->get_product_name()."</td>
                                                <td>".$review->get_review_rate()."</td>
                                                <td>".$review->get_review_text()."</td>
                                                <td>".$review->get_review_date()."</td>
                                                <td>
 <a href='admin_customer_review_delete_process.php?review_id=".$review->get_review_id()."&customer_id=".$review->get_customer_id()."'
                                onclick='return confirmDeletion()'>".displayDeleteIcon(15,15,'Delete this customer review')."</a>
                                                </td>
                                                </tr> ";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="tablefooter" style="width: 700px;">
                                <div id="tablenav">
                                    <div>
                                        <img src="images/sorttable/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                                        <img src="images/sorttable/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                                        <img src="images/sorttable/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                                        <img src="images/sorttable/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                                    </div>
                                    <div>
                                        <select id="pagedropdown"></select>
                                    </div>
                                    <div>
                                        <a href="javascript:sorter.showall()">view all</a>
                                    </div>
                                </div>
                                <div id="tablelocation">
                                    <div>
                                        <select onchange="sorter.size(this.value)">
                                            <option value="5"  selected="selected">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span>Entries Per Page</span>
                                    </div>
                                    <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
                                </div>
                            </div>

                            <script type="text/javascript" src="js/sortedTable.js"></script>
                            <script type="text/javascript">
                                var sorter = new TINY.table.sorter('sorter','table',{
                                    headclass:'head',
                                    ascclass:'asc',
                                    descclass:'desc',
                                    evenclass:'evenrow',
                                    oddclass:'oddrow',
                                    evenselclass:'evenselected',
                                    oddselclass:'oddselected',
                                    paginate:true,
                                    size:10,
                                    colddid:'columns',
                                    currentid:'currentpage',
                                    totalid:'totalpages',
                                    startingrecid:'startrecord',
                                    endingrecid:'endrecord',
                                    totalrecid:'totalrecords',
                                    hoverid:'selectedrow',
                                    pageddid:'pagedropdown',
                                    navid:'tablenav',
                                    sortcolumn:1,
                                    sortdir:1,
                                    columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
                                    init:true
                                });
                            </script>

                        </div>

                    </td>
                </tr>
            </table>

        </div>

    </div>
</fieldset>

