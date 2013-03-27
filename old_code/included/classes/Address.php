<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Address
 *
 * @author ziyang
 */
class Address {
    //put your code here
    private $_customer_id;
    private $_address_type;
    private $_recipients;
    private $_street;
    private $_city;
    private $_postcode;
    private $_state;
    private $_country;


    public function get_address_id() {
        return $this->_address_id;
    }

    public function set_address_id($_address_id) {
        $this->_address_id = $_address_id;
    }

    public function get_customer_id() {
        return $this->_customer_id;
    }

    public function set_customer_id($_customer_id) {
        $this->_customer_id = $_customer_id;
    }

    public function get_address_type() {
        return $this->_address_type;
    }

    public function set_address_type($_address_type) {
        $this->_address_type = $_address_type;
    }

    public function get_recipients() {
        return $this->_recipients;
    }

    public function set_recipients($_recipients) {
        $this->_recipients = $_recipients;
    }

    public function get_street() {
        return $this->_street;
    }

    public function set_street($_street) {
        $this->_street = $_street;
    }

    public function get_city() {
        return $this->_city;
    }

    public function set_city($_city) {
        $this->_city = $_city;
    }

    public function get_postcode() {
        return $this->_postcode;
    }

    public function set_postcode($_postcode) {
        $this->_postcode = $_postcode;
    }

    public function get_state() {
        return $this->_state;
    }

    public function set_state($_state) {
        $this->_state = $_state;
    }

    public function get_country() {
        return $this->_country;
    }

    public function set_country($_country) {
        $this->_country = $_country;
    }


    public function replace() {
        $link = getConnection();
        $query = " replace into tb_address
                   values	(
                    ".$this->get_customer_id().",
                    '".$this->get_address_type()."',
                    '".$this->get_recipients()."',
                    '".$this->get_street()."',
                    '".$this->get_city()."',
                    '".$this->get_postcode()."',
                    '".$this->get_state()."',
                    '".$this->get_country()."'	)";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function outputAsHTMLString() {
        $str = "";
        if ($this->_recipients != null) {
            $str = $str.$this->_recipients."<br />";
        }
        if ($this->_street != null) {
            $str = $str.$this->_street."<br />";
        }
        if ($this->_city != null) {
            $str = $str.$this->_city."<br />";
        }       
        if ($this->_postcode != null) {
            $str = $str.$this->_postcode."<br />";
        }
        if ($this->_state != null) {
            $str = $str.$this->_state."<br />";
        }
        if ($this->_country != null) {
            $str = $str.$this->_country."<br />";
        }
        return $str;
    }
}
?>
