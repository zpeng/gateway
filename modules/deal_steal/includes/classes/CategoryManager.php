<?php
class CategoryManager{
    public $category_tree;

    public function loadTree()
    {
        $this->category_tree = [];
        $link = getConnection();
        $query="select 	category_id, category_parent_id, category_name
                from	ds_category";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $category = new Category();
            $category->setCategoryId($newArray['category_id']);
            $category->setCategoryParentId($newArray['category_parent_id']);
            $category->setCategoryName($newArray['category_name']);
            $category->loadSubCategories($newArray['category_id']);
            array_push($this->category_tree, $category);
        }
    }

    public function toJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this));
    }
}
?>