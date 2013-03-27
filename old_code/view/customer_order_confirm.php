<div class="content">
    <h5>Order Confirm</h5>
    <div style="padding: 10px 10px 10px 10px ;">

        <?
        $order = new Order();
        $order = $s_cart->get_order();
        if ( $order->getTotalOrderQuantity() == 0) {
            echo "<span class='label_title'> There is nothing in the shopping cart!</span>";
        }else {
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
            echo "<tr style='border-top:none'>
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none'>&nbsp;</td>
                    <td align='center' style='border-top:none' colspan='2'><span class='label_title'><b>Total Cost:</b></span></td>
                    <td align='center' style='border-top:none'><span class='total_cost'><b>".outputPriceWithCurrency($s_configManager,$order->get_order_total_amount())."&nbsp;&nbsp;"."</b></span></td>
                </tr>";

            echo "</table>";

        }
        ?>

        <br/>
        <form id="customerOrderConfirmForm" action='process/customer_order_process.php' method='post'>
            <table width="400" border="0" style="margin-left: 10px">
                <tr>
                    <td  height="30" align="left" colspan="2">
                    </td>
                </tr>
                <tr>
                    <td  height="30" align="left" valign="top" width="150">
                        <b>Shipping Method :</b>
                    </td>
                    <td align="left" valign="top" >
                        <?=$order->get_shipping_method()->get_shipping_type()?>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" width="150">
                        <b>Shipping to :</b>
                    </td>
                    <td align="left" valign="top">
                        <?=$order->get_shipping_address()?>
                    </td>
                </tr>
                <tr>
                    <td  height="30" align="left" colspan="2">
                    </td>
                </tr>
                <tr>
                    <td  height="20" align="left" colspan="2">
                        <b>Choose Your Payment Method:</b>
                    </td>
                </tr>
                <tr>
                    <td height="20" align="left" colspan="2">
                        <?
                        echo outputPaymentMethodRadioButtonsGroupTable($s_configManager);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td  height="30" align="left" colspan="2">
                    </td>
                </tr>
                <tr>
                    <td  height="20" align="left" colspan="2">
                        <b>Leave a message to us if you have special needs:</b>
                    </td>
                </tr>
                <tr>
                    <td  height="30" align="left" colspan="2">
                        <textarea name="customer_comment" cols="40" rows="3"></textarea>
                    </td>
                </tr>
                <tr>
                    <td height="20" colspan="2">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Make Your Order" title="Make Your Order" class="blue_button_style"/>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

