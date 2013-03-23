<div class="content">
    <h5>Order History</h5>
    <div style="padding: 10px 10px 10px 10px ;">
        <?
        include_once 'view/msg_view.php';
        ?>
        <?
        $orderManger = new OrderManager();
        $orderList = $orderManger->loadOrderListByClientID($s_cart->get_customer_id());
        if (  sizeof($orderList) == 0) {
            echo "<span class='label_title'> There is no order yet!</span>";
        }else {
            echo "<table width='680' border='0'  cellpadding='5' cellspacing='0' class='table_style'>";
            echo "<tr bgcolor='#FEFEFE'>
                   <td width='200' align='center'><span class='label_title'><b>Order Code</b></span></td>
                   <td width='180' align='center'><span class='label_title'><b>Order Date</b></span></td>
                   <td width='150' align='center'><span class='label_title'><b>Order Status</b></span></td>
                   <td width='150' align='center'><span class='label_title'><b>Payment Status</b></span></td>
               </tr>";

            $order= new Order();
            foreach($orderList as $order) {
                $orderStatus = new OrderStatus();
                $paymentStatus = new PaymentStatus();
                echo "<tr>";
                echo "<td><a href='index.php?view=customer_order_detail&order_code=".$order->get_order_code()."'>".$order->get_order_code()."</a></td>";
                echo "<td><span class='label_title'>".$order->get_order_create_date()."</span></td>";
                echo "<td><span class='label_title'>".$orderStatus->getOrderStatusById($order->get_order_status_id())."</span></td>";
                echo "<td><span class='label_title'>".$paymentStatus->getpaymentStatusById($order->get_payment_status_id())."</span></td>";
                echo "</tr>";
            }
            echo "</table>";

        }
        ?>
    </div>
</div>
