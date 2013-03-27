<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Attribute
 *
 * @author ziyang
 */
class Attribute {
    //put your code here
    private $_attribute_id;
    private $_attribute_name;
    private $_attribute_value_list;

    public function get_attribute_id() {
        return $this->_attribute_id;
    }

    public function set_attribute_id($_attribute_id) {
        $this->_attribute_id = $_attribute_id;
    }

    public function get_attribute_name() {
        return $this->_attribute_name;
    }

    public function set_attribute_name($_attribute_name) {
        $this->_attribute_name = $_attribute_name;
    }

    public function get_attribute_value_list() {
        if($this->_attribute_value_list == null) {
            $this->loadAttributeValueList();
        }
        return $this->_attribute_value_list;
    }

    public function set_attribute_value_list($_attribute_value_list) {
        $this->_attribute_value_list = $_attribute_value_list;
    }

    public function load($attribute_id) {
        $link = getConnection();
        $query="select 	attribute_id,
                        attribute_name
                from	tb_attribute
                where   attribute_id = ".$attribute_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_attribute_id($newArray['attribute_id']);
            $this->set_attribute_name($newArray['attribute_name']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  INSERT
                    INTO   tb_attribute
                           (
                              attribute_name
                           )
                           VALUES
                           ('".$this->get_attribute_name()."')";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        // the delete function will remove the  attribute and all its attribute value
        $link = getConnection();
        $query = "  DELETE FROM  tb_attribute
                    WHERE  attribute_id = ".$this->get_attribute_id();

        executeUpdateQuery($link , $query);

        $query1 = "DELETE FROM  tb_attribute_value
                    WHERE  attribute_id    = ".$this->get_attribute_id();

        executeUpdateQuery($link , $query1);
        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_attribute
                  SET    attribute_name  = '".$this->get_attribute_name()."'
                  WHERE  attribute_id    = ".$this->get_attribute_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    private function loadAttributeValueList() {
        $attributeValueList = null;
        $count = 0;

        $link = getConnection();
        $query="select 	attribute_value_id,
                        attribute_id,
                        attribute_value
                from	tb_attribute_value 
                where   attribute_id = " .$this->get_attribute_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $attributeValue = new AttributeValue();

            $attributeValue->set_attribute_value_id($newArray['attribute_value_id']);
            $attributeValue->set_attribute_id($newArray['attribute_id']);
            $attributeValue->set_attribute_value($newArray['attribute_value']);

            $attributeValueList[$count] = $attributeValue;
            $count++;
        }

        $this->set_attribute_value_list($attributeValueList);
    }

    public function loadProductAttributeValueList($product_id) {
        $attributeValueList = null;
        $count = 0;

        $link = getConnection();
        $query="select 	tb_attribute_value.attribute_value_id,
                        tb_attribute_value.attribute_id,
                        tb_attribute_value.attribute_value
                from	tb_attribute_value, tb_product_to_attribute_value, tb_attribute
                where   tb_attribute.attribute_id = tb_attribute_value.attribute_id
                and     tb_attribute_value.attribute_value_id = tb_product_to_attribute_value.attribute_value_id
                and     tb_product_to_attribute_value.product_id = ".$product_id."
                and     tb_attribute_value.attribute_id = " .$this->get_attribute_id();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $attributeValue = new AttributeValue();

            $attributeValue->set_attribute_value_id($newArray['attribute_value_id']);
            $attributeValue->set_attribute_id($newArray['attribute_id']);
            $attributeValue->set_attribute_value($newArray['attribute_value']);

            $attributeValueList[$count] = $attributeValue;
            $count++;
        }

        return $attributeValueList;
    }
}
?>
