<?php
namespace  modules\deal_steal\includes\classes;


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

    public function updateDealTags($deal_id, $new_tag_id_list)
    {
        $link = getConnection();

        //delete all the tags from that deal
        $query = " DELETE FROM ds_deal_tag
                   WHERE deal_id=" . $deal_id;
        executeUpdateQuery($link, $query);

        // add back those new deal tags
        if (!empty($new_tag_id_list) && sizeof($new_tag_id_list)>0) {
            foreach ($new_tag_id_list as $tag_id) {
                $query = " INSERT INTO ds_deal_tag
                   (tag_id, deal_id)
                   VALUES (" . $tag_id . "," . $deal_id . ")";
                executeUpdateQuery($link, $query);
            }
        }
        closeConnection($link);
    }
}