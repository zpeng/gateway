<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of CategoryManager
 *
 * @author ziyang
 */
class CategoryManager {
    //put your code here
    public function getTopCategoryList() {
        $topCategoryList;
        $count =  0;
        $link = getConnection();

        $query="select 	id, parent_id, name,
                        category_description
                from	tb_category
                where   parent_id = 0 ";

        $result = executeNonUpdateQuery($link , $query ,"CategoryManager.getTopCategoryList");
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $category = new Category();
            $category->set_category_id($newArray['id']);
            $category->set_category_parent_id($newArray['parent_id']);
            $category->set_category_name($newArray['name']);
            $category->set_category_desc($newArray['category_description']);

            $topCategoryList[$count] =$category;
            $count ++;
        }
        return $topCategoryList;
    }
}
?>
