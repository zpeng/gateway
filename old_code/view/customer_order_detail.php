<div class="content">
    <h5>Order Detail</h5>
    <div style="padding: 10px 10px 10px 10px ;">
        <?
        include_once 'view/msg_view.php';
        ?>
        <?
        $order_code = secureRequestParameter($_REQUEST["order_code"]);
        $order = new Order();
        $order->loadByCode($order_code);
        $orderStatus = new OrderStatus();
        $paymentStatus = new PaymentStatus();

        echo "<table width='680' border='0'  cellpadding='5' cellspacing='0' class='shoppingcart'>";
        echo "<tr bgcolor='#FEFEFE'>
                  <td width='80' align='center'>&nbsp;</td>
                  <td width='250' align='center'><span class='label_title'><b>Name</b></span></td>
                  <td width='150' align='center'><span class='label_title'><b>Price</b></span></td>
                  <td width='50' align='center'><span class='label_title'><b>Quantity</b></span></td>
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
                $productImage->set_product_image_path($s_configManager->getValueByKey("product_image_path"));
                echo "<tr>";
                echo "<td width='80' ><span class='label_title'>".$productImage->outputProductImage("", "", "", "shoppingcart_product_image")."</span></td>";
                echo "<td width='250' align='center'><span class='label_title'>".$product->getProductDescriptionByLanguageID($s_language_id)->get_product_name()."	</span></td>
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
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none' colspan='2'><span class='label_title'>Shipping Cost:</span></td>
                    <td align='center' style='border-top:none'><b>".outputPriceWithCurrency($s_configManager,$order->get_shipping_cost())."&nbsp;&nbsp;"."</b></td>
                </tr>";
        echo "<tr>
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none'colspan='2'><span class='label_title'><b>Total Cost:</b></span></td>
                    <td align='center' style='border-top:none'><span class='total_cost'><b>".outputPriceWithCurrency($s_configManager,$order->get_order_total_amount())."&nbsp;&nbsp;"."</b></span></td>
                </tr>";

        echo "</table>";
        ?>

        <table width="680" border="0" style="margin-left: 10px" cellpadding="3" cellspacing="3">
            <tr>
                <td  height="30" colspan="2">
                </td>
            </tr>
            <tr>
                <td  height="30" align="right" valign="top" width="200">
                    <b>Order Code: </b>
                </td>
                <td align="left" valign="top" >
                    <?=$order->get_order_code()?>
                </td>
            </tr>
            <tr>
                <td  height="30" align="right" valign="top" width="200">
                    <b>Order Date: </b>
                </td>
                <td align="left" valign="top" >
                    <?=$order->get_order_create_date()?>
                </td>
            </tr>
            <tr>
                <td  height="30" align="right" valign="top" width="200">
                    <b>Order Status: </b>
                </td>
                <td align="left" valign="top" >
                    <?=$orderStatus->getOrderStatusById($order->get_order_status_id())?>
                </td>
            </tr>
            <tr>
                <td  height="30" align="right" valign="top" width="200">
                    <b>Payment Status: </b>
                </td>
                <td align="left" valign="top" >
                    <?=$paymentStatus->getpaymentStatusById($order->get_payment_status_id())?>
                </td>
            </tr>
            <tr>
                <td  height="30" colspan="2">
                </td>
            </tr>
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
</div>
