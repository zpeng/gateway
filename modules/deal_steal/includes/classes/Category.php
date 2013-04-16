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
                   SET    category_parent_id = " . $this->getCategoryParentId() . ",
                          category_name = '" . $this->getCategoryName() . "'
                   WHERE  category_id = " . $this->getCategoryId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function getSubCategoryList(){
        $this->sub_category_list = [];
        $count = 0;
        $link = getConnection();
        $query = "SELECT  category_id,
                          category_parent_id,
                          category_name
                        FROM category_parent_id " . $this->getCategoryId();

        $result = executeNonUpdateQuery($link, $query);

        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $subCategory = new Category();
            $subCategory->setCategoryId($newArray['category_id']);
            $subCategory->setCategoryParentId($newArray['category_parent_id']);
            $subCategory->setCategoryName($newArray['category_name']);

            $subCategory->sub_category_list = $subCategory->getSubCategoryList();
            $this->sub_category_list[$count] = $subCategory;
            $count++;
        }
        return $this->sub_category_list;
    }

}

?>