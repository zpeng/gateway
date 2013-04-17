<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of ContentManager
 *
 * @author ziyang
 */
class ContentManager {
    //put your code here
    public function getContentList() {
        $contentList;
        $count =  0;
        $link = getConnection();

        $query="select 	content_id,
                        content_author_id,
                        content_archived
                from 	tb_content
                where   content_archived = 'N'";

        $result = executeNonUpdateQuery($link , $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $content = new Content();

            $content->set_content_id($newArray['content_id']);
            $content->set_author_id($newArray['content_author_id']);
            $content->set_archived($newArray['content_archived']);

            $content->set_content_description_list($content->getContentDescriptionList());

            $contentList[$count] = $content;
            $count++;
        }
        return $contentList;
    }

    public function getLastestNewsList($category_id, $numOfItemToDisplay = '') {
        $contentList;
        $count =  0;
        $link = getConnection();

        $query="   select   tb_content.content_id,
                        content_author_id,
                        content_archived
                from 	tb_content, tb_content_to_category
                where   tb_content_to_category.id = ".$category_id."
                and     tb_content.content_id = tb_content_to_category.content_id
                and     content_archived = 'N'
                order by tb_content.content_id desc
                limit  0, ".$numOfItemToDisplay;

        $result = executeNonUpdateQuery($link , $query, "data-accessor.getLastestNewsList");
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $content = new Content();

            $content->set_content_id($newArray['content_id']);
            $content->set_author_id($newArray['content_author_id']);
            $content->set_archived($newArray['content_archived']);


            $content->set_content_description_list($content->getContentDescriptionList());

            $contentList[$count] = $content;
            $count++;
        }
        return $contentList;
    }
}
?>
