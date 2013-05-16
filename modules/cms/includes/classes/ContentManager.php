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
                      content_archived
                    FROM cms_content
                where   content_archived = 'N'";

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
            $content->set_archived($newArray['content_archived']);
            array_push($contentList, $content);
        }
        return $contentList;
    }

    public function getContentTableDataSource()
    {
        $contentList = $this->getContentList();
        $header = array("ID", "Article Title", "Author", "Created Date", "Last Modified By", "Last Modified Date", "Action");
        $body = [];
        if (sizeof($contentList) > 0) {
            foreach ($contentList as $content) {
                array_push($body, array(
                    $content->get_content_id(),
                    $content->get_title(),
                    $content->get_author_name(),
                    $content->get_create_date(),
                    $content->get_last_modify_by(),
                    $content->get_last_modify_date(),
                    "<a class='icon_delete confirm_delete' title='Delete this article' href='" . SERVER_URL . "modules/cms/control/content_delete.php?content_id=" .
                        $content->get_content_id() . "&module_code=" . $_REQUEST['module_code'] . "'></a>
                        <a class='icon_edit' title='Update this article' href='" . SERVER_URL . "admin/main.php?view=content_update&content_id=" .
                        $content->get_content_id() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>"
                ));
            }
        }
        $dataSource = array(
            "header" => $header,
            "body" => $body
        );
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
