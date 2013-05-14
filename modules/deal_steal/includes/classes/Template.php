<?php
namespace  modules\deal_steal\includes\classes;

class Template {
    //put your code here
    private $id;
    private $key;
    private $title;
    private $content;
    private $desc;

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function loadByID($id) {
        $link = getConnection();
        $query="select 	temp_id,
                        temp_key,
                        temp_title,
                        temp_content,
                        temp_desc
                from    ds_template 
                where   temp_id = ".$id;

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->setId($newArray['temp_id']);
            $this->setKey($newArray['temp_key']);
            $this->setTitle($newArray['temp_title']);
            $this->setContent(stripslashes($newArray['temp_content']));
            $this->setDesc($newArray['temp_desc']);
        }
    }

    public function loadByKey($key) {
        $link = getConnection();
        $query="select 	temp_id,
                        temp_key,
                        temp_title,
                        temp_content,
                        temp_desc
                from    ds_template
                where   temp_key = '".$key."'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $this->setId($newArray['temp_id']);
            $this->setKey($newArray['temp_key']);
            $this->setTitle($newArray['temp_title']);
            $this->setContent(stripslashes($newArray['temp_content']));
            $this->setDesc($newArray['temp_desc']);
        }
    }

    public function update() {
        $link = getConnection();
        $query = "UPDATE ds_template
                  SET    temp_content     = '".$this->getContent()."' ,
                         temp_title = '".$this->getTitle()."'
                  WHERE  temp_id  = ".$this->getId();

        executeUpdateQuery($link , $query);
        closeConnection($link);
    }
}
?>
