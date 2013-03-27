<?php

/**
 * Description of AttributeManager
 *
 * @author ziyang
 */
class AttributeManager {
    //put your code here
    public function getAttributeList() {
        $attributeList = null;
        $count = 0;

        $link = getConnection();
        $query="select 	attribute_id,
                        attribute_name
                from	tb_attribute";


        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $attribute = new Attribute();

            $attribute->set_attribute_id($newArray['attribute_id']);
            $attribute->set_attribute_name($newArray['attribute_name']);
            $attributeList[$count] = $attribute;
            $count++;
        }
        return $attributeList;
    }
}
?>
