<div class="content">
    <h5>Shopping Cart</h5>
    <div style="padding: 10px 10px 10px 10px ;">
        <?
        include_once 'view/msg_view.php';
        ?>
        <?
        $order = new Order();
        $order = $s_cart->get_order();
        if ( $order->getTotalOrderQuantity() == 0) {
            echo "<span class='label_title'> There is nothing in the shopping cart!</span>";
        }else {
            echo "<table width='680' border='0'  cellpadding='5' cellspacing='0' class='shoppingcart'>";
            echo "<tr bgcolor='#FEFEFE'>
                  <td width='80'  align='center'>&nbsp;</td>
                  <td width='200' align='center'><span class='label_title'><b>Name</b></span></td>
                  <td width='100' align='center'><span class='label_title'><b>Price</b></span></td>
                  <td width='50'  align='center'><span class='label_title'><b>Quantity</b></span></td>
                  <td width='100' align='center'><span class='label_title'><b>Cost</b></span></td>
                  <td width='150' align='center'>&nbsp;</td>
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
                    echo "<form action='process/shopping_cart_update_product.php' method='post' >";
                    echo "<input type='hidden' name='product_id' value='".$product->get_product_id()."'/>";
                    echo "<tr>";
                    echo "<td width='80' ><span class='label_title'>".$productImage->outputProductImage("", "", "", "shoppingcart_product_image")."</span></td>";
                    echo "<td width='200' align='center'><a href='index.php?view=product_detail&product_id=".$product->get_product_id()."'>".$product->getProductDescriptionByLanguageID($s_language_id)->get_product_name()."</a></td>
                          <td width='100' align='center'><span class='label_title'>".$orderProduct->get_selling_price()."</span></td>
                          <td width='50' align='center'><span class='label_title'><input name='quantity'   style='width:50px; height:20px;' value='".$orderProduct->get_order_quantity()."'/></span></td>
                          <td width='100' align='center'><span class='label_title'>".outputPriceWithCurrency($s_configManager,$orderProduct->getOrderProductTotalCost())."&nbsp;&nbsp;"."</span></td>
                          <td width='150' align='center'>
                          <input type='submit' value='Update' name='updateOrderQuantity' class='gray_button_style'/>
                          <input type='submit' value='Remove' name='renmoveOrderProduct' class='gray_button_style'/>
                          </td>";
                    echo "</tr></form>";

                }
            }

            echo "<tr>
                    <td align='center'>&nbsp;</td>
                    <td align='center'>&nbsp;</td>
                    <td align='center' colspan='2'><span class='label_title'><b>Total Cost:</b></span></td>
                    <td align='center'><span class='total_cost'><b>".outputPriceWithCurrency($s_configManager,$order->get_order_total_amount_exclude_shipping())."&nbsp;&nbsp;"."</b></span></td>
                    <td align='center'>
                    <div class='blue_button_box'><a href='process/customer_checkout.php'>Checkout</a></div>
                    </td>
                </tr>";

            echo "</table>";

        }
        ?>
    </div>
</div>


