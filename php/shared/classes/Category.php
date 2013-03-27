<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of Category
 *
 * @author ziyang
 */
class Category {
    //put your code here
    private $_category_id;
    private $_category_parent_id;
    private $_category_name;
    private $_category_desc;
    private $_category_children_list;

    public function get_category_id() {
        return $this->_category_id;
    }

    public function set_category_id($_category_id) {
        $this->_category_id = $_category_id;
    }

    public function get_category_parent_id() {
        return $this->_category_parent_id;
    }

    public function set_category_parent_id($_category_parent_id) {
        $this->_category_parent_id = $_category_parent_id;
    }

    public function get_category_name() {
        return $this->_category_name;
    }

    public function set_category_name($_category_name) {
        $this->_category_name = $_category_name;
    }

    public function get_category_desc() {
        return $this->_category_desc;
    }

    public function set_category_desc($_category_desc) {
        $this->_category_desc = $_category_desc;
    }

    public function get_category_children_list() {
        if ($this->_category_children_list == null ) {
            $this->getCategoryChildrenList();
        }
        return $this->_category_children_list;

    }

    public function set_category_children_list($_category_children_list) {
        $this->_category_children_list = $_category_children_list;
    }




    public function load($category_id) {
        $link = getConnection();
        $query="select 	category_id, category_parent_id, category_name,
                        category_description
                from	tb_category 
                where   category_id = ".$category_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->set_category_id($newArray['category_id']);
            $this->set_category_parent_id($newArray['category_parent_id']);
            $this->set_category_name($newArray['category_name']);
            $this->set_category_desc($newArray['category_description']);
        }
    }

    public function insert() {
        $link = getConnection();
        $query = "  INSERT
                    INTO   tb_category
                           (
                                  category_parent_id,
                                  category_name,
                                  category_description
                           )
                           VALUES
                           (
                                  ".$this->get_category_parent_id()."   ,
                                  '".$this->get_category_name()."' ,
                                  '".$this->get_category_desc()."')";

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    public function delete() {
        // the delete function will remove the current category and all its sub-categories
        $link = getConnection();
        $query = "  DELETE FROM  tb_category
                    WHERE  category_id    = ".$this->get_category_id()."
                    OR     category_parent_id = ".$this->get_category_id();

        executeUpdateQuery($link , $query);

        //delete those in the tb_product_to_category
        $query = "  DELETE FROM  tb_product_to_category
                    WHERE  category_id    = ".$this->get_category_id();

        executeUpdateQuery($link , $query);

        closeConnection($link);
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE tb_category
                  SET    category_parent_id  = ".$this->get_category_parent_id().",
                         category_name       = '".$this->get_category_name()."',
                         category_description= '".$this->get_category_desc()."'
                  WHERE  category_id         = ".$this->get_category_id();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }

    private function getCategoryChildrenList() {
        $_category_children_list = null;
        $count = 0;
        $link = getConnection();
        $query="select 	category_id, category_parent_id, category_name,
                        category_description
                from	tb_category 
                where   category_parent_id = ".$this->get_category_id();

        $result = executeNonUpdateQuery($link , $query, "Category.getCategoryChildrenList()");
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $category = new Category();
            $category->set_category_id($newArray['category_id']);
            $category->set_category_parent_id($newArray['category_parent_id']);
            $category->set_category_name($newArray['category_name']);
            $category->set_category_desc($newArray['category_description']);

            $_category_children_list[$count] =$category;
            $count ++;
        }

        $this->set_category_children_list($_category_children_list);

    }

}
?>
