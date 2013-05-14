<?php
namespace  modules\deal_steal\includes\classes;

class CategoryManager
{
    public $data;

    public function loadTree($parent_id = 0)
    {
        $this->data = [];
        $link = getConnection();
        $query = "select 	category_id, category_parent_id, category_name
                from	ds_category
                where   category_parent_id = " . $parent_id . "
                order by category_name";

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


    public function getCategoryTreeviewDataSource(){
        $dataSource = array();
        array_push($dataSource, $this->getCategoryChildrenDataSource(1) );
        return $dataSource;
    }

    private function getCategoryChildrenDataSource($category_id)
    {
        $data = array();
        $category= new Category();
        $category->setId($category_id);
        $category->load();
        $data["id"] = $category->getId();
        $data["label"] = $category->getName();
        $data["children"] = array();
        $children = $category->sub_category_list;
        if (sizeof($children) > 0) {
            foreach ($children as $child) {
                array_push($data["children"], $this->getCategoryChildrenDataSource($child->getId()));
            }
        }
        return $data;
    }

}

?>