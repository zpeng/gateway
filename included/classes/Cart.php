<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Cart
 *
 * @author Ziyang
 */
class Cart {
    //put your code here
    private $_customer_id;
    private $_customer_login;
    private $_customer;
    private $_order;


    static public function cast(Cart $object) {
        return $object;
    }

    public function get_customer_id() {
        return $this->_customer_id;
    }

    public function set_customer_id($_customer_id) {
        $this->_customer_id = $_customer_id;
    }

    public function get_customer_login() {
        return $this->_customer_login;
    }

    public function set_customer_login($_customer_login) {
        $this->_customer_login = $_customer_login;
    }

    public function get_customer() {
        if ($this->_customer == null) {
            $customer = new Customer();
            $customer->loadById($this->get_customer_id());
            $this->set_customer($customer);
        }
        return $this->_customer;
    }

    public function set_customer($_customer) {
        $this->_customer = $_customer;
    }

    public function get_order() {
        return $this->_order;
    }

    public function set_order($_order) {
        $this->_order = $_order;
    }

    public function get_onprocess_order() {
        return $this->_onprocess_order;
    }

    public function set_onprocess_order($_onprocess_order) {
        $this->_onprocess_order = $_onprocess_order;
    }


}
?>
