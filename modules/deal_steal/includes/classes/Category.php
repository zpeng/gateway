<?php
class Category
{
    public $category_id;
    public $category_parent_id;
    public $category_name;
    public $sub_category_list = [];

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCategoryParentId($category_parent_id)
    {
        $this->category_parent_id = $category_parent_id;
    }

    public function getCategoryParentId()
    {
        return $this->category_parent_id;
    }

    public function load()
    {
        $link = getConnection();
        $query="select 	category_id, category_parent_id, category_name
                from	ds_category
                where   category_id = ".$this->getCategoryId();

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->setCategoryId($newArray['category_id']);
            $this->setCategoryParentId($newArray['category_parent_id']);
            $this->setCategoryName($newArray['category_name']);
            $this->loadSubCategories($this->getCategoryId());
        }
    }

    public function loadSubCategories($_parent_id){
        $link = getConnection();
        $query="select 	category_id, category_parent_id, category_name
                from	ds_category
                where   category_parent_id = ". $_parent_id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        $this->sub_category_list = [];
        while ($newArray = mysql_fetch_array($result)) {
            $sub_category = new Category();
            $sub_category->setCategoryId($newArray['category_id']);
            $sub_category->setCategoryParentId($newArray['category_parent_id']);
            $sub_category->setCategoryName($newArray['category_name']);
            $sub_category->loadSubCategories($sub_category->getCategoryId());
            array_push($this->sub_category_list, $sub_category);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_category
                   (category_parent_id, category_name)
                   VALUES (" . $this->getCategoryParentId() . ", '" . $this->getCategoryName() . "')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update()
    {
        $link = getConnection();
        $query = " UPDATE ds_category
                   SET    category_name = '" . $this->getCategoryName() . "'
                   WHERE  category_id = " . $this->getCategoryId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function move()
    {
        $link = getConnection();
        $query = " UPDATE ds_category
                   SET    category_parent_id = " . $this->getCategoryParentId() . "
                   WHERE  category_id = " . $this->getCategoryId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = " DELETE
                   FROM   ds_category
                   WHERE  category_id = " . $this->getCategoryId() . "
                   AND    category_parent_id = " . $this->getCategoryId() . ",";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function toJSON()
    {
        return str_replace('\\u0000', "", json_encode((array)$this));
    }

}

?>