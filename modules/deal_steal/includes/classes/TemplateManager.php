<?php
class TemplateManager
{
    public function loadAllTemplates()
    {
        $templates = array();
        $link = getConnection();
        $query = "select 	temp_id,
                            temp_key,
                            temp_title,
                            temp_content,
                            temp_desc
                    from    ds_template ";

        $result = executeNonUpdateQuery($link, $query);
        closeConnection($link);

        while ($newArray = mysql_fetch_array($result)) {
            $temp = new Template();
            $temp->setId($newArray['temp_id']);
            $temp->setKey($newArray['temp_key']);
            $temp->setTitle($newArray['temp_title']);
            $temp->setContent(stripslashes($newArray['temp_content']));
            $temp->setDesc($newArray['temp_desc']);
            array_push($templates, $temp);
        }
        return $templates;
    }

    public function outputAllAsHtmlTable($id = "", $class = "")
    {
        $htmlTable = "<table id='$id' class='$class'>";
        $htmlTable = $htmlTable . "<tr>
                                    <th>ID</th>
                                    <th>Key</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    </tr>";

        $template_list = $this->loadAllTemplates();

        if (sizeof($template_list) > 0) {
            foreach ($template_list as $template) {
                $htmlTable = $htmlTable . " <tr>
                                <td>" . $template->getId() . "</td>
                                <td>" . $template->getKey() . "</td>
                                <td>" . $template->getTitle() . "</td>
                                <td>" . $template->getDesc(). "</td>
                                <td>
                                <a class='icon_edit' title='Update Template' href='" . SERVER_URL . "admin/main.php?view=template_update&template_id=" .
                    $template->getId() . "&module_code=" . $_REQUEST['module_code'] . "' ></a>
                                </td>
                                </tr> ";
            }
        }
        $htmlTable = $htmlTable . "</table>";
        return $htmlTable;
    }
}
?>
