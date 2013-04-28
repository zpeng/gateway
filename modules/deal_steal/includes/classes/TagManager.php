<?php
class TagManager
{
    public function loadAllTags()
    {
        $tags = array();
        $link = getConnection();
        $query = "select tag_id,  tag_value
                  from	 ds_tag ";
        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            array_push($tags, $newArray['tag_value']);
        }
        return $tags;
    }
}