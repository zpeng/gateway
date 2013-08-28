<?php
namespace  modules\deal_steal\includes\classes;


class DealTagManager
{
    public function loadTagsByDealId($deal_id)
    {

        $link = getConnection();
        $dataMap = array();
        $query = "  SELECT ds_tag.tag_id, tag_name
                    FROM ds_tag, ds_deal_tag
                    WHERE ds_tag.tag_id = ds_deal_tag.tag_id
                    AND ds_deal_tag.deal_id = " . $deal_id . "
                    ORDER by tag_name desc";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $dataMap[$newArray['tag_id']] = $newArray['tag_name'];
        }
        return $dataMap;
    }

    public function addTagToDeal($deal_id, $tag_id)
    {
        $link = getConnection();
        $query = " INSERT INTO ds_deal_tag
                   (deal_id, tag_id)
                   VALUES ('" . $deal_id . "', '" . $tag_id . "')";

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }

    public function removeTagFromDeal($deal_id, $tag_id)
    {
        $link = getConnection();
        $query = " DELETE
                   FROM  ds_deal_tag
                   WHERE deal_id = " . $deal_id . "
                   AND   tag_id  = " . $tag_id;

        executeUpdateQuery($link, $query);
        closeConnection($link);
    }
}


?>