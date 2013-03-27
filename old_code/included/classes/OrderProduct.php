<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of OrderProduct
 *
 * @author Ziyang
 */
class OrderProduct {
    //put your code here
    private $_order_product_id;
    private $_order_id;
    private $_product_id;
    private $_product;
    private $_order_quantity ;
    private $_selling_price ;


    public function get_order_product_id() {
        return $this->_order_product_id;
    }

    public function set_order_product_id($_order_product_id) {
        $this->_order_product_id = $_order_product_id;
    }

    public function get_order_id() {
        return $this->_order_id;
    }

    public function set_order_id($_order_id) {
        $this->_order_id = $_order_id;
    }

    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_product() {
        if($this->_product == null) {
            $product = new Product();
            $product->load($this->get_product_id());
            $this->set_product($product);
        }
        return $this->_product;
    }

    public function set_product($_product) {
        $this->_product = $_product;
    }

    public function get_order_quantity() {
        return $this->_order_quantity;
    }

    public function set_order_quantity($_order_quantity) {
        $this->_order_quantity = $_order_quantity;
    }

    public function get_selling_price() {
        return $this->_selling_price;
    }

    public function set_selling_price($_selling_price) {
        $this->_selling_price = $_selling_price;
    }


    public function load($order_product_id) {
        $link = getConnection();
        $query="select 	order_product_id,
                        order_id,
                        product_id,
                        order_quantity,
                        selling_price
                from    tb_order_product
                where   order_product_id = ".$order_product_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_order_product_id($newArray['order_product_id']);
            $this->set_order_id($newArray['order_id']);
            $this->set_product_id($newArray['product_id']);
            $this->set_order_quantity($newArray['order_quantity']);
            $this->set_selling_price($newArray['selling_price']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "insert into tb_order_product
                  ( order_id, product_id, order_quantity, selling_price	)
                  values	(".$this->get_order_id().",
                             ".$this->get_product_id().",
                             ".$this->get_order_quantity().",
                             ".$this->get_selling_price().")";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function getOrderProductTotalCost() {
        $cost = 0.00;
        $cost = $this->get_selling_price() * $this->get_order_quantity();
        return $cost;
    }


    public function updateProductOrderCount() {
        $link = getConnection();
        $query = "UPDATE tb_product
                  SET    product_ordered_count = product_ordered_count +  ".$this->_order_quantity."
                  WHERE  product_id = ".$this->get_product_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
