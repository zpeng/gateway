<?php
namespace  modules\cms\includes\classes;

class ContentManager
{
    public function getContentList()
    {
        $contentList = [];
        $link = getConnection();
        $query = "SELECT
                      content_id,
                      content_author_id,
                      content_title,
                      content_article,
                      content_create_date,
                      content_last_modify_by,
                      content_last_modify_date,
                      active
                    FROM cms_content
                where   active = 'Y'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $content = new Content();
            $content->set_content_id($newArray['content_id']);
            $content->set_author_id($newArray['content_author_id']);
            $content->set_title($newArray['content_title']);
            $content->set_article($newArray['content_article']);
            $content->set_create_date($newArray['content_create_date']);
            $content->set_last_modify_date($newArray['content_last_modify_date']);
            $content->set_last_modify_by_user_id($newArray['content_last_modify_by']);
            $content->setActive($newArray['active']);
            array_push($contentList, $content);
        }
        return $contentList;
    }

    public function getContentTableDataSource()
    {
        $contentList = $this->getContentList();
        $dataSource = array();
        if (sizeof($contentList) > 0) {
            foreach ($contentList as $content) {
                array_push($dataSource, array(
                    "id" => $content->get_content_id(),
                    "title" => $content->get_title(),
                    "author" => $content->get_author_name(),
                    "create_date" => $content->get_create_date(),
                    "modified_by" => $content->get_last_modify_by(),
                    "modified_by_date" => $content->get_last_modify_date(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }

    public function getContentDropdownDataSource()
    {
        $contentList = $this->getContentList();
        $data = array();
        if (sizeof($contentList) > 0) {
            foreach ($contentList as $content) {
                $data[$content->get_title()] = $content->get_content_id();
            }
        }
        $dataSource = array(
            "data" => $data
        );
        return $dataSource;
    }
}
?>
