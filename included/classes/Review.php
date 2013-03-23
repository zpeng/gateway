<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Review
 *
 * @author ziyang
 */
class Review {
    //put your code here
    private $_review_id;
    private $_customer_id;
    private $_customer;
    private $_product_id;
    private $_product;
    private $_review_rate;
    private $_review_text;
    private $_review_date;




    public function get_review_id() {
        return $this->_review_id;
    }

    public function set_review_id($_review_id) {
        $this->_review_id = $_review_id;
    }

    public function get_customer() {
        if ($this->_customer == null){
           $customer = new Customer();
           $customer->loadById($this->get_customer_id());
           $this->set_customer($customer);
        }
        return $this->_customer;
    }

    public function set_customer($_customer) {
        $this->_customer = $_customer;
    }

    public function get_product() {
        if ($this->_product == null) {
            $product = new Product();
            $product->load($this->get_product_id());
            $this->set_product($product);
        }
        return $this->_product;
    }
    
    public function set_product($_product) {
        $this->_product = $_product;
    }

    public function get_customer_id() {
        return $this->_customer_id;
    }

    public function set_customer_id($_customer_id) {
        $this->_customer_id = $_customer_id;
    }

    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_review_rate() {
        return $this->_review_rate;
    }

    public function set_review_rate($_review_rate) {
        $this->_review_rate = $_review_rate;
    }

    public function get_review_text() {
        return $this->_review_text;
    }

    public function set_review_text($_review_text) {
        $this->_review_text = $_review_text;
    }

    public function get_review_date() {
        return $this->_review_date;
    }

    public function set_review_date($_review_date) {
        $this->_review_date = $_review_date;
    }

    public function load($review_id) {
        $link = getConnection();
        $query="select 	review_id,
                        customer_id, 
                        product_id, 
                        review_rate, 
                        review_text, 
                        review_date
                from    tb_review 
                where   review_id = ".$review_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_review_id($newArray['review_id']);
            $this->set_product_id($newArray['product_id']);
            $this->set_customer_id($newArray['customer_id']);
            $this->set_review_rate($newArray['review_rate']);
            $this->set_review_text($newArray['review_text']);
            $this->set_review_date($newArray['review_date']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_review
                    (  customer_id,
                       product_id,
                       review_rate,
                       review_text,
                       review_date	)
                    values
                    (  ".$this->get_customer_id().",
                       ".$this->get_product_id().",
                       ".$this->get_review_rate().",
                       '".$this->get_review_text()."',
                       now() )";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  DELETE FROM  tb_review
                    WHERE  review_id = ".$this->get_review_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
