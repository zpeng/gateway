<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of AttributeValue
 *
 * @author ziyang
 */
class AttributeValue {
    //put your code here
    private $_attribute_value_id;
    private $_attribute_id;
    private $_attribute;
    private $_attribute_value;

    public function get_attribute_value_id() {
        return $this->_attribute_value_id;
    }

    public function set_attribute_value_id($_attribute_value_id) {
        $this->_attribute_value_id = $_attribute_value_id;
    }

    public function get_attribute_id() {
        return $this->_attribute_id;
    }

    public function set_attribute_id($_attribute_id) {
        $this->_attribute_id = $_attribute_id;
    }

    public function get_attribute() {
        if ($this->_attribute == null){
            $attribute = new Attribute();
            $attribute->load($this->_attribute_id);
            $this->set_attribute($attribute);
        }
        return $this->_attribute;
    }

    public function set_attribute($_attribute) {
        $this->_attribute = $_attribute;
    }

    public function get_attribute_value() {
        return $this->_attribute_value;
    }

    public function set_attribute_value($_attribute_value) {
        $this->_attribute_value = $_attribute_value;
    }



    public function load($attribute_value_id) {
        $link = getConnection();
        $query="select 	attribute_value_id,
                        attribute_id,
                        attribute_value
                from	tb_attribute_value
                where   attribute_value_id = ".$attribute_value_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_attribute_value_id($newArray['attribute_value_id']);
            $this->set_attribute_id($newArray['attribute_id']);
            $this->set_attribute_value($newArray['attribute_value']);

            $attribute = new Attribute();
            $attribute->load($this->get_attribute_id());

            $this->set_attribute($attribute);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  insert into tb_attribute_value
                    (attribute_id, attribute_value)
                     values
                    (".$this->get_attribute_id().",
                     '".$this->get_attribute_value()."')";


        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        // the delete function will remove the current category and all its sub-categories
        $link = getConnection();
        $query = "  DELETE FROM  tb_attribute_value
                    WHERE  attribute_value_id    = ".$this->get_attribute_value_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_attribute_value
                  SET    attribute_value  = '".$this->get_attribute_value()."'
                  WHERE  attribute_value_id    = ".$this->get_attribute_value_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
