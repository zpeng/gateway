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

    $(document).ready(function(){
        $("#shipping_date").datepicker({ dateFormat: 'yy-mm-dd' });
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
        <span class="title"> Order Update</span>
    </div>
    <div class="button_block">
        <a href="index.php?view=admin_order_list">
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

    $order_id = secureRequestParameter($_REQUEST["order_id"]);
    $order = new Order();
    $order->loadByID($order_id);

    $orderStatus = new OrderStatus();
    $paymentStatus = new PaymentStatus();

    $customer = new Customer();
    $customer = $order->get_customer();
    ?>
    <br/>
    <div id="Tabs" style="width:100%; min-width:1000px;font-size:100%; margin: 0px; ">
        <ul>
            <li style='font-size:80%'><a href='#Tabs-1'>Order Detail</a></li>
            <li style='font-size:80%'><a href='#Tabs-2'>Product Detail</a></li>
            <li style='font-size:80%'><a href='#Tabs-3'>Shipping & Payment</a></li>
            <li style='font-size:80%'><a href='#Tabs-4'>Customer Detail</a></li>
        </ul>


        <div id='Tabs-1' style='float: left'>
            <table width="650" border="0" style="margin-left: 10px" cellpadding="3" cellspacing="0">
                <tr>
                    <td  height="30" align="right" valign="top" width="150">
                        <b>Order Code: </b>
                    </td>
                    <td align="left" valign="top" width="280" >
                        <?=$order->get_order_code()?>
                    </td>
                    <td align="left" valign="top"></td>
                </tr>
                <tr>
                    <td  height="30" align="right" valign="top" >
                        <b>Order Date: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=$order->get_order_create_date()?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td  height="30" align="right" valign="top">
                        <b>Shipping Date: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=$order->get_shipping_date()?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                <form id='OrderStatusUpdateForm'  action='process/admin_order_status_update_process.php'
                      method='post' onsubmit='return confirmOperation()' >
                    <input name='tab_id' id='tab_id' type='hidden' value='Tabs-1'/>
                    <input name='order_id' id='order_id' type='hidden' value='<?=$order_id?>'/>
                    <td  height="30" align="right" valign="top" >
                        <b>Order Status: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=outputOrderStatusAsDropdownList("order_status_id","250",$order->get_order_status_id())?>
                    </td>
                    <td align="left" valign="top"><input name='Update' type='image'  value='Update' title='Update Order Status' src='images/save_24.png' /></td>
                </form>
                </tr>
                <tr>
                <form id='PaymentStatusUpdateForm'  action='process/admin_payment_status_update_process.php' method='post'>
                    <input name='tab_id' id='tab_id' type='hidden' value='Tabs-1'/>
                    <input name='order_id' id='order_id' type='hidden' value='<?=$order_id?>'/>
                    <td  height="30" align="right" valign="top">
                        <b>Payment Status: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=outputPaymentStatusAsDropdownList("payment_status_id","250",$order->get_payment_status_id())?>
                    </td>
                    <td align="left" valign="top"><input name='Update' type='image'  value='Update' title='Update Payment Status' src='images/save_24.png' /></td>
                </form>
                </tr>
                <tr>
                <form id='AdminCommentUpdateForm'  action='process/admin_order_admin_comment_update_process.php' method='post'>
                    <input name='tab_id' id='tab_id' type='hidden' value='Tabs-1'/>
                    <input name='order_id' id='order_id' type='hidden' value='<?=$order_id?>'/>
                    <td  height="30" align="right" valign="top" >
                        <b>Admin Comment: </b>
                    </td>
                    <td align="left" valign="top" >
                        <textarea cols="35" rows="6" style="width: 250px" name="admin_comment" id="admin_comment"><?=$order->get_administrator_comment()?></textarea>
                    </td>
                    <td align="left" valign="top"><input name='Update' type='image'  value='Update' title='Update Comment' src='images/save_24.png' /></td>
                </form>
                </tr>
            </table>
        </div>

        <div id='Tabs-2' style='float: left'>
            <?
            echo "<table width='680' border='0'  cellpadding='5' cellspacing='0' class='horizontal_border'>";
            echo "<tr bgcolor='#FEFEFE'>
                <td width='80'  align='center'>&nbsp;</td>
                <td width='250' align='center'><span class='label_title'><b>Name</b></span></td>
                <td width='150' align='center'><span class='label_title'><b>Price</b></span></td>
                <td width='50'  align='center'><span class='label_title'><b>Quantity</b></span></td>
                <td width='150' align='center'><span class='label_title'><b>Cost</b></span></td>
            </tr>";

            if(sizeof($order->get_order_product_list())>0) {
                foreach($order->get_order_product_list() as $orderProduct) {
                    $product = new Product();
                    $product = $orderProduct->get_product();
                    $productImage = new ProductImage();
                    $productImageManager = new ProductImageManager();
                    $productImageManager->set_product_id($product->get_product_id());
                    $productImage = $productImageManager->get_default_product_image();
                    $productImage->set_product_image_path($s_configManager->getValueByKey("domain_name")."/".$s_configManager->getValueByKey("product_image_path"));
                    echo "<tr>";
                    echo "<td width='80' ><span class='label_title'>".$productImage->outputProductImage(80, 80, "", "")."</span></td>";
                    echo "<td width='250' align='center'><span class='label_title'>".$product->getProductDescriptionByLanguageID(1)->get_product_name()."	</span></td>
                          <td width='150' align='center'><span class='label_title'>".$orderProduct->get_selling_price()."</span></td>
                          <td width='50' align='center'><span class='label_title'>".$orderProduct->get_order_quantity()."</span></td>
                          <td width='150' align='center'><span class='label_title'>".outputPriceWithCurrency($s_configManager, $orderProduct->getOrderProductTotalCost())."&nbsp;&nbsp;"."</span></td>";
                    echo "</tr></form>";

                }
            }
            echo "<tr>
                <td align='center'>&nbsp;</td>
                <td align='center'>&nbsp;</td>
                <td align='center' colspan='2'><span class='label_title'>Cost exlcude shipping:</span></td>
                <td align='center'><b>".outputPriceWithCurrency($s_configManager,$order->get_order_total_amount_exclude_shipping())."&nbsp;&nbsp;"."</b></td>
            </tr>";
            echo "<tr>
                <td align='center' >&nbsp;</td>
                <td align='center' >&nbsp;</td>
                <td align='center'  colspan='2'><span class='label_title'>Shipping Cost:</span></td>
                <td align='center' ><b>".outputPriceWithCurrency($s_configManager,$order->get_shipping_cost())."&nbsp;&nbsp;"."</b></td>
            </tr>";
            echo "<tr>
                <td align='center' >&nbsp;</td>
                <td align='center' >&nbsp;</td>
                <td align='center' colspan='2'><span class='label_title'><b>Total Cost:</b></span></td>
                <td align='center' ><span class='total_cost'><b>".outputPriceWithCurrency($s_configManager,$order->get_order_total_amount())."&nbsp;&nbsp;"."</b></span></td>
            </tr>";

            echo "</table>";
            ?>
        </div>


        <div id='Tabs-3' style='float: left'>
            <table width="680" border="0" style="margin-left: 10px" cellpadding="3" cellspacing="3">
                <tr>
                    <td  height="30" align="right" valign="top" width="200">
                        <b>Shipping Method: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=$order->get_shipping_method()->get_shipping_type()?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="top">
                        <b>Shipping Address:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$order->get_shipping_address()?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middle" >
                        <b>Payment Method:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$order->get_payment_method()->get_payment_method_logo_as_image("110", "40",  $s_configManager->getValueByKey("domain_name"))?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="top" >
                        <b>Client Comments:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$order->get_customer_comment()?>
                    </td>
                </tr>
            </table>
        </div>


        <div id='Tabs-4' style='float: left'>
            <table width="680" border="0" style="margin-left: 10px" cellpadding="3" cellspacing="3">
                <tr>
                    <td  align="right" valign="top" width="200">
                        <b>Customer Name: </b>
                    </td>
                    <td align="left" valign="top" >
                        <?=$customer->get_full_name()?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="top">
                        <b>Customer Email:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$customer->get_email()?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="middle" >
                        <b>Customer Mobile:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$customer->get_mobile()?>
                    </td>
                </tr>
                <tr>
                    <td align="right" valign="top" >
                        <b>Customer Telephone:</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$customer->get_telephone()?>
                    </td>
                </tr>
            </table>
        </div>
    </div>



    <br/>
</fieldset>