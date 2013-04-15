<?php
class Category{
    public $category_id;
    public $category_parent_id;
    public $category_name;

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

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_category
                   (category_parent_id, category_name)
                   VALUES (".$this->getCategoryParentId().", '".$this->getCategoryName()."')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update(){
        $link = getConnection();
        $query = " UPDATE ds_category
                   SET    category_parent_id = ".$this->getCategoryParentId().",
                          category_name = '".$this->getCategoryName()."'
                   WHERE  category_id = " . $this->getCategoryId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

}