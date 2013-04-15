<?php
class Tag
{
    public $tag_id;
    public $tag_text;

    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
    }

    public function getTagId()
    {
        return $this->tag_id;
    }

    public function setTagText($tag_text)
    {
        $this->tag_text = $tag_text;
    }

    public function getTagText()
    {
        return $this->tag_text;
    }

    public function insert()
    {
        $link = getConnection();
        $query = " INSERT INTO ds_tag
                   (tag_text)
                   VALUES ('".$this->getTagText()."')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function update(){
        $link = getConnection();
        $query = " UPDATE ds_tag
               SET    tag_text = '" . $this->getTagText() . "'
               WHERE  tag_id = " . $this->getTagId();

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