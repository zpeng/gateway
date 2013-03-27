<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shipping
 *
 * @author ziyang
 */
class Shipping {
    //put your code here

    private $_shipping_id;

    private $_shipping_region_id;
    private $_shipping_region;

    private $_shipping_cost;
    private $_shipping_type;
    private $_shipping_detail;


    public function get_shipping_id() {
        return $this->_shipping_id;
    }

    public function set_shipping_id($_shipping_id) {
        $this->_shipping_id = $_shipping_id;
    }

    public function get_shipping_region_id() {
        return $this->_shipping_region_id;
    }

    public function set_shipping_region_id($_shipping_region_id) {
        $this->_shipping_region_id = $_shipping_region_id;
    }

    public function get_shipping_region() {
        if ($this->_shipping_region == null){
            $shippingRegion = new ShippingRegion();
            $shippingRegion->load($this->get_shipping_region_id());
            $this->set_shipping_region($shippingRegion);
        }
        return $this->_shipping_region;
    }

    public function set_shipping_region($_shipping_region) {
        $this->_shipping_region = $_shipping_region;
    }

    public function get_shipping_cost() {
        return $this->_shipping_cost;
    }

    public function set_shipping_cost($_shipping_cost) {
        $this->_shipping_cost = $_shipping_cost;
    }

    public function get_shipping_type() {
        return $this->_shipping_type;
    }

    public function set_shipping_type($_shipping_type) {
        $this->_shipping_type = $_shipping_type;
    }

    public function get_shipping_detail() {
        return $this->_shipping_detail;
    }

    public function set_shipping_detail($_shipping_detail) {
        $this->_shipping_detail = $_shipping_detail;
    }

    public function load($shipping_id) {
        $link = getConnection();
        $query="select 	shipping_id, 
                        shipping_region_id, 
                        shipping_type, 
                        shipping_cost, 
                        shipping_details
                from    tb_shipping 
                where   shipping_id = ".$shipping_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_shipping_id($newArray['shipping_id']);
            $this->set_shipping_region_id($newArray['shipping_region_id']);
            $this->set_shipping_type($newArray['shipping_type']);
            $this->set_shipping_cost($newArray['shipping_cost']);
            $this->set_shipping_detail($newArray['shipping_details']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  insert into tb_shipping
                    (shipping_region_id, shipping_type, shipping_cost, shipping_details
                    )values(
                    ".$this->get_shipping_region_id().",
                    '".$this->get_shipping_type()."',
                    ".$this->get_shipping_cost().",
                    '".$this->get_shipping_detail()."' )";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  DELETE FROM  tb_shipping
                    WHERE  shipping_id = ".$this->get_shipping_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }


    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_shipping
                  SET   shipping_region_id  = ".$this->get_shipping_region_id()." ,
                        shipping_type  = '".$this->get_shipping_type()."',
                        shipping_cost  = ".$this->get_shipping_cost().",
                        shipping_details  = '".$this->get_shipping_detail()."'
                  WHERE  shipping_id = ".$this->get_shipping_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);

    }

}
?>
