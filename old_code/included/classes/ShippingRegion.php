<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ShippingRegion
 *
 * @author ziyang
 */
class ShippingRegion {
    //put your code here
    private $_shipping_region_id;
    private $_shipping_region;

    public function get_shipping_region_id() {
        return $this->_shipping_region_id;
    }

    public function set_shipping_region_id($_shipping_region_id) {
        $this->_shipping_region_id = $_shipping_region_id;
    }

    public function get_shipping_region() {
        return $this->_shipping_region;
    }

    public function set_shipping_region($_shipping_region) {
        $this->_shipping_region = $_shipping_region;
    }


    public function load($shipping_region_id) {
        $link = getConnection();
        $query="select 	shipping_region_id, shipping_region
                from    tb_shipping_region 
                where   shipping_region_id = ".$shipping_region_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_shipping_region_id($newArray['shipping_region_id']);
            $this->set_shipping_region($newArray['shipping_region']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_shipping_region
                    (shipping_region)
                    values
                    ('".$this->get_shipping_region()."')";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  DELETE FROM  tb_shipping_region
                    WHERE  shipping_region_id = ".$this->get_shipping_region_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }


    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_shipping_region
                  SET   shipping_region  = '".$this->get_shipping_region()."'
                  WHERE shipping_region_id = ".$this->get_shipping_region_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);

    }
}
?>
