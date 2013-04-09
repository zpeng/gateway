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
class ContentManager
{
    public $contentList = [];

    public function getContentList()
    {
        $count = 0;
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
            $this->contentList[$count] = $content;
            $count++;
        }
        return $this->contentList;
    }

    public function outputAsHtmlTable($id = "", $class = "")
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                        <th>ID</th>
                                        <th>Article Title</th>
                                        <th>Author</th>
                                        <th>Created Date</th>
                                        <th>Last Modified By</th>
                                        <th>Last Modified Date</th>
                                        <th>Action</th>
                                    </tr>";
        $this->getContentList();
        if (sizeof($this->contentList) > 0) {
            foreach ($this->contentList as $content) {
                $htmlTable = $htmlTable . "  <tr>
                        <td>" . $content->get_content_id() . "</td>
                        <td>" . $content->get_title() . "</td>
                        <td>" . $content->get_author_name() . "</td>
                        <td>" . $content->get_create_date() . "</td>
                        <td>" . $content->get_last_modify_by() . "</td>
                        <td>" . $content->get_last_modify_date() . "</td>
                        <td>
                        <a class='icon_delete' title='Delete this article' href='" . SERVER_URL . "modules/cms/admin/control/content_delete.php?content_id=" .
                    $content->get_content_id() . "&module_code=" . $_REQUEST['module_code'] . "'
                        onclick='return confirmDeletion()'></a>
                        <a class='icon_edit' title='Update this article' href='" . SERVER_URL . "admin/main.php?view=content_update&content_id=" .
                    $content->get_content_id() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>
                        </td>
                        </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }

    public function outputAsHtmlListbox($id = "", $class = "", $style = "")
    {
        $field = "<select id='" . $id . "' name='" . $id . "' class='$class' style='$style' size='8'>";
        $this->getContentList();
        if (sizeof($this->contentList) > 0) {
            foreach ($this->contentList as $content) {
                $field = $field . "<option  value='" . $content->get_content_id() . "'>" . $content->get_title() . "</option>";
            }
        }
        $field = $field . "</select>";
        return $field;
    }
}
?>
