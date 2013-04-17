<?php
class CategoryManager
{
    public $data;

    public function loadTree($parent_id=0)
    {
        $this->data = [];
        $link = getConnection();
        $query = "select 	category_id, category_parent_id, category_name
                from	ds_category
                where   category_parent_id = " . $parent_id;

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $category = new Category();
            $category->setId($newArray['category_id']);
            $category->setParentId($newArray['category_parent_id']);
            $category->setName($newArray['category_name']);
            $category->loadSubCategories($newArray['category_id']);
            array_push($this->data, $category);
        }
    }

    public function toJSON()
    {
        $json = array();
        foreach ($this->data as $node) {
            array_push($json, $node->getJSON());
        }
        return str_replace('\\u0000', "", json_encode($json));
    }
}

?>