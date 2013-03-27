<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ProductImage
 *
 * @author ziyang
 */
class ProductImage {
//put your code here
    private $_product_image_id;
    private $_product_id;
    private $_product_image_url;
    private $_product_image_path;
    private $_product_image_default;

    public function get_product_image_id() {
        return $this->_product_image_id;
    }

    public function set_product_image_id($_product_image_id) {
        $this->_product_image_id = $_product_image_id;
    }

    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_product_image_url() {
        return $this->_product_image_url;
    }

    public function set_product_image_url($_product_image_url) {
        $this->_product_image_url = $_product_image_url;
    }

    public function get_product_image_path() {
        return $this->_product_image_path;
    }

    public function set_product_image_path($_product_image_path) {
        $this->_product_image_path = $_product_image_path;
    }

    public function get_product_image_default() {
        return $this->_product_image_default;
    }

    public function set_product_image_default($_product_image_default) {
        $this->_product_image_default = $_product_image_default;
    }

    public function get_image_full_path() {
        return  $this->_product_image_path.$this->_product_image_url;
    }

    public function get_product_image_default_as_icon() {
        $field = "";
        if ($this->_product_image_default == 'Y') {
            $field = $field."<img border='0' width='15' height='15' src='images/green_status.png'/>";
        }else {
            $field = $field."<img border='0' width='15' height='15' src='images/status-offline.png'/>";
        }
        return $field;
    }


    public function load($product_image_id) {
        $link = getConnection();
        $query="select 	product_image_id,
                        product_id,
                        product_image_url,
                        product_image_default
                from	tb_product_image
                where   product_image_id = ".$product_image_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_product_image_id($newArray['product_image_id']);
            $this->set_product_id($newArray['product_id']);
            $this->set_product_image_url($newArray['product_image_url']);
            $this->set_product_image_default($newArray['product_image_default']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_product_image
	(product_id, product_image_url, product_image_default
	)
	values
	(".$this->get_product_id().",
         '".$this->get_product_image_url()."',
         '".$this->get_product_image_default()."')";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        $link = getConnection();
        $query = "  DELETE FROM  tb_product_image
                    WHERE  product_image_id = ".$this->get_product_image_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function updateDefaultImage($boolean_value) {
        $link = getConnection();
        $query = "UPDATE tb_product_image
                  SET    product_image_default  = '".$boolean_value."'
                  WHERE  product_image_id    = ".$this->get_product_image_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function outputProductImage($width="", $height="", $msg="", $className="" ) {
        $str = "<img border='0' src='".$this->get_product_image_path().$this->get_product_image_url()."'";
        if ( $width!="") {
            $str = $str." width='$width'";
        }
        if ( $height!="") {
            $str = $str." height='$height'";
        }
        if ( $msg!="") {
            $str = $str." alt='$msg'";
        }
        if ( $className!="") {
            $str = $str." class='$className'";
        }
        $str = $str." />";
        return $str;
    }
}
?>
