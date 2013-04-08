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

        $query = "select 	content_id,
                        content_author_id,
                        content_archived
                from 	cms_content
                where   content_archived = 'N'";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);
        while ($newArray = mysql_fetch_array($result)) {
            $content = new Content();

            $content->set_content_id($newArray['content_id']);
            $content->set_author_id($newArray['content_author_id']);
            $content->set_archived($newArray['content_archived']);

            $content->set_content_description_list($content->getContentDescriptionList());

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
                //$content = new Content();
                $content_description = new ContentDescription();
                $content_description = $content->get_first_content_description();

                $htmlTable = $htmlTable . "  <tr>
                        <td>" . $content->get_content_id() . "</td>
                        <td>" . $content_description->get_title() . "</td>
                        <td>" . $content->get_author_name() . "</td>
                        <td>" . $content_description->get_create_date() . "</td>
                        <td>" . $content_description->get_last_modify_by() . "</td>
                        <td>" . $content_description->get_last_modify_date() . "</td>
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
}
?>
