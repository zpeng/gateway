<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of OrderManager
 *
 * @author ziyang
 */
class OrderManager {
    //put your code here
    public function checkOrderExist($code) {
        $link = getConnection();
        $checkResult = false;
        $query = " select order_id
                from    tb_order
                where   order_code =       '".$code."'";
        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        $num_rows = mysql_num_rows($result); // Find no. of rows retrieved from DB

        if ( $num_rows == 1 ) {
            // email exists
            $checkResult = true;
        }
        return $checkResult;
    }

    public function loadOrderListByClientID($customer_id) {
        $orderList = null;
        $count =0;
        $link = getConnection();
        $query="select 	order_id,
                        order_code,
                        order_create_date,
                        order_status_id,
                        payment_status_id,
                        payment_method_id,
                        order_total_amount,
                        shipping_id,
                        shipping_cost,
                        shipping_date,
                        customer_id,
                        customer_email,
                        order_shipping_address,
                        order_customer_comment,
                        order_administrator_comment
                from    tb_order
                where   customer_id =  ".$customer_id."
                order by order_create_date desc";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $order = new Order();
            $order->set_order_id($newArray['order_id']);
            $order->set_order_code($newArray['order_code']);
            $order->set_order_create_date($newArray['order_create_date']);
            $order->set_order_status_id($newArray['order_status_id']);
            $order->set_payment_status_id($newArray['payment_status_id']);
            $order->set_payment_method_id($newArray['payment_method_id']);
            $order->set_order_total_amount($newArray['order_total_amount']);
            $order->set_shipping_id($newArray['shipping_id']);
            $order->set_shipping_cost($newArray['shipping_cost']);
            $order->set_shipping_date($newArray['shipping_date']);
            $order->set_customer_id($newArray['customer_id']);
            $order->set_customer_email($newArray['customer_email']);
            $order->set_shipping_address($newArray['order_shipping_address']);
            $order->set_customer_comment($newArray['order_customer_comment']);
            $order->set_administrator_comment($newArray['order_administrator_comment']);

            $orderList[$count] = $order;
            $count++;
        }

        return $orderList;
    }

    public function loadOrderList($order_status_id ="",$payment_status_id="") {
        $field = "";
        if ($order_status_id != "") {
            $field = $field." order_status_id = ".$order_status_id;
        }
        if ($payment_status_id != "") {
            if ($field != "") {
                $field = $field." and  payment_method_id = ".$payment_status_id;
            }else {
                $field = $field." and  payment_method_id = ".$payment_status_id;
            }
        }
        if ($field != "") {
            $field = " where ".$field;
        }

        $orderList = null;
        $count =0;
        $link = getConnection();
        $query="select 	order_id,
                        order_code,
                        order_create_date,
                        order_status_id,
                        payment_status_id,
                        payment_method_id,
                        order_total_amount,
                        shipping_id,
                        shipping_cost,
                        shipping_date,
                        customer_id,
                        customer_email,
                        order_shipping_address,
                        order_customer_comment,
                        order_administrator_comment
                from    tb_order
 
                order by order_create_date desc";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $order = new Order();
            $order->set_order_id($newArray['order_id']);
            $order->set_order_code($newArray['order_code']);
            $order->set_order_create_date($newArray['order_create_date']);
            $order->set_order_status_id($newArray['order_status_id']);
            $order->set_payment_status_id($newArray['payment_status_id']);
            $order->set_payment_method_id($newArray['payment_method_id']);
            $order->set_order_total_amount($newArray['order_total_amount']);
            $order->set_shipping_id($newArray['shipping_id']);
            $order->set_shipping_cost($newArray['shipping_cost']);
            $order->set_shipping_date($newArray['shipping_date']);
            $order->set_customer_id($newArray['customer_id']);
            $order->set_customer_email($newArray['customer_email']);
            $order->set_shipping_address($newArray['order_shipping_address']);
            $order->set_customer_comment($newArray['order_customer_comment']);
            $order->set_administrator_comment($newArray['order_administrator_comment']);

            $orderList[$count] = $order;
            $count++;
        }
        return $orderList;
    }

        public function loadOrderListForPeriod($back_no_of_days) {

        $orderList = null;
        $count =0;
        $link = getConnection();
        $query="select 	order_id,
                        order_code,
                        order_create_date,
                        order_status_id,
                        payment_status_id,
                        payment_method_id,
                        order_total_amount,
                        shipping_id,
                        shipping_cost,
                        shipping_date,
                        customer_id,
                        customer_email,
                        order_shipping_address,
                        order_customer_comment,
                        order_administrator_comment
                from    tb_order
                where   order_create_date > ADDDATE(now(),INTERVAL -".$back_no_of_days." DAY)
                order by order_create_date desc";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $order = new Order();
            $order->set_order_id($newArray['order_id']);
            $order->set_order_code($newArray['order_code']);
            $order->set_order_create_date($newArray['order_create_date']);
            $order->set_order_status_id($newArray['order_status_id']);
            $order->set_payment_status_id($newArray['payment_status_id']);
            $order->set_payment_method_id($newArray['payment_method_id']);
            $order->set_order_total_amount($newArray['order_total_amount']);
            $order->set_shipping_id($newArray['shipping_id']);
            $order->set_shipping_cost($newArray['shipping_cost']);
            $order->set_shipping_date($newArray['shipping_date']);
            $order->set_customer_id($newArray['customer_id']);
            $order->set_customer_email($newArray['customer_email']);
            $order->set_shipping_address($newArray['order_shipping_address']);
            $order->set_customer_comment($newArray['order_customer_comment']);
            $order->set_administrator_comment($newArray['order_administrator_comment']);

            $orderList[$count] = $order;
            $count++;
        }
        return $orderList;
    }
}
?>
