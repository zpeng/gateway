<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of OrderStatus
 *
 * @author ziyang
 */
class OrderStatus {
    //put your code here

    private $_order_status_value = array(1 => 'Pending from payment',
                                         2 => 'Due to delivery',
                                         3 => 'Dispatched',
                                         4 => 'Completed',
                                         5 => 'Cancelled',
                                         6 => 'Dispute');

    public function get_order_status_value() {
        return $this->_order_status_value;
    }

    public function set_order_status_value($_order_status_value) {
        $this->_order_status_value = $_order_status_value;
    }

    public function getOrderStatusById($id){
        $order_status_value = $this->get_order_status_value();
        return $order_status_value[$id];
    }


}
?>
