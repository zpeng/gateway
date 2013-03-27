<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Manufacturer
 *
 * @author ziyang
 */
class Manufacturer {
    //put your code here
    private $_manufacturer_id;
    private $_manufacturer_name;
    private $_manufacturer_desc;
    private $_manufacturer_image;
    private $_manufacturer_url;
    private $_manufacturer_archived;

    public function get_manufacturer_id() {
        return $this->_manufacturer_id;
    }

    public function set_manufacturer_id($_manufacturer_id) {
        $this->_manufacturer_id = $_manufacturer_id;
    }

    public function get_manufacturer_name() {
        return $this->_manufacturer_name;
    }

    public function set_manufacturer_name($_manufacturer_name) {
        $this->_manufacturer_name = $_manufacturer_name;
    }

    public function get_manufacturer_desc() {
        return $this->_manufacturer_desc;
    }

    public function set_manufacturer_desc($_manufacturer_desc) {
        $this->_manufacturer_desc = $_manufacturer_desc;
    }

    public function get_manufacturer_image() {
        return $this->_manufacturer_image;
    }

    public function set_manufacturer_image($_manufacturer_image) {
        $this->_manufacturer_image = $_manufacturer_image;
    }

    public function get_manufacturer_url() {
        return $this->_manufacturer_url;
    }

    public function set_manufacturer_url($_manufacturer_url) {
        $this->_manufacturer_url = $_manufacturer_url;
    }

    public function get_manufacturer_archived() {
        return $this->_manufacturer_archived;
    }

    public function set_manufacturer_archived($_manufacturer_archived) {
        $this->_manufacturer_archived = $_manufacturer_archived;
    }

    public function get_brand_logo_as_image($width, $height,$domain_path ) {
        return "<img border='0' width='$width' height='$height' src='".$domain_path."/images/brands/".$this->get_manufacturer_image()."'/>";
    }

    public function get_brand_logo_fullpath($domain_path) {
        return $domain_path."/images/brands/".$this->get_manufacturer_image();
    }

    public function load($_id) {
        $link = getConnection();
        $query="select 	manufacturer_id,
                        manufacturer_name, 
                        manufacturer_desc, 
                        manufacturer_image, 
                        manufacturer_url, 
                        manufacturer_archived
                from    tb_manufacturer 
                where   manufacturer_archived = 'N'
                and     manufacturer_id = ".$_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_manufacturer_id($newArray['manufacturer_id']);
            $this->set_manufacturer_name($newArray['manufacturer_name']);
            $this->set_manufacturer_desc(stripslashes($newArray['manufacturer_desc']));
            $this->set_manufacturer_image($newArray['manufacturer_image']);
            $this->set_manufacturer_url($newArray['manufacturer_url']);
            $this->set_manufacturer_archived($newArray['manufacturer_archived']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = " insert into tb_manufacturer
                        (
                        manufacturer_name,
                        manufacturer_desc,
                        manufacturer_image,
                        manufacturer_url,
                        manufacturer_archived
                        )
                        values
                        (
                        '".$this->get_manufacturer_name()."',
                        '".$this->get_manufacturer_desc()."',
                        '".$this->get_manufacturer_image()."',
                        '".$this->get_manufacturer_url()."',
                        'N'
                        )";

        executeUpdateQuery($link , $query);

        $brand_id = mysql_insert_id($link);
        $this->set_manufacturer_id($brand_id);
        closeConnection($link);


    }

    public function delete() {
        $link = getConnection();
        $query = "  UPDATE  tb_manufacturer
                    SET   manufacturer_archived = 'Y'
                    WHERE  manufacturer_id    = ".$this->get_manufacturer_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_manufacturer
                  SET   manufacturer_name  = '".$this->get_manufacturer_name()."',
                        manufacturer_desc  = '".$this->get_manufacturer_desc()."',
                        manufacturer_image = '".$this->get_manufacturer_image()."',
                        manufacturer_url   = '".$this->get_manufacturer_url()."'
                  WHERE manufacturer_id    = ".$this->get_manufacturer_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);

    }
}
?>
