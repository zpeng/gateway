<?php
class Tag
{
    public $tag_id;
    public $tag_value;

    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function getTagId()
    {
        return $this->tag_id;
    }

    public function setTagValue($tag_value)
    {
        $this->tag_value = $tag_value;
    }

    public function getTagValue()
    {
        return $this->tag_value;
    }

    public function loadByValue($tag_value)
    {
        $link = getConnection();
        $query = " select   tag_id,
                            tag_value
                   from     ds_tag
                   where    tag_value =  '".$tag_value."'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $this->setTagId($newArray['tag_id']);
            $this->setTagValue($newArray['tag_value']);
        }
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_tag
                   (tag_value)
                   VALUES ('".$this->getTagValue()."')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function delete()
    {
        //delete from ds_tag table
        $link = getConnection();
        $query1 = " DELETE
                   FROM  ds_tag
                   WHERE tag_id = " . $this->getTagId();
        executeUpdateQuery($link, $query1);

        //delete from ds_deal_tag table
        $query2 = " DELETE
                    FROM  ds_deal_tag
                    WHERE tag_id = " . $this->getTagId();

        executeUpdateQuery($link, $query2);
        closeConnection($link);
    }

}


?>