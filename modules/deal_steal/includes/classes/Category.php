<?php
class Category
{
    public $id;
    public $parent_id;
    public $name;
    public $sub_category_list = [];

    public function setId($category_id)
    {
        $this->id = $category_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($category_name)
    {
        $this->name = $category_name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParentId($category_parent_id)
    {
        $this->parent_id = $category_parent_id;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function load()
    {
        $link = getConnection();
        $query = "select category_id, category_parent_id, category_name
                from	ds_category
                where   category_id = " . $this->getId();

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->setId($newArray['category_id']);
            $this->setParentId($newArray['category_parent_id']);
            $this->setName($newArray['category_name']);
            $this->loadSubCategories($this->getId());
        }
    }

    public function loadSubCategories($_parent_id)
    {
        $link = getConnection();
        $query = "select category_id, category_parent_id, category_name
                from	ds_category
                where   category_parent_id = " . $_parent_id."
                order by category_name";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        $this->sub_category_list = [];
        while ($newArray = mysql_fetch_array($result)) {
            $sub_category = new Category();
            $sub_category->setId($newArray['category_id']);
            $sub_category->setParentId($newArray['category_parent_id']);
            $sub_category->setName($newArray['category_name']);
            $sub_category->loadSubCategories($sub_category->getId());
            array_push($this->sub_category_list, $sub_category);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_category
                   (category_parent_id, category_name)
                   VALUES (" . $this->getParentId() . ", '" . $this->getName() . "')";

        executeUpdateQuery($link, $query);
        $this->setId(mysql_insert_id());
        closeConnection($link);

    }

    public function update()
    {
        $link = getConnection();
        $query = " UPDATE ds_category
                   SET    category_name = '" . $this->getName() . "'
                   WHERE  category_id = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function move()
    {
        $link = getConnection();
        $query = " UPDATE ds_category
                   SET    category_parent_id = " . $this->getParentId() . "
                   WHERE  category_id = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        $link = getConnection();
        $query = " DELETE
                   FROM   ds_category
                   WHERE  category_id = " . $this->getId() . "
                   OR    category_parent_id = " . $this->getId();

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function getJSON()
    {
        $children = array();
        foreach ($this->sub_category_list as $child) {
            array_push($children, $child->getJSON());
        }


        if (sizeof($children) == 0){
            $children = null;
        }

        $json = array(
            'data' => $this->getName(),
            'attr' => array("id" => $this->getId()),
            "state" => "open",
            'children' => $children
        );
        return $json;
    }

    public function toJSON()
    {
        return str_replace('\\u0000', "", json_encode($this->getJSON()));
    }

}

?>