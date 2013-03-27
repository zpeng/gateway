<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ProductDescription
 *
 * @author ziyang
 */
class ProductDescription {
    //put your code here
    private $_product_description_id;
    private $_product_id;
    private $_language_id;
    private $_product_name;
    private $_product_description;

    public function get_product_description_id() {
        return $this->_product_description_id;
    }

    public function set_product_description_id($_product_description_id) {
        $this->_product_description_id = $_product_description_id;
    }
    
    public function get_product_id() {
        return $this->_product_id;
    }

    public function set_product_id($_product_id) {
        $this->_product_id = $_product_id;
    }

    public function get_language_id() {
        return $this->_language_id;
    }

    public function set_language_id($_language_id) {
        $this->_language_id = $_language_id;
    }

    public function get_product_name() {
        return $this->_product_name;
    }

    public function set_product_name($_product_name) {
        $this->_product_name = $_product_name;
    }

    public function get_product_description() {
        return $this->_product_description;
    }

    public function set_product_description($_product_description) {
        $this->_product_description = $_product_description;
    }


    public function load($product_description_id) {
        $link = getConnection();
        $query="select 	product_description_id, product_id, language_id, product_name, 
                        product_description
                from    tb_product_description
                where   product_description_id = ".$product_description_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_product_description_id($newArray['product_description_id']);
            $this->set_product_id($newArray['product_id']);
            $this->set_language_id($newArray['language_id']);
            $this->set_product_name($newArray['product_name']);
            $this->set_product_description(stripslashes($newArray['product_description']));
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  INSERT
                    INTO   tb_product_description
                           (
                                  product_id,
                                  language_id,
                                  product_name,
                                  product_description
                           )
                           VALUES
                           (
                                  ".$this->get_product_id()."   ,
                                  ".$this->get_language_id()."   ,
                                  '".$this->get_product_name()."' ,
                                  '".$this->get_product_description()."')";
        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        // the delete function will remove the current category and all its sub-categories
        $link = getConnection();
        $query = "  DELETE FROM  tb_product_description
                    WHERE  product_description_id    = ".$this->get_product_description_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {

        $link = getConnection();
        $query = "UPDATE tb_product_description
                  SET    product_name       = '".$this->get_product_name()."',
                         product_description= '".$this->get_product_description()."'
                  WHERE  product_description_id = ".$this->get_product_description_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);

    }

}
?>
