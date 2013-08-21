<?php
namespace  modules\deal_steal\includes\classes;

use Exception;

class TemplateManager
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

    private function template_parser($text)
    {
        $text = str_replace("\"", "'", $text); // replace " with '
        $text = str_replace("{{", "\".", $text);
        $text = str_replace("}}", ".\"", $text);
        $text = "print \"" . $text;
        $text = $text . "\";";
        return $text;
    }

    public function getProcessedContentFromTemplate($template_key, $data = array())
    {
        $template = new Template();
        if ($template->loadByKey($template_key)) {
            try {
                ob_start();
                eval($this->template_parser($template->getContent()));
                $content = ob_get_contents();
                ob_end_clean();
                return $content;
            } catch (Exception $e) {
                throw new Exception("Unable to process the template due to the following error \n\n\n" . $e->getMessage() . "\n");
            }
        } else {
            throw new Exception("Template " . $template_key . " is not found!");
        }
    }
}
?>
