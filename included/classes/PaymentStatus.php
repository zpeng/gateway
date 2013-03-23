<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of PaymentStatus
 *
 * @author ziyang
 */
class PaymentStatus {
    //put your code here
    private $_payment_status_value = array(1 => 'Pending from payment',
                                           2 => 'Payment received' ,
                                           3 => 'Payment process failed');
    public function get_payment_status_value() {
        return $this->_payment_status_value;
    }

    public function set_payment_status_value($_payment_status_value) {
        $this->_payment_status_value = $_payment_status_value;
    }

    public function getpaymentStatusById($id) {
        $payment_status_value = $this->get_payment_status_value();
        return $payment_status_value[$id];
    }
}
?>
