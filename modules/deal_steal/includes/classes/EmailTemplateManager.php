<?php
namespace  modules\deal_steal\includes\classes;

use modules\core\includes\classes\TemplateManager;
use Exception;

class EmailTemplateManager extends  TemplateManager
{
    private function loadAllTemplates()
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

    public function getTemplateTableDataSource()
    {
        $template_list = $this->loadAllTemplates();
        $dataSource = array();
        if (sizeof($template_list) > 0) {
            foreach ($template_list as $template) {
                array_push($dataSource, array(
                    "id" => $template->getId(),
                    "key" => $template->getKey(),
                    "title" => $template->getTitle(),
                    "desc" => $template->getDesc(),
                    "action" => ""
                ));
            }
        }
        return $dataSource;
    }
}
?>
