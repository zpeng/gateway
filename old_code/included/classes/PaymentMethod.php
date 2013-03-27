<?php

class PaymentMethod {

    private $_payment_method_id;
    private $_payment_method_name;
    private $_payment_method_include_path;
    private $_payment_method_logo;
    private $_payment_method_desc;

    public function get_payment_method_id() {
        return $this->_payment_method_id;
    }

    public function set_payment_method_id($_payment_method_id) {
        $this->_payment_method_id = $_payment_method_id;
    }

    public function get_payment_method_name() {
        return $this->_payment_method_name;
    }

    public function set_payment_method_name($_payment_method_name) {
        $this->_payment_method_name = $_payment_method_name;
    }

    public function get_payment_method_include_path() {
        return $this->_payment_method_include_path;
    }

    public function set_payment_method_include_path($_payment_method_include_path) {
        $this->_payment_method_include_path = $_payment_method_include_path;
    }

    public function get_payment_method_logo() {
        return $this->_payment_method_logo;
    }

    public function set_payment_method_logo($_payment_method_logo) {
        $this->_payment_method_logo = $_payment_method_logo;
    }

    public function get_payment_method_desc() {
        return $this->_payment_method_desc;
    }

    public function set_payment_method_desc($_payment_method_desc) {
        $this->_payment_method_desc = $_payment_method_desc;
    }

    public function get_payment_method_logo_as_image($width, $height,$domain_path ) {
        return "<img border='0' width='$width' height='$height' src='".$domain_path."/images/payment_methods/".$this->get_payment_method_logo()."'/>";
    }

    public function get_payment_method_logo_fullpath($domain_path) {
        return $domain_path."/images/payment_methods/".$this->get_payment_method_logo();
    }

    public function load($_id) {
        $link = getConnection();
        $query="select 	payment_method_id,
                        payment_method_name,
                        payment_method_include_path,
                        payment_method_logo,
                        payment_method_desc
                from    tb_payment_method
                where   payment_method_id = ".$_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_payment_method_id($newArray['payment_method_id']);
            $this->set_payment_method_name($newArray['payment_method_name']);
            $this->set_payment_method_include_path($newArray['payment_method_include_path']);
            $this->set_payment_method_logo($newArray['payment_method_logo']);
            $this->set_payment_method_desc($newArray['payment_method_desc']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_payment_method
                        (
                        payment_method_name,
                        payment_method_include_path,
                        payment_method_logo,
                        payment_method_desc
                        )
                        values
                        (
                        '".$this->get_payment_method_name()."',
                        '".$this->get_payment_method_include_path()."',
                        '".$this->get_payment_method_logo()."',
                        '".$this->get_payment_method_desc()."'
                        )";

        executeUpdateQuery($link , $query);

        $payment_method_id = mysql_insert_id($link);
        $this->set_payment_method_id($payment_method_id);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  delete from  tb_payment_method
                    where  payment_method_id    = ".$this->get_payment_method_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_payment_method
                  SET   payment_method_name  = '".$this->get_payment_method_name()."',
                        payment_method_include_path  = '".$this->get_payment_method_include_path()."',
                        payment_method_logo = '".$this->get_payment_method_logo()."',
                        payment_method_desc   = '".$this->get_payment_method_desc()."'
                  WHERE payment_method_id    = ".$this->get_payment_method_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
